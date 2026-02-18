<?php

namespace App\Http\Controllers\Frontend;

use App\Rules\Captcha;
use App\Models\Consultation;
use Illuminate\Http\Request;
use App\Mail\ConsultationForm;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ConsultationController extends Controller
{
    public function free_consultation()
    {
        return view('frontend.pages.free-consultation');
    }

    public function messages()
    {
        return view('frontend.pages.consultation-messages');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'area' => 'required',
            'other_area' => 'required_if:area,Lainnya',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
            'g-recaptcha-response' => ['required_if:captcha_status,true', new Captcha],
        ],[
            'g-recaptcha-response.required_if' => __('validation.required', ['attribute' => 'captcha']),
        ]);

        if ($validated['area'] === 'Lainnya') {
            $validated['area'] = $validated['other_area'];
        }else {
            $validated['area'] = implode(', ', $validated['area']);
        }

        $store = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'area' => $validated['area'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
        ];

        try {
            $store = Consultation::create($store);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => __('Failed to send your consultation request. Please try again later.')]);
        }

        // Mail::to('info@temankonsultan.com')->send(new ConsultationForm($store));

        return redirect()->route('frontend.auth.free-consultation.messages')->with('flash_success', __('Your consultation request has been sent successfully!'));
    }
}
