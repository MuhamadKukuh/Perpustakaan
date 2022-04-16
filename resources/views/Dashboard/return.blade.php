@extends('Template.Master.main')
@section('mainContent')
<div class="card">
    <div class="card-header">
      <h3 class="card-title">DataTable with default features | <a href="/addbook" class="text-decoration-none text-white" style="font-size: 10px">Add Book</a></h3>
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
          <th>Borrower</th>
          <th>NIS</th>
          <th>totalBorrow</th>
          <th>Book Borrowed</th>
          <th>Deadline</th>
          <th>Tax</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($data as $d)
        @if ($d->status == 0)
            @continue
        @endif
        <tr>
          <td>{{ $no++ }}</td>
          <td>
            <a href="/profile/{{ $d->user->username }}" class="text-white text-decoration-none">
              {{ $d->user->username }}
            </a>
          </td>
          <td>
            {{ $d->user->nisFormat($d->user->nis) }}
          </td>
          <td>{{ $d->total }}</td>
          <td>{{ $d->book->bookTitle }}</td>
          <td>{{ $d->deadline }}</td>
          <td>Rp {{ $d->countTax($d->book->tax, $d->deadline, $d->total) }}</td>
          <td>
              @if ($d->status == 1)
                  Borrowed
              @else
                  Returned
              @endif
          </td>
          <td class="text-center">
            @if ($d->status == 1)
                <a href="/returnBook/{{ $d->id_transaction }}" class="btn btn-primary">Return</a>
            @else
                Returned
            @endif
          </td>
        </tr>
        @endforeach
        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
  </div> 
@endsection