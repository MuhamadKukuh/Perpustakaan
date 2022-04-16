@extends('Template.Master.main')
@section('mainContent')
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Message | <a href="/destroyAll" class="text-decoration-none text-white" style="font-size: 10px">clear all</a></h3>
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
              <a href="/deleteconfirm/{{ $confirm->id_transaction }}" class="btn btn-danger">delete</a>
          </td>
        </tr>
        @endforeach
        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
  </div> 
@endsection