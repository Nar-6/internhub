<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Employe;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    public function index()
    {
        $departement=Departement::all();
        return view('',compact('departement'));
    }

    /**
     * Show the form for creating a new resource.
     */
     public function create()
     {
        $employe=Employe::all();
        return view('',compact('employe'));
     }

    // /**
    //  * Store a newly created resource in storage.
    //  */
     public function store(Request $request)
     {
        Departement::create($request->validated());
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
    public function edit(Departement $departement)
    {
        $employe=Employe::all();
        return view('',compact('departement','employe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Departement $departement)
    {
        $departement->update($request->validated());
        return redirect()->route('')->with('status', 'Modifiée avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Departement $departement)
    {
        $departement->delete();
        return redirect()->route('')->with('status', 'Supprimée avec succès !');
    }

}
