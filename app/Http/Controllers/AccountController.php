<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PasswordRequest;
use App\User;
use App\ActivityLog;
use Activity;
use Hash;

class AccountController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('account.index', ['user' => $user]);
    }

    public function whatsapp(Request $request)
    {
        $data = auth()->user();
        $data->phone_number = $request->phone_number;
        $data->save();

        Activity::add(['page' => 'Account', 'description' => 'Anda Mengganti Nomor Whatsapp']);

        return back()->with([
            'status' => 'success',
            'message' => 'Nomor Whatsapp Berhasil Disimpan!'
        ]);
    }

    public function password()
    {
        return view('account.password');
    }

    public function patchPassword(PasswordRequest $request)
    {
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
