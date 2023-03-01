<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Graph Report</title>

    @php
        $path = asset('/');
    @endphp

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{ $path }}global_assets/css/icons/icomoon/styles.min.css" rel="stylesheet" type="text/css">
	<link href="{{ $path }}assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="{{ $path }}assets/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
	<link href="{{ $path }}assets/css/layout.min.css" rel="stylesheet" type="text/css">
	<link href="{{ $path }}assets/css/components.min.css" rel="stylesheet" type="text/css">
	<link href="{{ $path }}assets/css/colors.min.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="{{ $path }}global_assets/js/main/jquery.min.js"></script>
	<script src="{{ $path }}global_assets/js/main/bootstrap.bundle.min.js"></script>
	<script src="{{ $path }}global_assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="https://www.gstatic.com/charts/loader.js"></script>

	<script src="{{ $path }}assets/js/app.js"></script>
	<script src="{{ $path }}global_assets/js/demo_charts/google/light/bars/column.js"></script>
	<script src="{{ $path }}global_assets/js/demo_charts/google/light/bars/column_stacked.js"></script>
	<script src="{{ $path }}global_assets/js/demo_charts/google/light/bars/bar.js"></script>
	<script src="{{ $path }}global_assets/js/demo_charts/google/light/bars/bar_stacked.js"></script>
	<script src="{{ $path }}global_assets/js/demo_charts/google/light/bars/histogram.js"></script>
	<script src="{{ $path }}global_assets/js/demo_charts/google/light/bars/combo.js"></script>
    <script src="{{ $path }}global_assets/js/plugins/ui/moment/moment.min.js"></script>
	<script src="{{ $path }}global_assets/js/plugins/pickers/daterangepicker.js"></script>
	<script src="{{ $path }}global_assets/js/demo_pages/picker_date.js"></script>


    <script src="{{ $path }}global_assets/js/plugins/forms/selects/select2.min.js"></script>
	<script src="{{ $path }}global_assets/js/plugins/forms/styling/uniform.min.js"></script>


    <script src="{{ $path }}assets/js/app.js"></script>
	<script src="{{ $path }}global_assets/js/demo_pages/form_layouts.js"></script>
	<!-- /theme JS files -->

</head>

