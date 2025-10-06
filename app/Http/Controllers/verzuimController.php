<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Verzuim;

class VerzuimController extends Controller
{
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'melding' => 'required|string|max:65535',
            'redenverzuim' => 'required|in:1,2',
        ]);

        // Save to database
        Verzuim::create([
            'userID' => auth()->id(),
            'soort' => $request->redenverzuim,
            'melding' => $request->melding,
        ]);

        return redirect()->back()->with('success', 'Verzuim succesvol geregistreerd!');
    }

}
