<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\AccountRequest;
use Activity;

class AccountController extends Controller
{
    public function index()
	{
		$user = User::find(auth('admin')->user()->id);

		return view('admin.account.index', ['user' => $user]);
	}

	public function update(AccountRequest $request)
	{
        $data = User::find(auth('admin')->user()->id);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $path = 'uploads/' . auth()->user()->id . '/' . time() . '.' . $file->getClientOriginalExtension();
            $image = Image::make($file)->resize(300, 300);
            $image->save(public_path($path));
            $data->photo = $path;
        }

        $data->name = $request->name;
        $data->save();

        Activity::add(['page' => 'Account', 'description' => 'Memperbarui Data Akun']);

        return back()->with([
            'status' => 'success', 
            'message' => 'Memperbarui Data Akun!'
        ]);

	public function changePassword()
	{
		return view('admin.account.password');
	}

	public function patchChangePassword(Request $request)
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