<body>

	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content">

                <div class="card">

                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">Sales Overview</h5>
                    </div>

                    <div class="card-body py-0 mt-3 mb-3">
                        <div class="row">
                            <div class="col-2 ">
                                <div class="mb-3">
                                    <h5 class="font-weight-semibold mb-0" id="total_sales"></h5>
                                    <span class="text-muted font-size-md">Total Sales</span>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="mb-3">
                                    <h5 class="font-weight-semibold mb-0" id="inv_max"></h5>
                                    <span class="text-muted font-size-md">Max inv. value</span>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="mb-3">
                                    <h5 class="font-weight-semibold mb-0" id="inv_avg"></h5>
                                    <span class="text-muted font-size-md">Avg inv. value</span>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mb-3">
                                    <h5 class="font-weight-semibold mb-0" id="no_orders"></h5>
                                    <span class="text-muted font-size-md">No.of Orders</span>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mb-3">
                                    <div class=" input-group col-12">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-calendar22"></i></span>
                                        </span>
                                        <input type="text" class="form-control daterange-basic" value="{{ $date }}" id="date-range-input">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card">

                    <div class="row">
                        <div class="col-md-7">
                            <div class="card-header header-elements-inline">
                                <h5 class="card-title">Top 5 Customers By Sales</h5>
                                <div class="header-elements">
                                    <div class="list-icons">
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="chart-container">
                                    <div class="chart" id="google-bar"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="card-header header-elements-inline">
                                <h5 class="card-title">Sales By Location</h5>
                                <div class="header-elements">
                                    <div class="list-icons">
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="chart-container text-center">
                                    <div class="d-inline-block" id="google-donut"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


				<!-- Column chart -->
				<div class="card">

                    <div class="card-header header-elements-inline">
                        <h3 class="card-title">Sales Analysis</h3>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-header header-elements-inline">
                                <h5 class="card-title" id="sales-analysis-header">Weeks Comparison</h5>
                                <div class="header-elements">
                                    <div class="list-icons">
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-input-styled" id="show-weekl-data" name="test" value="week" checked data-fouc>
                                                    Week
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-input-styled" id="show-month-data" name="test" value="month" data-fouc>
                                                    Month
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">

                                <div class="chart-container">
                                    <div class="chart" id="google-column"></div>
                                </div>
                            </div>
				        </div>

                        <div class="col-md-6">
                            <div class="card-header header-elements-inline">
                                <h5 class="card-title">Target Vs Sales Man</h5>
                            </div>

                            <div class="card-body">

                                <div class="chart-container">
                                    <div class="chart" id="google-combo"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>










    <script>



    var data;
    var comparison_chart_data;

    $(document).ready(function() {

        var date = $('#date-range-input').val();

        createCharts(date);

        $('#date-range-input').change(function() {
            var date = $('#date-range-input').val();
            createCharts(date);
        });
    });


    function createCharts(date) {
        $.ajax({
            url: '/load-graph-data',
            data: {
            date: date,
            },
            dataType: 'json',
            success: function(data) {
                $('#total_sales').text(data.total_sales);
                $('#inv_max').text(data.max_invoice_val);
                $('#inv_avg').text(data.avg_invoice_val);
                $('#no_orders').text(data.no_of_order);

                GoogleBarBasic.init(data.customer_chart);
                GoogleDonutBasic.init(data.location_sales);
                GoogleComboChart.init(data.sales_target);
                GoogleColumnBasic.init(data.comparison_chart.week);
                comparison_chart_data = data.comparison_chart;
            },
            error: function(xhr, status, error) {
                alert('Error');
            }

        });
    }

    var monthRadio = document.getElementById('show-month-data');
    var weekRadio = document.getElementById('show-weekl-data');

    monthRadio.addEventListener('change', function() {

        $('#sales-analysis-header').text("Months Comparison");
        var newData = comparison_chart_data.month;
        GoogleColumnBasic.init(newData);
    });

    weekRadio.addEventListener('change', function() {
        $('#sales-analysis-header').text("Weeks Comparison");
        var newData = comparison_chart_data.week;
        GoogleColumnBasic.init(newData);
    });


    var GoogleBarBasic = function() {

        // Bar chart
        var _googleBarBasic = function(chart_data) {

            if (typeof google == 'undefined') {
                console.warn('Warning - Google Charts library is not loaded.');
                return;
            }

            // Initialize chart
            google.charts.load('current', {
                callback: function () {

                    // Draw chart
                    drawBar();

                    // Resize on sidebar width change
                    var sidebarToggle = document.querySelector('.sidebar-control');
                    sidebarToggle && sidebarToggle.addEventListener('click', drawBar);

                    // Resize on window resize
                    var resizeBarBasic;
                    window.addEventListener('resize', function() {
                        clearTimeout(resizeBarBasic);
                        resizeBarBasic = setTimeout(function () {
                            drawBar();
                        }, 200);
                    });
                },
                packages: ['corechart']
            });

            // Chart settings
            function drawBar() {

                // Define charts element
                var bar_chart_element = document.getElementById('google-bar');

                // Data
                var data = google.visualization.arrayToDataTable(chart_data);


                // Options
                var options_bar = {
                    fontName: 'Roboto',
                    height: 400,
                    fontSize: 12,
                    backgroundColor: 'transparent',
                    chartArea: {
                        left: '3%',
                        width: '95%',
                        height: 350
                    },
                    tooltip: {
                        textStyle: {
                            fontName: 'Roboto',
                            fontSize: 13
                        }
                    },
                    vAxis: {
                        textStyle: {
                            color: '#333'
                        },
                        gridlines:{
                            count: 10
                        },
                        minValue: 0
                    },
                    hAxis: {
                        baselineColor: '#ccc',
                        textStyle: {
                            color: '#333'
                        },
                        gridlines:{
                            color: '#eee'
                        }
                    },
                    legend: {
                        position: 'top',
                        alignment: 'center',
                        textStyle: {
                            color: '#333'
                        }
                    },
                    series: {
                        0: { color: '#66BB6A' },
                        1: { color: '#66BB6A' }
                    }
                };

                // Draw chart
                var bar = new google.visualization.BarChart(bar_chart_element);
                bar.draw(data, options_bar);

            }
        };

        return {
            init: function(data) {

                _googleBarBasic(data);
            }
        }
    }();


    // Initialize module
    // ------------------------------


    var GoogleComboChart = function() {

        // Combo chart
        var _googleComboChart = function(chart_data) {
            if (typeof google == 'undefined') {
                console.warn('Warning - Google Charts library is not loaded.');
                return;
            }

            // Initialize chart
            google.charts.load('current', {
                callback: function () {

                    // Draw chart
                    drawCombo();

                    // Resize on sidebar width change
                    var sidebarToggle = document.querySelector('.sidebar-control');
                    sidebarToggle && sidebarToggle.addEventListener('click', drawCombo);

                    // Resize on window resize
                    var resizeCombo;
                    window.addEventListener('resize', function() {
                        clearTimeout(resizeCombo);
                        resizeCombo = setTimeout(function () {
                            drawCombo();
                        }, 200);
                    });
                },
                packages: ['corechart']
            });

            // Chart settings
            function drawCombo() {

                // Define charts element
                var combo_chart_element = document.getElementById('google-combo');

                // Data
                var data = google.visualization.arrayToDataTable(chart_data);


                // Options
                var options_combo = {
                    fontName: 'Roboto',
                    height: 400,
                    fontSize: 12,
                    backgroundColor: 'transparent',
                    seriesType: "bars",
                    chartArea: {
                        left: '4%',
                        width: '95%',
                        height: 350
                    },
                    tooltip: {
                        textStyle: {
                            fontName: 'Roboto',
                            fontSize: 13
                        }
                    },
                    vAxis: {
                        textStyle: {
                            color: '#333'
                        },
                        baselineColor: '#ccc',
                        gridlines:{
                            color: '#eee',
                            count: 10
                        },
                        minValue: 0
                    },
                    hAxis: {
                        textStyle: {
                            color: '#333'
                        }
                    },
                    legend: {
                        position: 'top',
                        alignment: 'center',
                        textStyle: {
                            color: '#333'
                        }
                    },
                    series: {
                        0: { color: '#5ab1ef' },
                        1: {
                            type: "line",
                            pointSize: 7,
                            curveType: 'function',
                            color: '#f5994e'
                        }
                    },
                };

                // Draw chart
                var combo = new google.visualization.ComboChart(combo_chart_element);
                combo.draw(data, options_combo);
            }
        };

        return {
            init: function(data) {
                _googleComboChart(data);
            }
        }
    }();


    // Initialize module
    // ------------------------------


    var GoogleColumnBasic = function() {

        var currentData;

        // Column chart
        var _googleColumnBasic = function() {
            if (typeof google == 'undefined') {
                console.warn('Warning - Google Charts library is not loaded.');
                return;
            }

            // Initialize chart
            google.charts.load('current', {
                callback: function () {

                    // Draw chart
                    drawColumn();

                    // Resize on sidebar width change
                var sidebarToggle = document.querySelector('.sidebar-control');
                    sidebarToggle && sidebarToggle.addEventListener('click', drawColumn);

                    // Resize on window resize
                    var resizeColumn;
                    window.addEventListener('resize', function() {
                        clearTimeout(resizeColumn);
                        resizeColumn = setTimeout(function () {
                            drawColumn();
                        }, 200);
                    });
                },
                packages: ['corechart']
            });

            // Chart settings
            function drawColumn() {

                // Define charts element
                var line_chart_element = document.getElementById('google-column');

                // Data
                var data = google.visualization.arrayToDataTable(currentData);


                // Options
                var options_column = {
                    fontName: 'Roboto',
                    height: 400,
                    fontSize: 12,
                    backgroundColor: 'transparent',
                    chartArea: {
                        left: '5%',
                        width: '95%',
                        height: 350
                    },
                    tooltip: {
                        textStyle: {
                            fontName: 'Roboto',
                            fontSize: 13
                        }
                    },
                    vAxis: {
                        title: '',
                        titleTextStyle: {
                            fontSize: 13,
                            italic: false,
                            color: '#333'
                        },
                        textStyle: {
                            color: '#333'
                        },
                        baselineColor: '#ccc',
                        gridlines:{
                            color: '#eee',
                            count: 10
                        },
                        minValue: 0
                    },
                    hAxis: {
                        textStyle: {
                            color: '#333'
                        }
                    },
                    legend: {
                        position: 'top',
                        alignment: 'center',
                        textStyle: {
                            color: '#333'
                        }
                    },
                    series: {
                        0: { color: '#2ec7c9' },
                        1: { color: '#b6a2de' }
                    }
                };

                // Draw chart
                var column = new google.visualization.ColumnChart(line_chart_element);
                column.draw(data, options_column);
            }
        };


        return {
            init: function(data) {
                currentData = data;
                _googleColumnBasic(data);
            }
        }

    }();


    // Initialize module
    // ------------------------------


    var GoogleDonutBasic = function() {

        // Donut chart
        var _googleDonutBasic = function(chart_data) {
            if (typeof google == 'undefined') {
                console.warn('Warning - Google Charts library is not loaded.');
                return;
            }

            // Initialize chart
            google.charts.load('current', {
                callback: function () {

                    // Draw chart
                    drawDonut();

                    // Resize on sidebar width change
                    var sidebarToggle = document.querySelector('.sidebar-control');
                    sidebarToggle && sidebarToggle.addEventListener('click', drawDonut);

                    // Resize on window resize
                    var resizeDonutBasic;
                    window.addEventListener('resize', function() {
                        clearTimeout(resizeDonutBasic);
                        resizeDonutBasic = setTimeout(function () {
                            drawDonut();
                        }, 200);
                    });
                },
                packages: ['corechart']
            });

            // Chart settings
            function drawDonut() {

                // Define charts element
                var donut_chart_element = document.getElementById('google-donut');

                // Data
                var data = google.visualization.arrayToDataTable(chart_data);

                // Options
                var options_donut = {
                    fontName: 'Roboto',
                    pieHole: 0.55,
                    height: 300,
                    width: 500,
                    backgroundColor: 'transparent',
                    colors: [
                        '#2ec7c9','#b6a2de','#5ab1ef','#ffb980',
                        '#d87a80','#8d98b3','#e5cf0d','#97b552'
                    ],
                    chartArea: {
                        left: 50,
                        width: '90%',
                        height: '90%'
                    }
                };

                // Instantiate and draw our chart, passing in some options.
                var donut = new google.visualization.PieChart(donut_chart_element);
                donut.draw(data, options_donut);
            }
        };

        return {
            init: function(data) {
                _googleDonutBasic(data);
            }
        }
    }();


</script>



</body>
</html>
