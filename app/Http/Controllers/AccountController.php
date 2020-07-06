<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\ActivityLog;
use App\Rules\MatchOldPassword;
use Activity;
use Hash;

class AccountController extends Controller
{
    public function index()
	{
		$user = auth()->user();
		$logs = ActivityLog::orderBy('created_at', 'desc')
        ->where('user_type', 'user')
        ->where('user_id', auth()->user()->id)
        ->get();

		return view('account.index', ['user' => $user, 'logs' => $logs]);
	}

	public function changePassword()
	{
		return view('account.change-password');
	}

	public function patchChangePassword(Request $request)
	{
		$request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        $data = auth()->user();
        $data->password = Hash::make($request->new_password);
        $data->save();

        Activity::add(['page' => 'Ganti Password','description' => 'Anda Mengganti Password']);

        return back()->with([
            'status' => 'success', 
            'message' => 'Password Berhasil Diubah!'
        ]);
	}
}
