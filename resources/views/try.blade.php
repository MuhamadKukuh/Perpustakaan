<!DOCTYPE html>
<html>
<head>
    <title>Paginationjs example</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="/paginate/style.css" rel="stylesheet" type="text/css">
    <link href="/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <style type="text/css">
        ul, li {
            list-style: none;
        }

        #wrapper {
            width: 900px;
            margin: 20px auto;
        }

        .data-container {
            margin-top: 20px;
        }

        .data-container ul {
            padding: 0;
            margin: 0;
        }

        .data-container li {
            margin-bottom: 5px;
            padding: 5px 10px;
            background: #eee;
            color: #666;
        }
    </style>
</head>
<body>
    <input type="text" class="search">
    <div id="wrapper">
        <section>
            <div class="data-container row">
                @foreach ($books as $book)
                <div class="card" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">{{ $book->bookTitle }}</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
                @endforeach
            </div>
            <div id="pagination-demo1" class="d-flex justify-content-center"></div>
        </section>
        
    </div>
    
        <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
        <script src="/paginate/paginate.js"></script>
        <script>
        $(function() {
        (function(name) {
            var container = $('#pagination-' + name);
            var sources = function () {
            var result = [{{ $books->count() }}];
    
            for (var i = 1; i <= {{ $books->count() }}; i++) {
                result.push(i); 
            }
    
            return result;
            }();
    
            var options = {
            dataSource: sources,
            callback: function (response, pagination) {
                window.console && console.log(response, pagination);
    
                var dataHtml = '';
    
                $.each(response, function (index, item) {
                dataHtml += '<div class="card col-6 results" style="width: 18rem;"> <img src="..." class="card-img-top" alt="..."> <div class="card-body"><h5 class="card-item"><p class="card-title">{{ $book->bookTitle }}</p></div>'+'</div>';
                });
    
                dataHtml += '';
    
                container.prev().html(dataHtml);
            }
            };
    
            //$.pagination(container, options);
    
            container.addHook('beforeInit', function () {
            window.console && console.log('beforeInit...');
            });
            container.pagination(options);
    
            container.addHook('beforePageOnClick', function () {
            window.console && console.log('beforePageOnClick...');
            //return false
            });
        })('demo1');
        })

                $(document).ready(function(){
        $('.search').on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".results").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
        });
        });
        </script>

</body>
</html>