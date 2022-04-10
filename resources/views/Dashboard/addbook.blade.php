@extends('Template.Profile.main')
@section('profileContent')
    <div class="container-fluid pt-3">
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
                  <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="Enter Title" value="{{ old('title') }}">
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
                            <input type="number" name="tax" class="form-control" placeholder="tax" value="{{ old('tax') }}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Fine</label>
                            <input type="number" class="form-control" placeholder="fine" name="fine" value="{{ old('fine') }}">
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
                            <input type="number" class="form-control" placeholder="Total" name="total" value="{{ old('total') }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Book Image</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text">Upload</span>
                    </div>
                  </div>
                </div>
                <input type="file" name="image">
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
        </div>
    </div>
@endsection