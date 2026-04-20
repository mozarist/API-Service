<?php

namespace App\Http\Controllers;

use App\Models\book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = book::all();

        return response()->json([
            'message' => 'List of all books',
            'data' => $books
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'stock' => 'required|integer|min:0'
        ]);

        $book = book::create($request->all());

        return response()->json([
            'message' => 'Book data created successfully',
            'data' => $book
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = book::findOrFail($id);

        return response()->json([
            'message' => 'Successfully get book data',
            'data' => $book
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = book::findOrFail($id);

        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'author' => 'sometimes|required|string|max:255',
            'stock' => 'sometimes|required|integer|min:0'
        ]);

        $book->update($request->all());

        return response()->json([
            'message' => 'Book data updated successfully',
            'data' => $book
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = book::findOrFail($id);
        $book->delete();

        return response()->json([
            'message' => 'Book data deleted successfully'
        ], 200);
    }
}
