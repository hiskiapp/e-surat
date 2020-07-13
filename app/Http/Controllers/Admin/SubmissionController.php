<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Submission;
use App\Signatory;
use App\Signatories;
use Activity;

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

        Activity::add(['page' => 'Warga', 'description' => 'Berhasil Mengubah Status Pengajuan Surat: #' . $id]);

        return back()->with([
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

        foreach ($submission->user->toArray() as $key => $value) {
            $data[$key] = $value;
        }

        $data['ttl'] = $submission->user->getPsb();
        $data['tgl'] = ucwords(strtolower(setting('village'))) . ', ' . now()->formatLocalized('%d %B %Y');
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
