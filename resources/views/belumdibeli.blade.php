@extends('layout.template')
@section('template')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h2 class="d-flex justify-content-center active font-semibold"><strong>Data produk belum dibeli</strong></h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Styles -->
<style>
    #chartdiv {
      width: 100%;
      height: 500px;
    }
    </style>

    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

    <!-- Chart code -->
    <script>
    am5.ready(function() {

    // Create root element
    // https://www.amcharts.com/docs/v5/getting-started/#Root_element
    var root = am5.Root.new("chartdiv");


    // Set themes
    // https://www.amcharts.com/docs/v5/concepts/themes/
    root.setThemes([
      am5themes_Animated.new(root)
    ]);


    // Create chart
    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
    var chart = root.container.children.push(am5percent.PieChart.new(root, {
      layout: root.verticalLayout
    }));


    // Create series
    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
    var series = chart.series.push(am5percent.PieSeries.new(root, {
      valueField: "value",
      categoryField: "category"
    }));


    // Set data
    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
    series.data.setAll([
        @foreach ($belumdibeli as $item)
        { value: {{ $item->sisa }}, category: '{{ $item->nama_produk }} ({{ $item->sisa }})' },
        @endforeach
    ]);


    // Create legend
    // https://www.amcharts.com/docs/v5/charts/percent-charts/legend-percent-series/
    var legend = chart.children.push(am5.Legend.new(root, {
      centerX: am5.percent(50),
      x: am5.percent(50),
      marginTop: 15,
      marginBottom: 15
    }));

    legend.data.setAll(series.dataItems);


    // Play initial series animation
    // https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
    series.appear(1000, 100);

    }); // end am5.ready()
    </script>

    <!-- HTML -->
    <div id="chartdiv"></div>


@endsection
