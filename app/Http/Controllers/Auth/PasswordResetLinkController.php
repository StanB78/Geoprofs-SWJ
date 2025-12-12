<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use App\Mail\ResetPasswordMail;

class PasswordResetLinkController extends Controller
{
    /**
     * Toon het formulier voor het aanvragen van een wachtwoord-reset.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Verwerking van een wachtwoord-resetlink verzoek.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // Genereer een wachtwoord-resetlink
        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            // Optioneel: verstuur aangepaste e-mail
            $resetUrl = url(route('password.reset', ['token' => 'dummy_token'], false));
            Mail::to($request->email)->send(new ResetPasswordMail($resetUrl));

            return back()->with('status', __($status));
        }

        return back()->withInput($request->only('email'))
            ->withErrors(['email' => __($status)]);
    }
}
