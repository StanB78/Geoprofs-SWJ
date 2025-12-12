<?php

use App\Http\Controllers\Api\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\MailTestController;
use App\Http\Controllers\MeldingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\verzuimController;
use App\Models\PasswordResetCode;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::post('/password/forgot', [ForgotPasswordController::class, 'sendResetLink'])
    ->name('password.email');

Route::get('/send-mail', [MailTestController::class, 'send']);

Route::post('/password/forgot', [ForgotPasswordController::class, 'sendResetLink']);
Route::post('/password/reset', [ResetPasswordController::class, 'reset']);

Route::get('/', function () {
    return view('welcome');
});
Route::post('/password/forgot', [ForgotPasswordController::class, 'sendResetLink'])
    ->name('password.email');



Route::get('/password/forgot', function () {
    return view('mails.reset-password');
})->name('password.request');

Route::post('/password/forgot', [ForgotPasswordController::class, 'sendResetLink'])
    ->name('password.email');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/register', function () {
    return view('auth.register');
})->middleware('rolecheck:3')->name('register');

Route::get('/melding', [MeldingController::class, 'show'])
    ->middleware('rolecheck:2')
    ->name('melding');


Route::post('/register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'store']);


Route::middleware('auth')->group(function () {
    Route::get('/verzuim', function () {
        return view('verzuim');
    })->name('verzuim.create');

    Route::post('/verzuim', [verzuimController::class, 'store'])->name('verzuim');
});


Route::middleware('auth')->group(function () {
    Route::get('/melding', [MeldingController::class, 'show'])->middleware('rolecheck:2')->name('melding');
    Route::get('/melding/{id}/confirm', [MeldingController::class, 'confirm'])->name('melding.confirm');
    Route::post('/melding/{id}/accept', [MeldingController::class, 'accept'])->name('melding.accept');
});
Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email|exists:users,email']);

    $code = rand(100000, 999999);

    PasswordResetCode::updateOrCreate(
        ['email' => $request->email],
        ['code' => $code, 'expires_at' => Carbon::now()->addMinutes(10)]
    );

    Mail::raw("Je wachtwoord-resetcode is: $code (geldig tot 10 minuten).", function ($message) use ($request) {
        $message->to($request->email)
            ->subject('Je wachtwoord-resetcode');
    });

    return response()->json([
        'status' => 'success',
        'message' => 'Er is een e-mail gestuurd met je verificatiecode.'
    ]);
});
