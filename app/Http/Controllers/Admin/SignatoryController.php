<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Signatory;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\SignatoryRequest;
use Activity;

class SignatoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.signatory.index', ['signatories' => Signatory::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.signatory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SignatoryRequest $request)
    {
        Signatory::create($request->validated());

        Activity::add(['page' => 'Penandatangan', 'description' => 'Menambah Penandatangan Baru: ' . $request->name]);

        return redirect()->route('admin.signatories.index')->with([
            'status' => 'success',
            'message' => 'Menambahkan Penandatangan Baru: ' . $request->name
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Signatory  $signatory
     * @return \Illuminate\Http\Response
     */
    public function show(Signatory $signatory)
    {
        return view('admin.signatory.show', ['signatory' => $signatory]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Signatory  $signatory
     * @return \Illuminate\Http\Response
     */
    public function edit(Signatory $signatory)
    {
        return view('admin.signatory.edit', ['signatory' => $signatory]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Signatory  $signatory
     * @return \Illuminate\Http\Response
     */
    public function update(SignatoryRequest $request, Signatory $signatory)
    {
        $signatory->update($request->validated());

        Activity::add(['page' => 'Edit Penandatangan', 'description' => 'Memperbarui Penandatangan: ' . $signatory->name]);

        return redirect()->route('admin.signatories.index')->with([
            'status' => 'success',
            'message' => 'Berhasil Memperbarui Penandatangan: ' . $signatory->name
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Signatory  $signatory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Signatory $signatory)
    {
        Activity::add(['page' => 'Penandatangan', 'description' => 'Menghapus Penandatangan: ' . $signatory->name]);

        $signatory->delete();

        return back()->with(['status' => 'success', 'message' => 'Penandatangan Berhasil Dihapus!']);
    }
}
