<?php

namespace App\Http\Controllers;

use App\Models\Melding;
use Illuminate\Http\Request;
use App\Models\User;

class MeldingController extends Controller
{
    public function show()
    {
        $meldingen = Melding::all();


        foreach ($meldingen as $melding) {
            $melding->leaveToken = User::find($melding->userID)->leaveToken;
        }

        return view('melding', compact('meldingen'));
    }

    public function confirm($id)
    {
        $melding = Melding::findOrFail($id);

        if ($melding->soort != 2) {
            return redirect()->route('melding.show');
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

        return redirect()->route('melding.show');
    }

    public function destroy(string $id)
    {
        $melding = Melding::findOrFail($id);
        $melding->delete();

        return redirect()->back();
    }
}
