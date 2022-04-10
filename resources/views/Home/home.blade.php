@extends('Template.Dashboard.main')
@section('dashboardContent')
<div class="container-fluid">
  <h2 class="text-center display-4">Search</h2>
  <div class="row">
      <div class="col-md-8 offset-md-2">
          <form action="simple-results.html">
              <div class="input-group">
                  <input type="search" class="form-control form-control-lg searchbox-input" placeholder="Type your keywords here" >
                  <div class="input-group-append">
                      <button type="submit" class="btn btn-lg btn-default">
                          <i class="fa fa-search"></i>
                      </button>
                  </div>
              </div>
          </form>
      </div>
  </div>
  {{-- Result --}}
  <div class="container">
    <div class="row pt-3">
        <div class="card card-primary card-tabs">
          <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
              <li class="pt-2 px-3"><h3 class="card-title">Category</h3></li>
              <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Fiction</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="true">Non Fiction</a>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <div class="tab-content" id="custom-tabs-two-tabContent">
              <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                <div class="row ">
                  @foreach ($fictions as $fiction)
                      <div class="col-4 result">
                        <div class=" card" style="width: 18rem;">
                          <img src="/bookImages/{{ $fiction->bookImage }}" class="card-img-top" alt="...">
                          <div class="card-body">
                            <h5 class="card-title text-white">{{ $fiction->bookTitle }}</h5>
                            <p class="card-text"></p>
                            <a href="/book/{{ $fiction->id_books }}" class="btn btn-primary">Go somewhere</a>
                          </div>
                        </div>
                      </div>
                  @endforeach
                </div>
              </div>
              <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
                <div class="row ">
                  @foreach ($nonFictions as $nonFiction)
                      <div class="col-4 result">
                        <div class=" card" style="width: 18rem;">
                          <img src="/bookImages/{{ $nonFiction->bookImage }}" class="card-img-top" style="max-weight: 100px" alt="...">
                          <div class="card-body">
                            <h5 class="card-title text-white">{{ $nonFiction->bookTitle }}</h5>
                            <p class="card-text"></p>
                            <a href="/book/{{ $nonFiction->id_books }}" class="btn btn-primary">Go somewhere</a>
                          </div>
                        </div>
                      </div>
                  @endforeach
              </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
    </div>
  </div>
</div>

{{-- Js --}}
<script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
<script>
  $(document).ready(function(){
$('.searchbox-input').on("keyup", function() {
  var value = $(this).val().toLowerCase();
  $(".result").filter(function() {
    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
  });
});
});
</script>
@endsection
