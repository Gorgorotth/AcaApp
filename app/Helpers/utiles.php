<?php

use Illuminate\Support\Facades\Log;

if (!function_exists('captureException')) {
    /**
     * @param $error
     */
    function captureException($error)
    {
        if (app()->bound('sentry')) {
            app('sentry')->captureException($error);
        }
        Log::error($error);
    }
}