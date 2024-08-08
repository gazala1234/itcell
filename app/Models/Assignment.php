<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Assignment extends Model
{
    protected $table = 'academic_year';
    protected $fillable = ['id', 'academic_year', 'cid'];
    public static function getAcademicYears()
    {
        $cid = Session::get('cid');
        return self::where('cid', $cid)
            ->orderBy('id', 'asc')
            ->get();
    }
}
