<!-- resources/views/books/index.blade.php -->
@extends('layout')

@section('content')
<h2>Daftar Buku</h2>
<a href="{{ route('books.create') }}">Tambah Buku Baru</a>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Tahun Terbit</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($books as $book)
        <tr>
            <td>{{ $book->title }}</td>
            <td>{{ $book->author }}</td>
            <td>{{ $book->published_year }}</td>
            <td>
                <a href="{{ route('books.edit', $book->id) }}">Edit</a> |
                <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Yakin hapus buku ini?')" type="submit">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
