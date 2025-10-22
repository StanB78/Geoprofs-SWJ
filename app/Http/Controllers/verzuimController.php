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
            'melding' => 'required',
            'redenverzuim' => 'required',
        ]);

        $user = auth()->user();

        if ($request->redenverzuim == 2) {

            $user->leaveToken -= 1;
            $user->save();
        }

        Verzuim::create([
            'userID' => $user->id,
            'soort' => $request->redenverzuim,
            'melding' => $request->melding,
        ]);

        return redirect()->back();
    }
}
