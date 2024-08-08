<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyProfile extends Model
{
    use HasFactory;
    // Specify the table name
    protected $table = 'admin';

    // Specify the primary key
    protected $primaryKey = 'id';

    // Auto-incrementing key
    public $incrementing = true;

    // Specify if the primary key is not an integer
    protected $keyType = 'bigint';

    // Disable timestamps if not using created_at and updated_at fields
    public $timestamps = true;

    // Fillable fields (optional, specify fields that can be mass-assigned)
    protected $fillable = [
        'name', 'designation', 'role', 'college', 'dept', 
        'email', 'mobile', 'dob', 'gender','id'
    ];
}
