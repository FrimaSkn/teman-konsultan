<?php

namespace App\Http\Controllers\Frontend;

use App\Rules\Captcha;
use App\Models\Contact;
use App\Mail\ContactForm;
use Illuminate\Http\Request;
use App\Settings\GeneralSettings;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function index(GeneralSettings $settings)
    {
        return view('frontend.pages.contact-us', [
            'settings' => $settings
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
            'g-recaptcha-response' => ['required_if:captcha_status,true', new Captcha],
        ],[
            'g-recaptcha-response.required_if' => __('validation.required', ['attribute' => 'captcha']),
        ]);

        try {
            $store = Contact::create($validated);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => __('Failed to send your message. Please try again later.')]);
        }

        // Mail::to('info@temankonsultan.com')->send(new ContactForm($store));

        return redirect()->back()->with('flash_success', __('Your message has been sent successfully!'));
    }
}
