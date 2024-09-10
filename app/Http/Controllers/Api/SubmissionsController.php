<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubmissionRequest;

class SubmissionsController extends Controller
{   
    public function store(StoreSubmissionRequest $request)
    {
        return response()->json(array('success' => true));
    }    
}
