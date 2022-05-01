@extends('Template.Master.main')
@section('mainContent')
<div class="container-fluid">
    <!-- Info boxes -->
    <div class="row">
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
          <span class="info-box-icon bg-info elevation-1"><i class="fa-solid fa-user-group"></i></span>

          <a href='/students' class="info-box-content" class="text-decoration-none text-white">
            <span class="info-box-text text-white">Student's</span>
            <span class="info-box-number text-white">
              {{ $students->count() }}
            </span>
          </a>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-danger elevation-1"><i class="fa-solid fa-book"></i></span>

          <a href="/books" class="info-box-content">
            <span class="info-box-text text-white">Book's</span>
            <span class="info-box-number text-white">{{ $book->count() }}</span>
          </a>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix hidden-md-up"></div>

      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-success elevation-1"><i class="fa-solid fa-swatchbook"></i></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Returning Book</span>
            <span class="info-box-number">{{ $return->count() }}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>

      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-warning elevation-1"><i class="fa-solid fa-envelope"></i></span>

          <a href="/message" class="info-box-content text-white">
            <span class="info-box-text">New Message's</span>
            <span class="info-box-number">{{ $message->count() }}</span>
          </a>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
    </div>
    <!-- /.row -->

    <!-- /.row -->

    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <div class="col-md-8">
        <!-- /.card -->
        <div class="card">
            <div class="card-header border-transparent">
              <h3 class="card-title">Book's Borrowed</h3>
  
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table m-0">
                  <thead>
                  <tr>
                    <th>User</th>
                    <th>Item</th>
                    <th>Status</th>
                    <th>Deadline</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($borrowed as $borrow)
                  @if ($borrow->status == 2)
                      @continue
                  @endif
                  <tr>
                    <td><a href="/profile/{{ $borrow->user->username }}">{{ $borrow->user->username }}</a></td>
                    <td><a href="/book/{{ $borrow->book->id_books }}" class="text-white">{{ $borrow->book->bookTitle }}</a></td>
                    @if ($borrow->status == 0)
                    <td><span class="badge badge-primary">Processing</span></td>
                    @else
                    <td><span class="badge badge-info">Borrowed</span></td>
                    @endif
                    <td>
                      <div class="sparkbar" data-color="#00a65a" data-height="20">{{ $borrow->deadline }}</div>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
              {{-- <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a> --}}
              <a href="javascri" class="btn btn-sm btn-secondary float-right">See More..</a>
            </div>
            <!-- /.card-footer -->
        </div>
      </div>
      <!-- /.col -->

      <div class="col-md-4">
        {{-- Belum ada isi --}}
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Online</h3>

              <div class="card-tools">
                <span class="badge badge-success">{{ count($onlineUsers) }} Online Users</span>
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <ul class="users-list clearfix">
                @foreach ($onlineUsers as $onlineUser)
                <li>
                  @if ($onlineUser->id_gender == 1)
                  <img src="dist/img/user2-160x160.jpg" alt="User Image">
                  @else
                  <img src="dist/img/user4-128x128.jpg" alt="User Image">
                  @endif
                  <a class="users-list-name" href="/profile/{{ $onlineUser->username }}">{{ $onlineUser->username }}</a>
                  <span class="users-list-date">{{ $onlineUser->updated_at->diffForHumans() }}</span>
                </li>
                @endforeach
              </ul>
              <!-- /.users-list -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-center">
              <a href="/students">View All Users</a>
            </div>
            <!-- /.card-footer -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!--/. container-fluid -->
@endsection