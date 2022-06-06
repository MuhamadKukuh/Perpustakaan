@extends('Template.Master.main')
@section('mainContent')
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Message | <a href="#" class="swal-confirmation text-decoration-none text-white" style="font-size: 10px">clear all</a></h3>
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
          <th>User</th>
          <th>Book Borrow</th>
          <th>Total Borrow</th>
          <th>Deadline</th>
          <th>Confirmation</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($confirmation as $confirm)
        <tr>
          <td>{{ $no++ }}</td>
          <td>
              {{ $confirm->user->username }}
          </td>
          <td>{{ $confirm->book->bookTitle }}</td>
          <td>{{ $confirm->total }}</td>
          <td>{{ $confirm->deadline }}</td>
          <td class="text-center">
              <a href="/confirm/{{ $confirm->id_transaction }}" class="btn btn-primary">Confirm</a>
              |
              <a href="#" data-id="{{ $confirm->id_transaction }}" class="swal-confirmation btn btn-danger">delete</a>
          </td>
        </tr>
        @endforeach
        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
  </div> 

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

          if(id != null){
            window.location = "/deleteconfirm/"+ id +""
          }else{
            window.location = "/destroyAll"
          }
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