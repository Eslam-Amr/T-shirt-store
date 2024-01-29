@extends('adminlte::page')
@section('content')
<html>
<head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart', 'table']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Day');
      data.addColumn('number', 'Profit');

      // Get the profit data from the PHP array
      var monthProfit = @json($monthProfit);

      // Loop to add data for each day
      for (var day in monthProfit) {
        data.addRow([day.toString(), monthProfit[day]]);
      }

      var options = {
        title: 'Profit for Each Day',
        curveType: 'function',
        legend: { position: 'bottom' },
        width: '100%' // Set the width to 100%
      };

      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
      chart.draw(data, options);

      drawTable(data);
    }

    function drawTable(dataTable) {
      var table = new google.visualization.Table(document.getElementById('table_div'));

      // Create a DataView to hide the index column (row number)
      var view = new google.visualization.DataView(dataTable);
      view.setColumns([0, 1]); // Display only columns 0 (Day) and 1 (Profit)

      // Draw the table with a style option to center the content
      table.draw(view, {
        showRowNumber: false,
        width: '100%',
        height: '100%',
        cssClassNames: {
          tableCell: 'center-text'
        }
      });
    }
  </script>

  <style>
    /* Custom CSS to center text in table cells */
    .center-text {
      text-align: center;
    }
  </style>
</head>
<body>
  <div id="chart_div" style="width: 100%; height: 500px;"></div>
  <div id="table_div"></div>
</body>
</html>

@endsection
