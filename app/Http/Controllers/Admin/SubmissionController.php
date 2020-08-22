<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Submission;
use App\Signatory;
use App\Signatories;
use App\Exports\SubmissionsExport;
use Activity;
use Excel;

class SubmissionController extends Controller
{
    public function pending()
    {
        $submissions = Submission::with('user', 'letter')
        ->where('approval_status', 0)
        ->get();

        return view('admin.submission.pending', ['submissions' => $submissions]);
    }

    public function approved()
    {
        $submissions = Submission::with('user', 'letter', 'admin')
        ->where('approval_status', 1)
        ->get();

        return view('admin.submission.approved', ['submissions' => $submissions]);
    }

    public function exportApproved()
    {
        return Excel::download(new SubmissionsExport, 'Surat Yang Disetujui ' . now()->format('d-M-Y') . '.xlsx');
    }

    public function rejected()
    {
        $submissions = Submission::with('user', 'letter', 'admin')
        ->where('approval_status', 2)
        ->get();

        return view('admin.submission.rejected', ['submissions' => $submissions]);
    }

    public function show($id)
    {
        $submission = Submission::find($id);
        $signatories = Signatory::all();

        return view('admin.submission.show', ['submission' => $submission, 'signatories' => $signatories]);
    }

    public function status($id, $status)
    {
        $submission = Submission::find($id);
        $submission->approval_status = $status;
        $submission->approval_at = now();
        $submission->admin_id = auth('admin')->user()->id;
        $submission->save();

        if ($status == 1) {
            $message = 'Pengajuan '. $submission->letter->name . ' oleh: ' . $submission->user->name . ' telah disetujui!';
        }else{
            $message = 'Pengajuan '. $submission->letter->name . ' oleh: ' . $submission->user->name . ' telah ditolak!';
        }

        // $response = Http::withHeaders(['Authorization' => '#'])->post('https://fonnte.com/api/send_message.php', [
        //     'phone' => '6285155064115',
        //     'type' => 'text',
        //     'text' => $message
        // ]);
        
        $curl = curl_init();
        $token = config('whatsapp.token');
        $data = [
            'phone' => $submission->user->phone_number,
            'type' => 'text',
            'text' => $message
        ];

        curl_setopt($curl, CURLOPT_HTTPHEADER,
            array(
                "Authorization: $token",
            )
        );
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_URL, "https://fonnte.com/api/send_message.php");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($curl);
        curl_close($curl);

        Activity::add(['page' => 'Warga', 'description' => 'Berhasil Mengubah Status Pengajuan Surat: #' . $id]);

        $route = $status == 1 ? route('admin.submissions.approved') : route('admin.submissions.rejected');
        return redirect($route)->with([
            'status' => 'success',
            'message' => 'Mengubah Status Pengajuan Surat: #' . $id
        ]);
    }

    public function update(Request $request, $id)
    {
        $submission = Submission::find($id);
        $submission->number = $request->number;
        $submission->data = json_encode($request->except('_token', '_method', 'number'));
        $submission->save();

        Activity::add(['page' => 'Warga', 'description' => 'Berhasil Memperbarui Pengajuan Surat: #' . $id]);

        return back()->with([
            'status' => 'success',
            'message' => 'Memperbarui Pengajuan Surat: #' . $id
        ]);
    }

    public function print($id, Request $request)
    {
        $submission = Submission::find($id);

        $signatory_id = $request->signatory ?? setting('signatory_active');
        $signatory = Signatory::find($signatory_id);

        $data['signatory_name'] = $signatory->name;
        $data['signatory_position'] = $signatory->position;
        $data['on_behalf'] = $signatory_id != 1 ? 'A/N, Perbengkel ' . ucwords(strtolower(setting('village'))) : '';

        foreach ($submission->user->toArray() as $key => $value) {
            $data[$key] = $value;
        }

        $data['ttl'] = $submission->user->getPsb();
        $data['tgl'] = now()->formatLocalized('%d %B %Y');
        $data['districts'] = ucwords(strtolower(setting('districts')));
        $data['sub-districts'] = ucwords(strtolower(setting('sub-districts')));
        $data['village'] = ucwords(strtolower(setting('village')));

        foreach (json_decode($submission->data) as $key => $value) {
            $data[$key] = $value;
        }

        $content = $submission->letter->content;
        foreach ($data as $key => $value) {
            $content = str_replace('[' . $key . ']', $value, $content);
        }

        return view('admin.print.template', ['submission' => $submission, 'content' => $content]);
    }
}
