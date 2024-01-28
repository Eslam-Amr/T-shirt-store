@extends('adminlte::page')
@section('content')

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Month');
        data.addColumn('number', 'Profit');

        var currentYear = new Date().getFullYear();
        @foreach($profit as $year => $value)
          data.addRow(['{{ $year }}', {{ $value }}]);
        @endforeach

        var options = {
          title: 'Profit by Month',
          width: 900,
          legend: { position: 'none' },
          chart: { title: 'Profit by Month', subtitle: 'Profit by Month' },
          bars: 'horizontal', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'top', label: 'Profit' } // Top x-axis.
            }
          },
          hAxis: {
            format: '0' // Display years as integers
          },
          bar: { groupWidth: "90%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
      google.charts.load('current', {'packages':['table']});
    google.charts.setOnLoadCallback(drawTable);

    function drawTable() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Month');
      data.addColumn('number', 'Profit');

      // Get the current year dynamically
      var currentYear = new Date().getFullYear();

      // Loop to add data for the current year and the past 5 years
    //   for (var i = currentYear; i >= currentYear - 4; i--) {
    //     // Replace the following sample data with your actual data retrieval logic
    //     var profit = getProfitForYear(i); // Assume a function to get profit data for a year
    //     data.addRow([i.toString(), profit]);
    //   }
      @foreach($profit as $year => $value)
          data.addRow(['{{ $year }}', {{ $value }}]);
        @endforeach

      var table = new google.visualization.Table(document.getElementById('table_div'));

      table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
    }

    // Replace this function with your actual data retrieval logic
    function getProfitForYear(year) {
      // Assume a function that fetches profit data for the given year
      // You can replace this with your actual logic to retrieve profit data
      // For now, returning a random value for demonstration purposes
      return Math.floor(Math.random() * 10000);
    }

    </script>
  </head>
  <body>
    <div id="top_x_div" style="width: 900px; height: 500px;"></div>





    <div id="table_div"></div>

  </body>
</html>
@endsection
