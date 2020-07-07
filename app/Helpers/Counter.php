<?php

use App\Submission;

if (!function_exists('pendingSubmissions')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function pendingSubmissions()
    {
        return Submission::where('approval_status', 0)->count();
    }
}
