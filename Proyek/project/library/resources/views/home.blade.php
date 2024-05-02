 @extends('layouts.admin')
 @section('header','Home')

 @section('content')

      <div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$total_book}}</h3>
                <p>Total Book</p>
              </div>
              <div class="icon">
                <i class="ion ion-book"></i>
              </div>
              <a href={{url('books')}} class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$total_member}}</h3>
                <p>Total Member</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href={{url('members')}} class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$total_publisher}}</h3>
                <p>Author Data</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href={{url('authors')}} class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$total_transaction}}</h3>
                <p>Transaction Data</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href={{url('taransactions')}} class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
      </div>


          <div class="col-lg-6">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Grafik Penerbit</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Grafik Peminjaman</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                  <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
            </div>
          </div>
        </div>
        
    </div>

  @endsection

  <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>

  <script type = "text/javascript">

    var label_donut = '{!! json_encode ($label_donut) !!}';
    var data_donut = '{!! json_encode ($data_donut) !!}';
    var data_bar = '{!! json_encode ($data_bar) !!}';
   

    $(function () {
      
    //-------------
    //- DONUT CHART -
    //-------------

      var donutChartCanvas = $('#donutsChart').get(0).getContext('2d')
      var donutData = {
        labels: JSON.parse(label_donut),
          datasets: [
        {
          data: JSON.parse(data_donut),
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create Bar or douhnut chart
    // You can switch between Bar and douhnut using the method below.

    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })

    //-------------
    //- BAR CHART -
    //-------------

    var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
      datasets: JSON.parse(data_bar)
    }

        var barChartCanvas = $('#barChart').get(0).getContext('2d')
        var barChartData = $.extend(true,{}, areChartData)
        //var temp0 = areChartData.datasets[0]
        //var temp0 = areChartData.datasets[1]
        //barChartCanvas.datasets[0] = temp1
        //barChartCanvas.datasets[1] = temp0 -->

        var barChartOptions = {
          responsive          : true,
          maintainAspectRatio : false,
          datasetFill         : false
        }

        new Chart(barChartCanvas,{
          type: 'bar',
          data: barChartData,
          options: barChartOptions
        })

    
    //-------------
    //- STACKED BAR CHART -
    //-------------

    // var areaChartData = {
    //   labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
    //   datasets: JSON.parse(data_bar)
    // }
    
        var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
        var stackedBarChartData = $.extend(true,{}, barChartData)

        var stackedBarChartOptions = {
          responsive          : true,
          maintainAspectRatio : false,
          scale: {
            xAxes:[{
              stacked:true,
            }],
            yAxes:[{
              stacked:true
            }],
          }
        }

        new Chart(barChartCanvas,{
          type: 'bar',
          data: stackedBarChartData,
          options: stackedBarChartOptions
        })
    })

</script>

<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection
