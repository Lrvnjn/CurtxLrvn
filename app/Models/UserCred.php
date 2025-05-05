<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCred extends Model
{
    use HasFactory;

    // Declare table name if not following Laravel naming convention.
    protected $table = 'user_creds';

    // Define which attributes are mass assignable.
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
        'municipality',
        'status',
    ];
}
