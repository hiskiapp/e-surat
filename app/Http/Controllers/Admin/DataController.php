<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Submission;
use App\User;

class DataController extends Controller
{
    public function users()
    {
        return datatables()->of(User::all())->toJson();
    }

    public function submissionsPending()
    {
        $submissions = Submission::with('user', 'letter')
        ->where('approval_status', 0)
        ->get();

        return datatables()->of($submissions)->toJson();
    }

    public function submissionsApproved()
    {
        $submissions = Submission::with('user', 'letter')
        ->where('approval_status', 1)
        ->get();

        return datatables()->of($submissions)->toJson();
    }

    public function submissionsRejectedPending()
    {
        $submissions = Submission::with('user', 'letter')
        ->where('approval_status', 2)
        ->get();

        return datatables()->of($submissions)->toJson();
    }
}
