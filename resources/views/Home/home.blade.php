@extends('Template.Master.main')
@section('mainContent')
<div class="container-fluid">
  <div class="row">
      <div class="col-12 bg-dark rounded mt-2 pt-3 pb-3">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach ($crousel as $item)
                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $no++ }}" class="active"></li>    
                @endforeach
            </ol>
            {{-- <img src="{{  }}" alt=""> --}}
            <div class="carousel-inner">
                @foreach ($crousel as $item)
                {{-- @dd($item->bookImage) --}}
                <div class="carousel-item {{ $item->id_books == $crouselNo->id_books ? 'active' : 'none' }}" >
                <a href="{{ "/book/$item->id_books " }}">
                    <img class="d-block w-100" src="{{ asset('bookImages/'. $item->bookImage) }}" alt="First slide" style="max-height: 500px" >
                </a>
                  <p class=" badge badge-success d-flex justify-content-center " >New</p>
                  <h1 class="text-center" style="margin-bottom: 80px">{{ $item->bookTitle }}</h1> 
                </div>
                {{-- <p hidden>{{ $no++ }}</p> --}}
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
      </div>
  </div>
</div>

@endsection
