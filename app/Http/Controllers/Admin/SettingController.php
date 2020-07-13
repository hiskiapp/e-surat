<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Setting;
use App\Signatory;
use Activity;
use Image;

class SettingController extends Controller
{
	public function index()
	{
		$signatories = Signatory::all();

		return view('admin.setting.index', ['settings' => Setting::all(), 'signatories' => $signatories]);
	}

	public function update(Request $request)
	{
		$data = Setting::all();

		foreach ($data as $key => $row) {
			if ($row->key == 'leftlogo' || $row->key == 'rightlogo') {
				if ($request->file($row->key)) {
					$file = $request->file($row->key);
					$path = 'uploads/' . auth()->user()->id . '/';

					if (!file_exists(public_path($path))) {
						mkdir($path, 666, true);
					}

					$path .= time() . '.' . $file->getClientOriginalExtension();
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
