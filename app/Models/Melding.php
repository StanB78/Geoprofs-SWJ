<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Melding extends Model
{
    protected $table = 'meldingen';

    // Tell Laravel the primary key is 'meldingID'
    protected $primaryKey = 'meldingID';

    // Optional but recommended
    public $incrementing = true;  // it is auto-increment
    protected $keyType = 'int';
}
