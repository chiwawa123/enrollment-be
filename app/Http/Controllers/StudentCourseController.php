<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\StudentCourse;

class StudentCourseController extends Controller
{
    public function assignCourse(Request $request)
    {
        $student_id = $request->input('student_id');
        $courseIds = $request->input('course_ids');

        // Validate that course_ids is an array with 1 to 4 items
        if (!is_array($courseIds) || count($courseIds) < 1 || count($courseIds) > 4) {
            return response()->json(['message' => 'Please assign at least 1 and no more than 4 courses.'], 400);
        }

        // Get the count of courses already assigned to the student
        $existingCount = StudentCourse::where('student_id', $student_id)->count();
        if ($existingCount + count($courseIds) > 4) {
            return response()->json(['message' => 'Student cannot be assigned more than 4 courses in total.'], 400);
        }

          // Check for courses that are already assigned and get their names
    $alreadyAssigned = [];
    foreach ($courseIds as $course_id) {
        $existingCourse = StudentCourse::where('student_id', $student_id)
                                        ->where('course_id', $course_id)
                                        ->exists();

        if ($existingCourse) {
            $courseName = Course::where('course_id', $course_id)->value('course_name'); // Get the course name
            $alreadyAssigned[] = $courseName;
        }
    }

    if (!empty($alreadyAssigned)) {
        return response()->json([
            'message' => 'The following courses are already assigned: ' . implode(', ', $alreadyAssigned)
        ], 400);
    }


        // Proceed to assign courses if none are duplicates
        foreach ($courseIds as $course_id) {
            $studentCourse = new StudentCourse();
            $studentCourse->student_id = $student_id;
            $studentCourse->course_id = $course_id;
            $studentCourse->save();
        }

        return response()->json(['message' => 'Courses assigned successfully']);
    }


}
