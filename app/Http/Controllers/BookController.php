<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function createBook(Request $request) 
    { 
        $book = Book::create($request->all());
        return response()->json($book, 201);
    }

    public function getBook($id)
    {
        $book = Book::find($id);
        if ($book) {
            return response()->json($book);
        }
        return response()->json(['message' => 'Book not found'], 404);
    }
    
    public function editBook(Request $request, $id)
    {
        $book = Book::find($id);
        if ($book) {
            $book->update($request->all());
            return response()->json($book);
        }
        return response()->json(['message' => 'Book not found'], 404);
    }

    public function deleteBook($id)
    {
        $book = Book::find($id);
        if ($book) {
            $book->delete();
            return response()->json(['message' => 'Book deleted.']);
        }
        return response()->json(['message' => 'Book not found'], 404);
    }
}
