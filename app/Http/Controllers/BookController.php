<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class BookApiController extends Controller
{
    // CREATE
    public function createBook(Request $request)
    {
        $book = Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'published_year' => $request->published_year
        ]);

        return response()->json([
            'message' => 'Book created successfully',
            'data' => $book
        ], 201);
    }

    // READ
    public function getBook($id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        return response()->json($book);
    }

    // UPDATE
    public function editBook(Request $request, $id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $book->update($request->all());

        return response()->json([
            'message' => 'Book updated successfully',
            'data' => $book
        ]);
    }

    // DELETE
    public function deleteBook($id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $book->delete();

        return response()->json(['message' => 'Book deleted successfully']);
    }
}
