<?php

namespace App\Http\Controllers\Backend;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactUsController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->paginate(7);
        return view('backend.contact.index', [
            'contacts' => $contacts,
        ]);
    }

    public function show(Contact $contact)
    {
        $contact->markAsRead();
        return view('backend.contact.show', [
            'contact' => $contact,
        ]);
    }
}
