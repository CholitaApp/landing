<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    public string $email;
    protected $fillable = [
        'email',
    ];

    public $timestamps = true;
    protected $table = 'subscribers';
}
