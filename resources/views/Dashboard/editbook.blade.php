@extends('Template.Master.main')
@section('mainContent')
    <div class="container-fluid pt-3">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Book Data</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="/updatebook/{{ $books->id_books }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Book Title</label>
                  <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="Book Title" value="{{ !old('bookTitle') ? $books->bookTitle : old('title') }}">
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
                              <option value="0">Free For all</option>
                              @foreach ($kelas as $recom)
                              <option value="{{ $recom->id_kelas }}">{{ $recom->kelas }}</option>
                              @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tax</label>
                            <input type="number" class="form-control" placeholder="tax" name="tax" value="{{ !old('tax') ? $books->tax : old('tax') }}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Fine</label>
                            <input type="number" class="form-control" placeholder="fine" name="fine" value="{{ !old('fine') ? $books->fine : old('fine') }}">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Total</label>
                            <input type="number" class="form-control" placeholder="total book" name="total" value="{{ !old('bookTotal') ? $books->bookTotal : old('total') }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Book Image</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name="image" class="" id="exampleInputFile">
                      {{-- <label class="custom-file-label" for="exampleInputFile"></label> --}}
                    </div>
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