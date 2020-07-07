<?php

namespace App\Helpers;

use Request;
use Auth;
use App\ActivityLog;

class Activity
{
	public static function add($data)
	{
		$log 				= new ActivityLog;

		if (auth('admin')->check()) {
			$log->user_type	= 'admin';
			$log->user_id 	= auth('admin')->user()->id;
		} else {
			$log->user_type	= 'user';
			$log->user_id 	= auth()->user()->id;
		}

		$log->page 			= $data['page'];
		$log->description 	= $data['description'];
		$log->method 		= Request::method();
		$log->url 			= Request::fullUrl();
		$log->ip 			= Request::ip();
		$log->agent 		= Request::header('user-agent');
		$log->save();
	}
}
