<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Profile extends Authenticatable
{
    use Notifiable;
    protected $table = 'sinhvien';
    protected $fillable = [
        'hoten', 'email',
    ];
}
