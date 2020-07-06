<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AccountRequest;
use App\Admin;
use App\ActivityLog;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Activity;
use Hash;

class AccountController extends Controller
{
    public function index()
    {
        $admin = auth('admin')->user();
        return view('admin.account.index', ['admin' => $admin]);
    }

    public function update(AccountRequest $request)
    {
        $user = auth('admin')->user();
        $user->update($request->validated());
        
        Activity::add(['page' => 'Data Akun','description' => 'Memperbarui Data Akun']);

        return back()->with([
            'status' => 'success', 
            'message' => 'Akun Berhasil Diperbarui!'
        ]);
    }

	public function password()
	{
		return view('admin.account.password');
	}

	public function patchPassword(Request $request)
	{
		$request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        $data = Admin::find(auth('admin')->user()->id);
        $data->password = Hash::make($request->new_password);
        $data->save();

        Activity::add(['page' => 'Ganti Password','description' => 'Anda Mengganti Password']);

        return back()->with([
            'status' => 'success', 
            'message' => 'Password Berhasil Diubah!'
        ]);
	}

	public function logs()
	{
		$logs = ActivityLog::orderBy('created_at', 'desc')
        ->where('user_type', 'admin')
        ->where('user_id', auth('admin')->user()->id)
        ->get();

		return view('admin.account.logs', ['logs' => $logs]);
	}
}
