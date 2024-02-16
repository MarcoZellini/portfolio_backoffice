<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\NewLeadEmail;
use App\Mail\NewLeadEmailMd;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        //validate & store a new email 

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email'],
            'phone' => ['required'],
            'message' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        //send a mail to myself
        $lead = Lead::create($request->all());

        // Mail::to('admin@laravelapi.it')->send(new NewLeadEmail($lead));
        Mail::to('admin@laravelapi.it')->send(new NewLeadEmailMd($lead));


        // Mail::to($lead->email)->send(new NewLeadEmail($lead));

        return response()->json([
            'success' => true,
            'message' => '👍 Message Sent Successfully'
        ]);
    }
}
