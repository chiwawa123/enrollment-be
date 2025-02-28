<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\StudentCourseController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


/////////////////////////////// DEPARTMENTS /////////////////////////////////////////////////

Route::get('departments', [DepartmentController::class, 'getDepartments']);
Route::post('addDepartment', [DepartmentController::class, 'addDepartment']);
Route::put('updateDepartment/{department_id}',[DepartmentController::class,'updateDepartment']);
Route::delete('deleteDepartment/{department_id}',[DepartmentController::class,'deleteDepartment']);
Route::get('getById/{department_id}',[DepartmentController::class,'getDepartmentById']);

//////////////////////////////////// Students /////////////////////////////////////////////////////

Route::get('students', [StudentController::class, 'getStudents']);
Route::post('addStudent', [StudentController::class, 'addStudent']);
Route::put('updateStudent/{student_id}',[StudentController::class,'updateStudent']);
Route::delete('deleteStudent/{student_id}',[StudentController::class,'deleteStudent']);
Route::get('getStudentById/{student_id}',[StudentController::class,'getStudentById']);


//////////////////////////////////// Courses /////////////////////////////////////////////////////

Route::get('courses', [CourseController::class, 'getCourses']);
Route::post('addCourse', [CourseController::class, 'addCourse']);
Route::put('updateCourse/{course_id}',[CourseController::class,'updateCourse']);
Route::delete('deleteCourse/{course_id}',[CourseController::class,'deleteCourse']);
Route::get('getCourseById/{course_id}',[CourseController::class,'getCourseById']);


//////////////////////////////////// StudentCourseAssignment /////////////////////////////////////////////////////

Route::post('assignCourse', [StudentCourseController::class, 'assignCourse']);
