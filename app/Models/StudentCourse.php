<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    use HasFactory;

    protected $fillable = ['student_id','course_id'];
    protected $table="tbl_student_courses";
    protected $primaryKey="student_course_id";
    public $timestamps=FALSE;


}
