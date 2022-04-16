@extends('Template.Master.main')
@section('mainContent')
    <div class="container-fluid pt-3">
      @if (session()->has('error'))
      <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h5><i class="icon fas fa-ban"></i> Failed!</h5>
          {{ session('error') }}
        </div>
      @elseif(session()->has('success'))
      <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h5><i class="icon fas fa-check"></i> Success!</h5>
          {{ session('success') }}
      </div>
      @endif
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Book Data</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="/uploadbook" method="post" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Book Title</label>
                  <small class="text-danger">@error('title') {{ $message }} @enderror</small>
                  <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="exampleInputEmail1" placeholder="Enter Title" value="{{ old('title') }}">
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Category</label>
                            <select name="category" class="form-control" id="">
                              @foreach ($category as $cat)
                                <option value="{{ $cat->id_category }}">{{ $cat->category }}</option>
                              @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Bookshelf</label>
                            <select name="bookshelf" class="form-control" id="">
                              @foreach ($bookshelf as $bs)
                              <option value="{{ $bs->id_bookshelf }}">{{ $bs->nameBookshelf }}</option>
                              @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Recomendation For?</label>
                            <select name="try" class="form-control" id="">
                              <option value="0">Free for All</option>
                              @foreach ($kelas as $k)
                              <option value="{{ $k->id_kelas }}">{{ $k->kelas }}</option>
                              @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tax</label>
                            @error('tax') {{ $message }} @enderror
                            <input type="number" name="tax" class="form-control @error('tax') is-invalid @enderror" placeholder="tax" value="{{ old('tax') }}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Fine</label>
                            @error('fine') {{ $message }} @enderror
                            <input type="number" class="form-control @error('fine') is-invalid @enderror" placeholder="fine" name="fine" value="{{ old('fine') }}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Genre</label>
                            <input type="Text" class="form-control" placeholder="Genre" name="genre" value="{{ old('total') }}">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Total Books</label>
                            <small class="text-danger">@error('total') {{ $message }} @enderror</small>
                            <input type="number" class="form-control @error('total') is-invalid @enderror" placeholder="Total" name="total" value="{{ old('total') }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Book Image</label>
                  <small class="text-danger">@error('image')
                      {{ $message }}
                  @enderror</small>
                  <div class="input-group">
                    <input type="file" name="image" class=" @error('image') is-invalid @enderror">
                  </div>
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
        </div>
    </div>
@endsection