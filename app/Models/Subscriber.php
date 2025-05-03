<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Barryvdh\LaravelIdeHelper\Eloquent;

/**
 * App\Models\Brand
 *
 * @property string $email
 *
 * @mixin Eloquent
 */
class Subscriber extends Model
{
    protected $fillable = [
        'email',
    ];

    public $timestamps = true;
    protected $table = 'subscribers';
}
