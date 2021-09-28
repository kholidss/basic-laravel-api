<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profiles';

    protected $fillable = [
        'email',
        'city',
        'province',
        'phone'
    ];

    public function user()
    {
        return $this->hasOne(UserNew::class);
    }
}
