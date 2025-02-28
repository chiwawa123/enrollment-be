<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
      // get all the students
      public function getStudents(){

        $students = Student::all();
        $studentCount = Student::all()->count();

        return response()->json($students);

    }
    public function addStudent(Request $request)
    {
        // Validate incoming data
        $validated = $request->validate([
            'first_name' => 'required|string',  // Ensure first_name is unique and required
            'last_name' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|string|max:255|unique:tbl_students,email',


        ]);

        $student = Student::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'phone_number' => $validated['phone_number'],
            'email' => $validated['email'],
        ]);

        return response()->json([
            'message' => 'student created successfully',
            'student' => $student,
        ]);
    }
    public function getStudentById(Request $request, $student_id){
        $student = Student::find($student_id);
        if(!$student){
            return response()->json(['message'=>'student not found']);
        }else{
            return response()->json($student);
        }
    }


    public function updateStudent(Request $request, $student_id)
    {
        $student = Student::find($student_id);
        if(is_null($student)){
            return response()->json(['message'=>'student not found'],404);

        }
        $student->update($request->all());
        return response()->json([
            'message' => 'student updated successfully',
            'student' => $student,
        ]);
    }

        public function deleteStudent($student_id)
        {
            $student = Student::find($student_id);
            if (!$student) {
                return response()->json(['message' => 'student not found'], 404);
            }

            $student->delete();
            return response()->json(['message' => 'student deleted'], 200);
        }
}
