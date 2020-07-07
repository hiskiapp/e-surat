<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AccountRequest;
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
        return view('account.index', ['user' => $user]);
    }

    public function update(AccountRequest $request)
    {
        $user = auth()->user();
        $user->update($request->validated());
        return view('account.index', ['user' => $user]);
    }

    public function password()
    {
        return view('account.password');
    }

    public function patchPassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        $data = auth()->user();
        $data->password = Hash::make($request->new_password);
        $data->save();

        Activity::add(['page' => 'Ganti Password', 'description' => 'Anda Mengganti Password']);

        return back()->with([
            'status' => 'success',
            'message' => 'Password Berhasil Diubah!'
        ]);
    }

    public function logs()
    {

        $logs = ActivityLog::orderBy('created_at', 'desc')
            ->where('user_type', 'user')
            ->where('user_id', auth()->user()->id)
            ->get();

        return view('account.logs', ['logs' => $logs]);
    }
}
