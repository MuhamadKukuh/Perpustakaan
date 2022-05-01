<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <canvas id="myChart" style="width:100%;max-width:700px"></canvas>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
    </script>
    <script>
        var data = {{ $user->count() }}
        var xValues = ["Januari", "Febuari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        var yValues = [{{ $user->count() }}, {{ $user->count() }}, 10, 24, 15, 10, 12, 13, 14, 15, 16, 17];
        var barColors = ["red", "green","blue","orange","brown", "purple", "dark", "darkgreen", "pink", "grey", "darkblue", "darkred" ];

        new Chart("myChart", {
        type: "doughnut",
        data: {
            labels: xValues,
            datasets: [{
            backgroundColor: barColors,
            data: yValues
            }]
        },
        options: {
            title: {
            display: true,
            text: "World Wide Wine Production"
            }
        }  
    });
    </script>
</body>
</html>