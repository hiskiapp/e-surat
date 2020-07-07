<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\AdminsImport;
use App\Imports\UsersImport;
use Activity;
use Excel;

class ImportController extends Controller
{
    public function admin(Request $request)
    {
        Excel::import(new AdminsImport, request()->file('file_import'));

        Activity::add(['page' => 'Admin', 'description' => 'Menngimport Data Admin']);

        return redirect()->route('admin.data.index')->with([
            'status' => 'success',
            'message' => 'Menngimport Data Admin'
        ]);
    }

    public function user(Request $request)
    {
        Excel::import(new UsersImport, request()->file('file_import'));

        Activity::add(['page' => 'Warga', 'description' => 'Menngimport Data Warga']);

        return redirect()->route('admin.users.index')->with([
            'status' => 'success',
            'message' => 'Menngimport Data Warga'
        ]);
    }
}
