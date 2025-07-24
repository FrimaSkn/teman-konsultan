<?php

namespace App\Http\Controllers\Frontend;

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

        $store = Consultation::create($store);

        Mail::to('info@temankonsultan.com')->send(new ConsultationForm($store));

        return redirect()->route('frontend.auth.free-consultation.messages')->with('success', 'Your consultation request has been sent successfully!');
    }
}
