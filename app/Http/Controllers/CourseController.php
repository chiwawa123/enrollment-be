<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    // get all the courses
    public function getCourses(){

        $courses = DB::select('SELECT
	tbl_departments.department_name,
	tbl_departments.department_id,
	tbl_courses.course_code,
	tbl_courses.course_name,
	tbl_courses.course_id
FROM
	tbl_courses
	INNER JOIN tbl_departments ON tbl_courses.department_id = tbl_departments.department_id');

        return response()->json($courses);

    }
    public function addCourse(Request $request)
    {
        // Validate incoming data
        $validated = $request->validate([
            'course_name' => 'required|string|max:255|unique:tbl_courses,course_name',  // Ensure course_name is unique and required
            'course_code' => 'required|string',  // Ensure course_code is unique and required
            'department_id' => 'required',  // Ensure department_id is required


        ]);

        $course = Course::create([
            'course_name' => $validated['course_name'],
            'course_code' => $validated['course_code'],
            'department_id' => $validated['department_id'],
        ]);

        return response()->json([
            'message' => 'course created successfully',
            'course' => $course,
        ]);
    }
    public function getCourseById(Request $request, $course_id){
        $course = Course::find($course_id);
        if(!$course){
            return response()->json(['message'=>'course was not found']);
        }else{
            return response()->json($course);
        }
    }


    public function updateCourse(Request $request, $course_id)
    {
        $course = Course::find($course_id);
        if(is_null($course)){
            return response()->json(['message'=>'course not found'],404);

        }
        $course->update($request->all());
        return response()->json([
            'message' => 'course updated successfully',
            'course' => $course,
        ]);
    }

        public function deleteCourse($course_id)
        {
            $course = Course::find($course_id);
            if (!$course) {
                return response()->json(['message' => 'course not found'], 404);
            }

            $course->delete();
            return response()->json(['message' => 'course deleted'], 200);
        }
}
