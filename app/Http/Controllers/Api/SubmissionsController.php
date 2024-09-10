<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubmissionRequest;
use  App\Jobs\ProcessStoreSubmission;

class SubmissionsController extends Controller
{   
    public function store(StoreSubmissionRequest $request)
    {
        $data = $request->only('name', 'email', 'message');
        
        ProcessStoreSubmission::dispatch($data);        

        return response()->json(array('success' => true));
    }    
}
