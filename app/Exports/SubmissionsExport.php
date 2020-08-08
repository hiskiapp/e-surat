<?php

namespace App\Exports;

use App\Submission;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SubmissionsExport implements FromView
{
	public function view(): View
	{
		$submissions = Submission::with('user', 'letter', 'admin')
		->where('approval_status', 1)
		->get();

		return view('admin.export.letter', [
			'submissions' => $submissions
		]);
	}
}
