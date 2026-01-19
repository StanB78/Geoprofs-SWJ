<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\verzuimController;
use App\Http\Controllers\MeldingController;
use App\Models\Melding;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Models\User;


Route::get('/cypress/random-user', function () {
    $user = User::inRandomOrder()->first();
    return response()->json([
        'email' => $user->email,
        'password' => 'password'
    ]);
});



Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




Route::get('/berichten', function () {
    $meldingen = Melding::all();
    $users = User::all();
    return view('berichten', compact('meldingen', 'users'));
})->name('berichten');



Route::get('/about', function () {
    return view('about');
})->name('about');



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

Route::get('/melding/pdf', [MeldingController::class, 'verzuimPdf'])
    ->name('melding.pdf');

Route::get('/werknemers/pdf', [MeldingController::class, 'werknemersPdf'])
    ->name('werknemers.pdf');

Route::middleware('auth')->group(function () {
    Route::get('/melding', [MeldingController::class, 'show'])->middleware('rolecheck:2')->name('melding');
    Route::get('/melding/{id}/confirm', [MeldingController::class, 'confirm'])->name('melding.confirm');
    Route::post('/melding/{id}/accept', [MeldingController::class, 'accept'])->name('melding.accept');
    Route::get('/melding/{id}/reject', [MeldingController::class, 'confirmReject'])->name('melding.reject.confirm');
    Route::post('/melding/{id}/reject', [MeldingController::class, 'reject'])->name('melding.reject');


});

