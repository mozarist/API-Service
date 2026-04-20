<?php

namespace App\Http\Controllers;

use App\Models\student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = student::all();

        return response()->json([
            'message' => 'List of all students',
            'data' => $students
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'class' => 'required|integer',
            'major' => 'required|string|max:255',
            'hobby' => 'required|in:reading,sports,music'
        ]);

        $student = student::create($request->all());

        return response()->json([
            'message' => 'Student data created successfully',
            'data' => $student
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = student::findOrFail($id);

        return response()->json([
            'message' => 'Succesfully get student data',
            'data' => $student
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student = student::findOrFail($id);

        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'class' => 'sometimes|required|integer',
            'major' => 'sometimes|required|string|max:255',
            'hobby' => 'sometimes|required|in:reading,sports,music'
        ]);

        $student->update($request->all());

        return response()->json([
            'message' => 'Student data updated successfully',
            'data' => $student
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = student::findOrFail($id);

        $student->delete();

        return response()->json([
            'message' => 'Student data deleted successfully'
        ], 200);
    }
}
