<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Submission;
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

        return view('admin.submission.show', ['submission' => $submission]);
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
        $submission->data = json_encode($request->except('_token','_method'));
        $submission->save();

        Activity::add(['page' => 'Warga', 'description' => 'Berhasil Memperbarui Pengajuan Surat: #' . $id]);

        return back()->with([
            'status' => 'success',
            'message' => 'Memperbarui Pengajuan Surat: #' . $id
        ]);
    }

    public function print($id)
    {
        $submission = Submission::find($id);
        
        $data['signatory_person'] = setting('vh_status') == 'On' ? setting('village_head') : setting('secretary');
        $data['signatory_person_position'] = setting('vh_status') == 'On' ? 'Kepala Desa' : 'Sekretaris';

        foreach($submission->user->toArray() as $key => $value){
            $data[$key] = $value;
        }

        $data['nik'] = $submission->user->sin;
        $data['ttl'] = $submission->user->getPsb();

        foreach (json_decode($submission->data) as $key => $value) {
            $data[$key] = $value;
        }

        $content = $submission->letter->content;
        foreach($data as $key => $value){
            $content = str_replace('[' . $key . ']', $value, $content);
        }

        return view('admin.print.template', ['submission' => $submission, 'content' => $content]);
    }
}
