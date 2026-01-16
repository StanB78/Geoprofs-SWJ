<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;




    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'rol',
        'sectorID'
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



    public function sector()
    {
        return $this->belongsTo(Sector::class, 'sectorID');
    }
}
