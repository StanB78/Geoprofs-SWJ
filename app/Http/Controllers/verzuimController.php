<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Verzuim;
use function Laravel\Prompts\alert;

class verzuimController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'melding' => 'required',
            'redenverzuim' => 'required',
            'startdatum' => 'required|date',
        ]);

        $user = auth()->user();

        if ($request->redenverzuim == 2) {
            if (!$request->einddatum) {
                return redirect()->back()->with('error', 'Einddatum is verplicht voor verlof.');
            }

            $start = new \DateTime($request->startdatum);
            $end = new \DateTime($request->einddatum);
            $interval = $start->diff($end)->days + 1; // Include start day

            if ($interval > $user->leaveToken) {
                return redirect()->back()->with('error', 'Je hebt niet genoeg tokens voor dit aantal dagen.');
            }

            $user->leaveToken -= $interval;
            $user->save();
        }

        $verzuim = Verzuim::create([
            'userID' => $user->id,
            'soort' => $request->redenverzuim,
            'melding' => $request->melding,
            'startdatum' => $request->startdatum,
            'einddatum' => $request->einddatum,
        ]);

        $rol = $verzuim->rol;
        $sectorID = $verzuim->sectorID;

        return redirect()->back()->with('success', 'Verzoek verzonden.');
    }

}
