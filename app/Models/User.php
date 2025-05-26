<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; //T
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    // Kolom-kolom pada tabel untuk tabel 'users'
    protected $fillable = [
        'fullname',
        'email',
        'password',
    ];

    protected $table = 'users';

    use HasFactory;
}
