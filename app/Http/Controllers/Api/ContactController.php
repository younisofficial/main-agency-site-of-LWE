<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactMessageRequest;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    public function store(StoreContactMessageRequest $request)
    {
        $message = ContactMessage::create($request->validated());

        // To also get an email for every enquiry, configure MAIL_* in .env
        // and send a Mailable from here.

        return response()->json(['id' => $message->id], 201);
    }
}
