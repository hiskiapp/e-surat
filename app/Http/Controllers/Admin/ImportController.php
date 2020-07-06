<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Import\AdminsImport;
use Activity;
use Excel;

class ImportController extends Controller
{
    public function data(Request $request)
    {
    	Excel::import(new UsersImport, request()->file('file_import'));

    	Activity::add(['page' => 'Admin', 'description' => 'Menngimport Data Admin']);

    	return redirect()->route('admin.data.index')->with([
            'status' => 'success', 
            'message' => 'Menngimport Data Admin'
        ]);
    }
}
