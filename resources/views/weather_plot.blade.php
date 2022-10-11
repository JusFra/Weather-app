@extends('layouts.app')

@section('head')

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Date', 'Temperature [°C]', 'Humiditity [%]'],
          <?php echo $data; ?>
        ]);

        var options = {
          title: 'Temperature & humidity plot',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }

      
    </script>

@endsection

@section('content')

<div class="container px-lg-5">
    <h3><strong>{{ $name }}</strong></h3>
    <div id="curve_chart" style="width: 95%; height: 500px"></div>
    
    
</div>
@endsection