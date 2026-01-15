<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Melding;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MeldingController extends Controller
{
    /**
     * Show all meldingen
     */
    public function show()
    {
        $today = Carbon::today();

        $meldingen = Melding::all();

        foreach ($meldingen as $melding) {
            $melding->leaveToken = optional(
                User::find($melding->userID)
            )->leaveToken ?? 0;
        }

        $ziekVandaag = Melding::where('soort', 1)
            ->whereDate('startdatum', '<=', $today)
            ->whereDate('einddatum', '>=', $today)
            ->count();

        $verlofVandaag = Melding::where('soort', 2)
            ->where('status', 'approved')
            ->whereDate('startdatum', '<=', $today)
            ->whereDate('einddatum', '>=', $today)
            ->count();

        return view('melding', [
            'meldingen'     => $meldingen,
            'ziekVandaag'   => $ziekVandaag,
            'verlofVandaag' => $verlofVandaag,
        ]);
    }


    /**
     * Show confirmation page
     */
    public function confirm($id)
    {
        $melding = Melding::findOrFail($id);

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
     * Meldingen PDF (admin)
     */
    public function verzuimPdf()
    {
        if (!\App\Http\Middleware\RoleCheck::check(3)) {
            abort(403);
        }

        $meldingen = Melding::all();

        foreach ($meldingen as $melding) {
            $melding->leaveToken = optional(
                User::find($melding->userID)
            )->leaveToken ?? 0;
        }

        return Pdf::loadView('melding-pdf', compact('meldingen'))
            ->download('meldingen-log.pdf');
    }

    /**
     * Werknemers PDF (admin)
     */
    public function werknemersPdf()
    {
        if (!\App\Http\Middleware\RoleCheck::check(3)) {
            abort(403);
        }

        $users = User::all();

        return Pdf::loadView('werknemers-pdf', compact('users'))
            ->download('werknemers-log.pdf');
    }

    /**
     * Reject leave request
     */
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

        return redirect()->route('melding');
    }

    /**
     * Delete melding
     */
    public function destroy($id)
    {
        Melding::findOrFail($id)->delete();
        return redirect()->back();
    }
}
