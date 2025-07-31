<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WizardForm extends Model
{
    use HasFactory;
    protected $table ='wizard_forms';

    protected $fillable =[
        'fname',
        'lname',
        'birth',
        'email',
        'password',
    ];
}
