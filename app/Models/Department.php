<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['department_name'];
    protected $table="tbl_departments";
    protected $primaryKey="department_id";
    public $timestamps=FALSE;
}
