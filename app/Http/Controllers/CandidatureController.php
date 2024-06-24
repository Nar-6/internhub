<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidatureController extends Controller
{
    public function create(Request $request)
    {
        $candidature = new Candidature;
        $candidature->date_soumission = now();
        $candidature->statut = "soumis";
        $candidature->candidat_id = Auth::user()->candidat->candidat_id;
        $candidature->offre_de_stage_id = $request->get("offre_id");
        $candidature->save();

        return redirect()->route("profile");
    }
}
