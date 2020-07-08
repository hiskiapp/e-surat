<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Setting;
use Activity;

class SettingController extends Controller
{
	public function index()
	{
		return view('admin.setting.index', ['settings' => Setting::all()]);
	}

	public function update(Request $request)
	{
		$data = Setting::all();

		foreach ($data as $key => $row) {
			if ($row->key == 'logo') {
				if ($request->logo) {
					$file = $request->file('logo');
					$path = 'uploads/' . auth()->user()->id . '/' . time() . '.' . $file->getClientOriginalExtension();
					$image = Image::make($file)->resize(300, 300);
					$image->save(public_path($path));

					Setting::find($row->id)->update(['value' => $path]);
				}
			} else {
				Setting::find($row->id)->update(['value' => $request->input($row->key)]);
			}
		}

		Activity::add(['page' => 'Pengaturan', 'description' => 'Memperbarui Pengaturan']);

		return redirect()->route('admin.settings')->with([
			'status' => 'success',
			'message' => 'Berhasil Memperbarui Pengaturan'
		]);
	}
}
