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
            'message' => 'Mengubah Status Pengajuan Surat: #'.$id
        ]);

        return view('admin.submission.show', ['submission' => $submission]);
    }

    public function print($id)
    {
    	$submission = Submission::find($id);

    	return view('admin.print.'.$submission->letter_id, ['submission' => $submission]);
    }
}
