<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Department;

class DepartmentController extends Controller
{
    

    public function victims(Request $request)
    {

        $department = Department::with(['users'=> function($query){
            $query->orderBy('name', 'ASC');
        }])->where('name', $request->departamento)->first();
        return response()->json($department);

    }
}
