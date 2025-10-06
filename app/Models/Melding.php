<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Melding extends Model
{
    use HasFactory;

    // Explicitly tell Laravel which table this model uses (optional if it's plural of model name)
    protected $table = 'meldingen';

    protected $fillable = [
        'userID',
        'soort',
        'melding',
    ];
}
