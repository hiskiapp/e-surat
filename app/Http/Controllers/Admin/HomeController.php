<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Submission;
use App\User;
use App\Letter;

class HomeController extends Controller
{
	public function index()
	{
		$data['submissions'] = Submission::count();
		$data['submissionsApproved'] = Submission::where('approval_status', 1)->count();
		$data['users'] = User::count();
		$data['letters'] = Letter::count();

		return view('admin.home.index', $data);
	}
}
