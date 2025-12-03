<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contact;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // TODO: Add proper auth middleware to protect this route in production
        $users = User::orderBy('created_at', 'desc')->limit(200)->get();
        $contacts = Contact::orderBy('created_at', 'desc')->limit(200)->get();

        return view('admin.dashboard', compact('users', 'contacts'));
    }
}
