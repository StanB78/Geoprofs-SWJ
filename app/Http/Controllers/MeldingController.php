<?php

namespace App\Http\Controllers;

use App\Models\Melding;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


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
            return redirect()->route('melding');
        }

        return view('melding-confirm', compact('melding'));
    }

    public function accept($id, Request $request)
    {
        $melding = Melding::findOrFail($id);

        $request->validate([
            'sendmessage' => ['required', 'string', 'max:255'],
        ]);

        if ($melding->soort == 2) {
            $melding->sendmessage = $request->sendmessage;
            $melding->status = 'approved';
            $melding->save();
        }
        return redirect()->route('melding')->with('success', 'Melding goedgekeurd.');
    }

    public function reject($id)
    {
        $melding = Melding::findOrFail($id);

        if ($melding->soort == 2) {
            $melding->status = 'rejected';
            $melding->save();

            $user = User::find($melding->userID);
            if ($user) {
                $user->leaveToken += 1;
                $user->save();
            }
            return view('melding-reject', compact('melding'));
        }

        return redirect()->route('melding')->with('error', 'Melding afgewezen.');
    }

    public function destroy(string $id)
    {
        $melding = Melding::findOrFail($id);
        $melding->delete();
        return redirect()->back();
    }
}
