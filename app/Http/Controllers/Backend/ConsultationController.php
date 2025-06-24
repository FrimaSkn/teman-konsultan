<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consultations = Consultation::latest()->paginate(7);
        return view('backend.consultation.index', [
            'consultations' => $consultations,
        ]);
    }

    /**
     * Display the specified consultation details.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */

    public function show(Consultation $consultation)
    {
        // Mark the consultation as read
        $consultation->markAsRead();
        return view('backend.consultation.show', compact('consultation'));
    }
}
