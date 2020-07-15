<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\AdminRequest;
use App\Admin;
use App\ActivityLog;
use Activity;
use Hash;
use Image;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.data.index', ['admins' => Admin::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.data.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
        $data = new Admin;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $path = 'uploads/' . auth()->user()->id . '/';

            if (!file_exists(public_path($path))) {
                mkdir($path, 666, true);
            }

            $path .= time() . '.' . $file->getClientOriginalExtension();
            $image = Image::make($file)->resize(300, 300);
            $image->save(public_path($path));
            $data->photo = $path;
        }

        $data->name = $request->name;
        $data->username = $request->username;
        $data->password = Hash::make($request->password);
        $data->save();

        Activity::add(['page' => 'Admin', 'description' => 'Menambah Data Admin: ' . $request->name]);

        return redirect()->route('admin.data.index')->with([
            'status' => 'success',
            'message' => 'Menambahkan Admin Baru: ' . $request->name
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $data
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $data)
    {
        $logs = ActivityLog::where([
            'user_type' => 'admin',
            'user_id' => $data->id,
        ])->get();

        return view('admin.data.show', ['admin' => $data, 'logs' => $logs]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $data
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $data)
    {
        return view('admin.data.edit', ['admin' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $data
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, Admin $data)
    {
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $path = 'uploads/' . auth()->user()->id . '/' . time() . '.' . $file->getClientOriginalExtension();
            $image = Image::make($file)->resize(300, 300);
            $image->save(public_path($path));
            $data->photo = $path;
        }

        $data->name = $request->name;
        $data->username = $request->username;

        if ($request->password) {
            $data->password = Hash::make($request->password);
        }

        $data->save();

        Activity::add(['page' => 'Admin', 'description' => 'Menmperbarui Data Admin: ' . $data->name]);

        return redirect()->route('admin.data.index')->with([
            'status' => 'success',
            'message' => 'Berhasil Memperbarui Data Admin: ' . $request->name
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $data
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $data)
    {
        Activity::add(['page' => 'Admin', 'description' => 'Menghapus Data Admin: ' . $data->name]);
        $data->delete();

        return back()->with(['status' => 'success', 'message' => 'Data Berhasil Dihapus!']);
    }
}
