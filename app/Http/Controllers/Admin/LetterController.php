<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Letter;
use App\Submission;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\LetterRequest;
use Activity;

class LetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.letter.index', ['letters' => Letter::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.letter.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LetterRequest $request)
    {
        $letter = new Letter;
        $letter->name = $request->name;
        $letter->content = $request->content;
        $letter->data = json_encode($request->data);
        $letter->status = $request->status;
        $letter->save();

        Activity::add(['page' => 'Daftar Surat', 'description' => 'Menambah Surat Baru: ' . $request->name]);

        return redirect()->route('admin.letters.index')->with([
            'status' => 'success',
            'message' => 'Menambahkan Surat Baru: ' . $request->name
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Letter  $letter
     * @return \Illuminate\Http\Response
     */
    public function show(Letter $letter)
    {
        $submissions = Submission::with('user', 'admin')->where([
            'letter_id' => $letter->id,
            'approval_status' => 1,
        ])->get();

        return view('admin.letter.show', ['letter' => $letter, 'submissions' => $submissions]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Letter  $letter
     * @return \Illuminate\Http\Response
     */
    public function edit(Letter $letter)
    {
        return view('admin.letter.edit', ['letter' => $letter]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Letter  $letter
     * @return \Illuminate\Http\Response
     */
    public function update(LetterRequest $request, Letter $letter)
    {
        $letter->name = $request->name;
        $letter->content = $request->content;
        $letter->data = json_encode($request->data);
        $letter->status = $request->status;
        $letter->save();

        Activity::add(['page' => 'Edit Surat', 'description' => 'Memperbarui Surat: ' . $letter->name]);

        return redirect()->route('admin.letters.index')->with([
            'status' => 'success',
            'message' => 'Berhasil Memperbarui Surat: ' . $letter->name
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Letter  $letter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Letter $letter)
    {
        Activity::add(['page' => 'Daftar Surat', 'description' => 'Menghapus Surat: ' . $letter->name]);

        $letter->delete();

        return back()->with(['status' => 'success', 'message' => 'Surat Berhasil Dihapus!']);
    }
}
