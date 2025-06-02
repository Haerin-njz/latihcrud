<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class BookApiController extends Controller
{
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
public function editBook(Request $request, $id)
{
    $book = Book::find($id);
    if (!$book) {
        return response()->json(['message' => 'Book not found'], 404);
    }

    $book->update([
        'title' => $request->title,
        'author' => $request->author,
        'published_year' => $request->published_year,
    ]);

    return response()->json([
        'message' => 'Book updated successfully',
        'data' => $book,
    ]);
}

}
