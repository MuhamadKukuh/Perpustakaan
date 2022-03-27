@extends('Template.Books.main')
@section('booksContent')
<div class="card">
    <div class="card-header">
      <h3 class="card-title">DataTable with default features</h3>
    </div>
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-check"></i> Success!</h5>
        {{ session('success') }}
    </div> 
    @endif
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>No</th>
          <th>Books</th>
          <th>Categories</th>
          <th>Bookshelves</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($books as $book)
        <tr>
          <td>{{ $no++ }}</td>
          <td>
              {{ $book->bookTitle }}
          </td>
          <td>{{ $book->category }}</td>
          <td>{{ $book->nameBookshelf }}</td>
          <td class="text-center">
              <a href="/edit/{{ $book->id_books }}" class="text-decoration-none text-white"><i class="fa-solid fa-pen-to-square"></i></a>
              |
              <a href="/delete/{{ $book->id_books }}" class="text-decoration-none text-white"><i class="fa-solid fa-delete-left"></i></a>
          </td>
        </tr>
        @endforeach
        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
  </div> 
@endsection