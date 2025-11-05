<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Verzuim;
use function Laravel\Prompts\alert;

class verzuimController extends Controller
{
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'melding' => 'required',
            'redenverzuim' => 'required',
        ]);

        $user = auth()->user();

        if ($request->redenverzuim == 2) {

            if ($user->leaveToken <= 0) {
                return redirect()->back()->with('error', 'Je hebt geen tokens meer over.');
            }

            $user->leaveToken -= 1;
            $user->save();

        }



        Verzuim::create([
            'userID' => $user->id,
            'soort' => $request->redenverzuim,
            'melding' => $request->melding,
            'startdatum' => $request->startdatum,
            'einddatum' => $request->einddatum,
        ]);

        return redirect()->back()->with('success', 'Verzoek verzonden.');
    }
}
