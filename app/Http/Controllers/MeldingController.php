<?php

namespace App\Http\Controllers;

use App\Models\Melding;
use App\Models\User;
use Illuminate\Http\Request;

class MeldingController extends Controller
{
    /**
     * Show all meldingen
     */
    public function show()
    {
        // Load all meldingen
        $meldingen = Melding::all();

        // Attach the leaveToken from the related user
        foreach ($meldingen as $melding) {
            $user = User::find($melding->userID);
            $melding->leaveToken = $user ? $user->leaveToken : 0;
        }

        return view('melding', compact('meldingen'));
    }

    /**
     * Show confirmation page
     */
    public function confirm($id)
    {
        $melding = Melding::findOrFail($id);

        // Only verlof (2) can be confirmed
        if ($melding->soort != 2) {
            return redirect()->route('melding');
        }

        return view('melding-confirm', compact('melding'));
    }

    /**
     * Accept leave request
     */
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

    /**
     * Reject leave request
     */
    public function reject($id)
    {
        $melding = Melding::findOrFail($id);

        if ($melding->soort == 2) {

            // Update melding status
            $melding->status = 'rejected';
            $melding->save();

            // Restore leaveToken to user
            $user = User::find($melding->userID);
            if ($user) {
                $user->leaveToken += 1;
                $user->save();
            }

            // Show reject page (same as before)
            return view('melding-reject', compact('melding'));
        }

        return redirect()->route('melding')->with('error', 'Melding afgewezen.');
    }

    /**
     * Delete a melding
     */
    public function destroy($id)
    {
        $melding = Melding::findOrFail($id);
        $melding->delete();
        return redirect()->back();
    }
}
