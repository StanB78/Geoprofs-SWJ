<?php

namespace App\Http\Controllers;

use App\Models\Melding;
use Illuminate\Http\Request;

class MeldingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $meldingen = Melding::all();
        return view('melding', compact('meldingen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $melding = Melding::findOrFail($id);

        // Controleer of het vinkje is aangevinkt (checkbox geeft 'on' als waarde)
        $melding->status = $request->has('status') ? true : false;

        $melding->save();

        return redirect()->back()->with('success', 'Status succesvol bijgewerkt.');
    }


    public function destroy(string $id)
    {
        $melding = Melding::findOrFail($id);
        $melding->delete();

        return redirect()->back()->with('success', 'Melding succesvol verwijderd.');
    }
}
