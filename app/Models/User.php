<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'rol',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Stuur een testmail naar de gebruiker.
     *
     * @return void
     */
    public function sendTestMail(): void
    {
        \Mail::raw('Dit is een test e-mail.', function ($message) {
            $message->to($this->email)
                ->subject('Test e-mail voor reset password!');
        });
    }
}
