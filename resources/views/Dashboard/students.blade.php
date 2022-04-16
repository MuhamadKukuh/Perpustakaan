@extends('Template.Master.main')
@section('mainContent')
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
          <th>Name</th>
          <th>NIS</th>
          <th>Gender</th>
          <th>Class</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($students as $student)
        <tr>
          <td>{{ $no++ }}</td>
          <td>
            <a href="/profile/{{ $student->username }}" class="text-white" >
                {{ $student->username }}
            </a>  
          </td>
          <td>{{ $student->nisFormat($student->nis) }}</td>
          <td>{{ $student->gender }}</td>
          <td>{{ $student->kelas }}</td>
          <td class="text-center">
              <a href="/deleteStudent/{{ $student->id }}" class="text-decoration-none text-white"><i class="fa-solid fa-delete-left"></i></a>
          </td>
        </tr>
        @endforeach
        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
  </div> 
@endsection