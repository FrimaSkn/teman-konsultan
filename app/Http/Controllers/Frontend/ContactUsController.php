<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Contact;
use App\Mail\ContactForm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function index()
    {
        return view('frontend.pages.contact-us');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        $store = Contact::create($validated);

        Mail::to('info@temankonsultan.com')->send(new ContactForm($store));

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}
