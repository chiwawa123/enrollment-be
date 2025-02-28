<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    //
    public function getDepartments(){

        $departments = Department::all();

        return response()->json($departments);

    }
    public function addDepartment(Request $request)
    {
        // Validate incoming data
        $validated = $request->validate([
            'department_name' => 'required|string|max:255|unique:tbl_departments,department_name',  // Ensure name is unique and required

        ]);

        $department = Department::create([
            'department_name' => $validated['department_name'],
        ]);

        return response()->json([
            'message' => 'Department created successfully',
            'department' => $department,
        ]);
    }
    public function getDepartmentById(Request $request, $department_id){
        $department = Department::find($department_id);
        if(!$department){
            return response()->json(['message'=>'department not found']);
        }else{
            return response()->json($department);
        }
    }


    public function updateDepartment(Request $request, $department_id)
    {
        $department = Department::find($department_id);
        if(is_null($department)){
            return response()->json(['message'=>'department not found'],404);

        }
        $department->update($request->all());
        return response()->json([
            'message' => 'Department updated successfully',
            'department' => $department,
        ]);
    }

        public function deleteDepartment($department_id)
        {
            $department = Department::find($department_id);
            if (!$department) {
                return response()->json(['message' => 'department not found'], 404);
            }

            $department->delete();
            return response()->json(['message' => 'department deleted'], 200);
        }

}
