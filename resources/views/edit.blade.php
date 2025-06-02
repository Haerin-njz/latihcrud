<!-- resources/views/books/edit.blade.php -->
@extends('layout')

@section('content')
<h2>Edit Buku</h2>
<form action="{{ route('books.update', $book->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Judul:</label><br>
    <input type="text" name="title" value="{{ $book->title }}" required><br><br>

    <label>Penulis:</label><br>
    <input type="text" name="author" value="{{ $book->author }}" required><br><br>

    <label>Tahun Terbit:</label><br>
    <input type="number" name="published_year" value="{{ $book->published_year }}" required><br><br>

    <button type="submit">Update</button>
</form>
@endsection
