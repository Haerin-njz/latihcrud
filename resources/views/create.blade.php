<!-- resources/views/books/create.blade.php -->
@extends('layout')

@section('content')
<h2>Tambah Buku Baru</h2>
<form action="{{ route('books.store') }}" method="POST">
    @csrf
    <label>Judul:</label><br>
    <input type="text" name="title" required><br><br>

    <label>Penulis:</label><br>
    <input type="text" name="author" required><br><br>

    <label>Tahun Terbit:</label><br>
    <input type="number" name="published_year" required><br><br>

    <button type="submit">Simpan</button>
</form>
@endsection
