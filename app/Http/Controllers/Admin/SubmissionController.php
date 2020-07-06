<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Submission;

class SubmissionController extends Controller
{
    public function pending()
    {
        $submissions = Submission::with('user', 'letter')
        ->where('approval_status', 0)
        ->get();

        return view('admin.submission.pending', ['submissions' => $submissions]);
    }

    public function print($id)
    {
    	$submission = Submission::find($id);

    	return view('admin.submission.print', ['submission' => $submission]);
    }
}
