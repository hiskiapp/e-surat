<?php

namespace App\Http\Controllers;

use App\Submission;
use App\Letter;
use Illuminate\Http\Request;
use Activity;

class SubmissionController extends Controller
{
    public function index()
    {
        $submissions = Submission::where('user_id', auth()->id())->get();

        return view('submissions', ['submissions' => $submissions]);
    }

    public function store($letter, Request $request)
    {
        $letter = Letter::find($letter);

        if (!$letter) {
            return back()->with([
                'status' => 'danger',
                'message' => 'Surat Belum Tersedia!'
            ]);
        }

        $submission = new Submission;
        $submission->user_id = auth()->id();
        $submission->letter_id = $letter->id;
        $submission->data = json_encode($request->except('_token'));
        $submission->approval_status = 0;
        $submission->save();

        Activity::add(['page' => 'Pengajuan Surat', 'description' => 'Mengajukan Surat Baru: ' . $letter->name]);

        return back()->with([
            'status' => 'success',
            'message' => 'Berhasil Mengajukan Surat!'
        ]);
    }
}
