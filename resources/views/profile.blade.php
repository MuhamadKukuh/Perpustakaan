@extends('Template.Master.main')
@section('mainContent')
<div class="container-fluid">
    <div class="row">
      <div class="col-md-3">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle"
                   @if ($siswa->id_gender == 1)
                   src="{{ asset('/dist/img/user2-160x160.jpg') }}"
                   @else
                   src="{{ asset('/dist/img/user4-128x128.jpg') }}"
                   @endif
                   alt="User profile picture">
            </div>

            <h3 class="profile-username text-center">{{ $siswa->username }}</h3>

            <p class="text-muted text-center">{{ $siswa->nisFormat($siswa->nis) }}</p>

            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>Class</b> <a class="float-right">{{ $siswa->kelas->kelas }}</a>
              </li>
              <li class="list-group-item">
                <b>Books Borrowed</b> <a class="float-right">{{ $borrow->count() }}</a>
              </li>
            </ul>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- About Me Box -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">About Me</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
              <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
  
              <p class="text-muted">{{ $siswa->location }}</p>
  
              <hr>

              <strong>
                @if ($siswa->id_gender == 1)
                <i class="fa-solid fa-mars"></i>
                @else
                <i class="fa-solid fa-venus"></i>                
                @endif  
                Gender
              </strong>
  
              <p class="text-muted">{{ $siswa->gender->gender }}</p>
  
              <hr>
              
            <strong><i class="fas fa-pencil-alt mr-1"></i> Bio</strong>

            <p class="text-muted">
              {{ $siswa->bio }}
            </p>

            <hr>

            <strong><i class="far fa-file-alt mr-1"></i> Books Favorite</strong>

            <p class="text-muted">
              @foreach ($favorite as $fav)
                  <a href="/book/{{ $fav->id_book }}" class="text-white">{{ $fav->book->bookTitle }}</a>, 
              @endforeach
            </p>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activities</a></li>
              <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Histories</a></li>
              @if (Auth()->User()->id !== $siswa->id)
              
              @else
              <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
              @endif
            </ul>
            @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Failed!</h5>
                {{ session('error') }}
              </div>
            @elseif(session()->has('succes'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Success!</h5>
                {{ session('succes') }}
            </div>
            @endif
            
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <!-- Post -->
                @foreach ($activities as $activity)
                @if (substr($activity->created_at, 0, 10) == date('Y-m-d'))
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="{{ '/bookImages/'. $activity->books->bookImage }}" alt="user image">
                    <span class="username">
                      <h5 class="text-info">Try to borrow Book</h5>
                    </span>
                    {{-- {{ substr($activity->created_at, 0, 10) }} --}}
                    <span class="description"> try to borrow {{ $activity->created_at->diffForHumans() }} today</span>
                    {{-- @endforeach --}}
                  </div>
                  <!-- /.user-block -->

                  <p>
                    {{ $siswa->username }} try Borrowing Book <a href="/book/{{ $activity->id_books }}">{{ $activity->books->bookTitle }}</a> {{ $activity->totalborrw }} piece
                    <span class="float-right">
                    </span>
                  </p>

                  {{-- <input class="form-control form-control-sm" type="text" placeholder="Type a comment"> --}}
                </div>
                @endif
                @endforeach
                <!-- /.post -->
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <!-- The timeline -->
                <div class="timeline timeline-inverse">
                  <!-- timeline time label -->
                  <div class="time-label">
                    <span class="bg-danger">
                      History
                    </span>
                  </div>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  @foreach ($histories as $history)
                  @if ($history->status == 0)
                      @continue
                  @endif
                  <div>
                    <i class="fas fa-envelope bg-primary"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="far fa-clock"></i> {{ $history->created_at->diffForHumans() }}</span>

                    
                     @if ($history->status == 1)
                     
                     <h3 class="timeline-header bg-success"><a href="#">Admin</a> sent you an email</h3>
                     <div class="timeline-body">
                       Succes, Admin acc for borrow book <a href="/book/{{ $history->id_books }}">{{ $history->books->bookTitle }}</a> {{ $history->total }}
                     </div>
                     @elseif($history->status == 5)
                     <h3 class="timeline-header bg-danger"><a href="">Admin</a> sent you an email</h3>
                     <div class="timeline-body">
                      Failed, Admin Reject you for borrow book <a href="/book/{{ $history->id_books }}">{{ $history->books->bookTitle }}</a> {{ $history->total }}
                     </div>
                     @elseif($history->status == 2)
                     <h3 class="timeline-header bg-success"><a href="#">Admin</a> sent you an email</h3>
                     <div class="timeline-body">
                       Succes, Return book <a href="/book/{{ $history->id_books }}">{{ $history->books->bookTitle }}</a> {{ $history->total }}
                     </div>
                     @endif
                    </div>
                  </div>
                  @endforeach
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <div>
                    <i class="far fa-clock bg-gray"></i>
                  </div>
                </div>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
                <form class="form-horizontal" action="/update-profile/{{ $siswa->id }}" method="post">
                @csrf
                  <div class="form-group row">
                    <label for="inputExperience" class="col-sm-2 col-form-label">Bio</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputExperience" placeholder="Bio" name="bio">{{ $siswa->bio }}</textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputSkills" class="col-sm-2 col-form-label">Location</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Location" name="location" value="{{ $siswa->location }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="cek"> I agree to the <a href="#">terms and conditions</a>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
@endsection