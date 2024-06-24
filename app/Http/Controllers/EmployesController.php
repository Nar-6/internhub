<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use App\Models\Departement;
use App\Models\Employe;
use App\Models\Stage;
use Illuminate\Http\Request;

class EmployesController extends Controller
{
    public function index()
    {
        $employe=Employe::all();
        return view('',compact('employe'));
    }

    /**
     * Show the form for creating a new resource.
     */
     public function create()
     {
        $departement=Departement::all();
        $candidat=Candidat::all();
        $stage=Stage::all();
        return view('',compact('departement','candidat','stage'));
     }

    // /**
    //  * Store a newly created resource in storage.
    //  */
     public function store(Request $request)
     {
        Employe::create($request->validated());
         redirect()->route('')->with('success', 'Ajout effectué');
     }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(on passe le model)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    public function edit(Employe $employe)
    {
        $departement=Departement::all();
        $candidat=Candidat::all();
        $stage=Stage::all();
        return view('',compact('employe','departement','candidat','stage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Employe $employe)
    {
        $employe->update($request->validated());
        return redirect()->route('')->with('status', 'Modifiée avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Employe $employe)
    {
        $employe->delete();
        return redirect()->route('')->with('status', 'Supprimée avec succès !');
    }
}
