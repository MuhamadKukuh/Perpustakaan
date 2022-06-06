@extends('Template.Master.main')
@section('mainContent')
<div class="card">
    <div class="card-header">
      <h3 class="card-title">Books Data | <a href="/addbook" class="btn btn-primary text-decoration-none text-white" style="font-size: 10px">Add Book</a></h3>
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
            <a href="/book/{{ $book->id_books }}" class="text-white text-decoration-none">
              {{ $book->bookTitle }}
            </a>
          </td>
          <td>{{ $book->category }}</td>
          <td>{{ $book->nameBookshelf }}</td>
          <td class="text-center">
              <a href="/editbook/{{ $book->id_books }}"  class="text-decoration-none text-white"><i class="fa-solid fa-pen-to-square"></i></a>
              |
              <a href="#" data-id="{{ $book->id_books }}" id="deleteData" class="swal-confirmation text-decoration-none text-white"><i class="fa-solid fa-delete-left"></i></a>
          </td>
        </tr>
        @endforeach
        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
  </div> 

  {{-- Js sementara --}}
  <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    $('.swal-confirmation').click(function(){
      const id = $(this).attr('data-id')

      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })

      swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          swalWithBootstrapButtons.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
            )
            window.location = "/delete/"+ id +""
          } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            'Cancelled',
            'Your imaginary file is safe :)',
            'error'
          )
        }
      })
    });
  
  </script>
  
@endsection