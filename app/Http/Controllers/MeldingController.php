<?php

namespace App\Http\Controllers;

use App\Models\Melding;
use Illuminate\Http\Request;

class MeldingController extends Controller
{
    public function show()
    {
        $meldingen = Melding::all();
        return view('melding', compact('meldingen'));
    }

    public function confirm($id)
    {
        $melding = Melding::findOrFail($id);

        if ($melding->soort != 2) {
            return redirect()->route('melding.show')
                ->with('error', 'Alleen verlof meldingen kunnen geaccepteerd worden.');
        }

        return view('melding-confirm', compact('melding'));
    }

    public function accept($id)
    {
        $melding = Melding::findOrFail($id);

        if ($melding->soort == 2) {
            $melding->status = true;
            $melding->save();
        }

        return redirect()->route('melding.show')->with('success', 'Melding geaccepteerd!');
    }

    public function destroy(string $id)
    {
        $melding = Melding::findOrFail($id);
        $melding->delete();

        return redirect()->back()->with('success', 'Melding succesvol verwijderd.');
    }
}
