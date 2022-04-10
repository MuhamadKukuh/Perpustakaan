@extends('Template.Profile.main')
@section('profileContent')
<!-- Default box -->
<div class="card card-solid">
    
    <div class="card-body">
      <div class="row">
        <div class="col-12 col-sm-6">
          <h3 class="d-inline-block d-sm-none">{{ $book->bookTitle }}</h3>
          <div class="col-12">
            <img src="{{ asset('/bookImages/'. $book->bookImage . '') }}" class="product-image" alt="Product Image">
          </div>
        </div>
        <div class="col-12 col-sm-6">
          <h2 class="my-3">{{ $book->bookTitle }}</h2>
          <p class="text-danger"><i class="fa-solid fa-triangle-exclamation"></i>Warning fine if the book is lost according to the price of the book</p>
          <hr>
          <h4>Genre : {{ $book->genre }}</h4>
          <h5>Recomend For : {{ $book->id_kelas == 0 ? "For All" : $book->kelas->kelas  }}</h5>

          <h6 class="mt-3">Location : {{ $book->bookshelf->nameBookshelf }}</h6>
          <h6 class="mt-3">Book Total : {{ $book->bookTotal }}</h6>
          
          <div class="bg-gray py-2 px-3 mt-4">
            <h2 class="mb-0">
              Rp {{ $book->numberFormat($book->fine) }}
            </h2>
            <h4 class="mt-0">
              <small>Tax: Rp {{ $book->numberFormat($book->tax) }} (if the book is returned late)</small>
            </h4>
          </div>

          <div class="mt-4">
            @if ($book->bookTotal == 0 )
            <button class="btn btn-secondary btn-lg btn-flat">
              out of stock
            </button> 
            @else
            <button class="btn btn-primary btn-lg btn-flat" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
              Borrow Book
            </button>
            @endif

            @if ($favorite == null)
            <a href="/addFavorite/{{ $book->id_books }}" class="btn btn-default btn-lg btn-flat">
              <i class="fa-regular fa-heart"></i>
              Add to Favorite
            </a>
            @else
            <a href="/dropFavorite/{{ $book->id_books }}" class="btn btn-default btn-lg btn-flat">
            <i class="fas fa-heart fa-lg mr-2"></i>
            Drop Favorite
            @endif
            </a>
          </div>
          
          <div class="mt-4 product-share">
            <p class="text-gray"><i class="fa-solid fa-eye"></i> {{ $viewer->count() }}</p>
          </div>

        </div>
      </div>
      <div class="row mt-4">
        <nav class="w-100">
          <div class="nav nav-tabs" id="product-tab" role="tablist">
            <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Recomendation</a>
          </div>
        </nav>
        <div class="tab-content p-3" id="nav-tabContent">
          <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab">
              <div class="row">
                  @foreach ($recomendations as $recomend)
                  @if($recomend->id_books == $book->id_books)
                    @continue
                  @endif
                  <div class="col-4 result">
                    <div class=" card" style="width: 18rem;">
                      <img src="/bookImages/{{ $recomend->bookImage }}" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title text-white">{{ $recomend->bookTitle }}</h5>
                        <p class="card-text"></p>
                        <a href="/book/{{ $recomend->id_books }}" class="btn btn-primary">Go somewhere</a>
                      </div>
                    </div>
                  </div>
                  @endforeach
              </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.card-body -->
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Form</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/borrow/{{ $book->id_books }}" method="POST">
          @csrf
            <div class="modal-body">
                how many books did you borrow?
                <input type="number" name="count">
                <div class="row">
                  <div class="col-12">
                  </div>
                  <div class="col-12">
                    <input type="date" name="date">
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <div type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</div>
              <button class="btn btn-primary">Send</button>
            </div>
        </form>
      </div>
    </div>
  </div>
<!-- /.card -->
@endsection