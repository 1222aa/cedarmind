<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Contact;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        // Persist contact message to database
        $contact = Contact::create($data + ['user_id' => optional($request->user())->id]);

        // Also keep a log entry
        Log::info('Contact form received', ['contact_id' => $contact->id] + $data + ['user_id' => optional($request->user())->id]);

        return response()->json(['message' => 'Message received', 'contact_id' => $contact->id], 201);
    }
}
