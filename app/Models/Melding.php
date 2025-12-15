<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Melding extends Model
{
    protected $table = 'meldingen';

    protected $primaryKey = 'meldingID';
    public $incrementing = true;
    protected $keyType = 'int';

    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }
}
