<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['first_name','last_name','phone_number','email'];
    protected $table="tbl_students";
    protected $primaryKey="student_id";
    public $timestamps=FALSE;
}
