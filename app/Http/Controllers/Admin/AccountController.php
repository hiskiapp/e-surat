<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AccountRequest;
use App\Http\Requests\PasswordRequest;
use App\Admin;
use App\ActivityLog;
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

        Activity::add(['page' => 'Data Akun', 'description' => 'Memperbarui Data Akun']);

        return back()->with([
            'status' => 'success',
            'message' => 'Akun Berhasil Diperbarui!'
        ]);
    }

    public function password()
    {
        return view('admin.account.password');
    }

    public function patchPassword(PasswordRequest $request)
    {
        $data = Admin::find(auth('admin')->user()->id);
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
            ->where('user_type', 'admin')
            ->where('user_id', auth('admin')->user()->id)
            ->get();

        return view('admin.account.logs', ['logs' => $logs]);
    }
}
