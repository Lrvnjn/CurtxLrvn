<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminCred extends Model
{
    use HasFactory;

    // Specify the table name (optional if it follows Laravel conventions)
    protected $table = 'admin_cred';

    // Allow these fields to be mass-assigned
    protected $fillable = ['name', 'username', 'password'];
}
