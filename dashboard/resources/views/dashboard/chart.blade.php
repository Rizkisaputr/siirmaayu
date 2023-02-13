<script src="{{asset('js/html2canvas.js')}}" ></script>

@php
  $all_chart = array_merge($barChart,$pieChart);
  $all_chart = array_merge($all_chart,array(
      'rujukanBalik' => null,
      'respon' => null,
      'pemgso4' => null,
      'kasus4' => null,
      'biaya' => null,
      'transportasi' => null,
      'gol_darah' => null,
    ))
@endphp

<style>
.table-statistic td { padding: 0.15rem 0.25rem  }
.table-statistic h3 { font-size: 22pt}
</style>

<div class="cetakan">
<div class="row m-t-10">
  <div class="col-md-12 col-lg-7">
  @include('dashboard.umum')
  </div>

  <div class="col-lg-5 col-md-12">
      <div class="card" id="responCanvas">
          <div class="card-block"><canvas id="responChart" height: 350px width="100%"></canvas></div>
      </div>
  </div>

  <div class="col-md-12 col-lg-6">
    <div class="card">
      <div class="card-block">
          <canvas id="jenis_kasusChart" height="150"></canvas>
      </div>
    </div>
  </div>
  <div class="col-md-12 col-lg-6">
    <div class="card">
        <div class="card-block">
            <canvas id="matneoChart"></canvas>
      </div>
    </div>
  </div>
  <div class="col-md-12 col-lg-12">
    <div class="card">
        <div class="card-block">
          <canvas id="maternalChart"></canvas></div>
      </div>
  </div>
  <div class="col-md-12 col-lg-6">
    <div class="card">
      <div class="card-block">
        <canvas id="maternal_lainnyaChart" height="150"></canvas></div>
    </div>
  </div>
  <div class="col-md-12 col-lg-6">
    <div class="card">
      <div class="card-block">
          <canvas id="neonatalChart" height="150"></canvas></div>
    </div>
  </div>
  <div class="col-md-12 col-lg-6">
    <div class="card">
      <div class="card-block"><canvas id="bayiChart" height="100"></canvas></div>
    </div>
  </div>
  <div class="col-md-12 col-lg-6">
    <div class="card">
      <div class="card-block"><canvas id="kasus_terbanyakChart" height="100"></canvas></div>
    </div>
  </div>
  <div class="col-md-12 col-lg-12">
    <div class="card">
      <div class="card-block"><canvas id="umumChart" height="50"></canvas></div>
    </div>
  </div>
  <div class="col-md-12 col-lg-12">
    <div class="card">
      <div class="card-block"><canvas id="rujukanBalikChart"></canvas>
      </div>
    </div>
  </div>
  <div class="col-md-12 col-lg-12">
    <div class="card">
      <div class="card-block"><canvas id="maternal_rsChart" ></canvas>
    </div>
  </div>
  </div>

  <div class="col-md-12 col-lg-12">
    <div class="card">
      <div class="card-block"><canvas id="perujukChart"></canvas></div>
    </div>
  </div>
  <div class="col-md-12 col-lg-12">
    <div class="card">
      <div class="card-block"><canvas id="kasus4Chart"></canvas></div>
    </div>
  </div>
  <div class="col-md-12 col-lg-12">
    <div class="card">
      <div class="card-block"><canvas id="pemgso4Chart"></canvas></div>
    </div>
  </div>
  <div class="col-md-12 col-lg-6">
    <div class="card">
        <div class="card-block"><canvas id="biayaChart" height="200"></canvas></div>
    </div>
  </div>
  <div class="col-md-12 col-lg-6">
    <div class="card">
      <div class="card-block"><canvas id="transportasiChart" height="200"></canvas></div>
    </div>
  </div>
  <div class="col-md-12 col-lg-6">
    <div class="card">
        <div class="card-block"><canvas id="gol_darahChart" height="200"></canvas>
        </div>
    </div>
  </div>
  <div class="col-md-12 col-lg-6">
    <div class="card">
      <div class="card-block"><canvas id="mediaChart" height="200"></canvas></div>
    </div>
  </div>

<form action="{{ route('pdf') }}" method="post" target="_blank" class="chartPost">
  @csrf
  <input type="hidden" name="waktu" class="waktu"/>
  <input type="hidden" name="perujuk" class="perujuk"/>
  <input type="hidden" name="rujukan" class="rujukan"/>
  <input type="hidden" name="phase" value="1"/>
  @foreach(array('statistik','respon','matneo','jenis_kasus','maternal','maternal_lainnya','neonatal','bayi','umum','kasus_terbanyak') as $ch)
    <input type="hidden" name="canvas_{{ $ch }}" id="c_{{ $ch }}"/>
  @endforeach
</form>

<form action="{{ route('pdf') }}" method="post" target="_blank" class="chartPost">
  @csrf
  <input type="hidden" name="waktu" class="waktu"/>
  <input type="hidden" name="perujuk" class="perujuk"/>
  <input type="hidden" name="rujukan" class="rujukan"/>
  <input type="hidden" name="phase" value="2"/>

  @foreach(array(
    'maternal_rs',
    'media',
    'rujukanBalik',
    'perujuk' ,
    'biaya',
    'kasus4',
    'pemgso4',
    'transportasi',
    'gol_darah') as $ch)
    <input type="hidden" name="canvas_{{ $ch }}" id="c_{{ $ch }}"/>
  @endforeach
</form>

<form action="{{ route('excel') }}" method="post" target="_blank" class="excelPost">
  @csrf
  <input type="hidden" name="waktu" class="waktu"/>
  <input type="hidden" name="perujuk" class="perujuk"/>
  <input type="hidden" name="rujukan" class="rujukan"/>
</form>

<script src="{{asset('vendor/admindek/bower_components/chart.js/js/Chart.js')}}" ></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script>
<script type="text/javascript">

"use strict";

var param = { waktu: '{{ $waktu }}', rujukan: '{{ $rujukan }}', perujuk: '{{ $perujuk }}' }
var canvas_statistik

var squences = {"jenis_kasus":"matneo","matneo":"maternal","maternal":"maternal_lainnya","maternal_lainnya":"neonatal","neonatal":"bayi","bayi":"kasus_terbanyak","kasus_terbanyak":"umum",
"umum":"maternal_rs","biaya":"transportasi","transportasi":"gol_darah","gol_darah":"media"};

@foreach(array_merge($barChart,$pieChart) as $b => $lab)
var {{$b}}Label = []
var {{$b}}Serial = []
@endforeach
</script>
@include('dashboard.respon')
@include('dashboard.kasus4')
@include('dashboard.pemgso4')
<script type="text/javascript">

  @include('dashboard.rujukanbalik')
  window.statistikListen = function()
  {

  $.ajax({
      url: '{{ route('listen','resume') }}',
      type: "GET",
      data: param,
      dataType: 'json',
      cache: false,
      beforeSend: function() {

      },
      success: function(result) {
        @foreach(
          array(
          'total' => 'Total Penggunaan',
          'riil' => 'Rujukan Riil',
          'poli' => 'Rujukan ke Poli',
          'batal' => 'Rujukan Batal',
          'meninggal' => 'Meninggal Dunia',
          'pulang' => 'Pulang Hidup',
          'estafet' => 'Rujukan dialihkan',
          'dikembalikan' => 'Rujukan Dikembalikan',
          'konsultasi' => 'Konsultasi') as $e => $v
        )
        $('.num-{{ $e }}').html(result.{{$e}});
        @endforeach
        html2canvas(document.getElementById("umum"),{backgroundColor: null}).then(function(canvas) {
            canvas_statistik = canvas.toDataURL();
        })
      },error:function(xhr, ajaxOptions, thrownError){
          console.log(JSON.stringify(xhr));
      }
  })

  }

  //--- Bar Chart ---//
window.onListen = function(i)
{
  switch (i) {
  @foreach(array_merge($barChart,$pieChart) as $b => $lab)

  case "{{ $b }}":

  $.ajax({
      url: '{{ route('listen',$b) }}',
      type: "GET",
      data: param,
      dataType: 'json',
      cache: false,
      success: function(result) {
        {{$b}}Label = result.label
        {{$b}}Serial = result.data
        {{$b}}Load()
        if (i == "maternal_rs") rujukanBalikListen()
        if (i == "perujuk") kasus4Listen()
        else {
          if (squences[i] != null) onListen(squences[i])
          else {
            $('.btn-cetak').html('<i class="feather icon-printer"></i> Cetak').removeAttr('disabled');
            $('.btn-excel').html('<i class="feather icon-file"></i> Excel').removeAttr('disabled');
          }
        }

      },error:function(xhr, ajaxOptions, thrownError){
          console.log(JSON.stringify(xhr));
      }
    })

    break;

  @endforeach

  }
}

  @foreach($barChart as $b => $lab)

  window.{{$b}}Load = function(i)
  {
    var bar = document.getElementById("{{$b}}Chart").getContext('2d');
    var myBarChart = new Chart(bar, {
        type: '@if (in_array($b,array('maternal_rs','perujuk','matneo'))){{'bar'}}@else{{'horizontalBar'}}@endif',
        data: {
            labels: {{$b}}Label,
            datasets: [{
                label: '{{ $lab }}',
                borderWidth: 2,
                backgroundColor: ["{!!implode('","',$color[$b.'Color'])!!}"],
                hoverBackgroundColor: ["{!!implode('","',$color[$b.'ColorB'])!!}"],
                data: {{$b}}Serial,
            }]
        },
        options: {
          legend: {
              display: false,
          },
          title: {
             display: true,
             fontSize: 15,
             fontFamily: 'Quicksand',
             padding: 30,
             text: '{{ $lab }}'
          },
          barValueSpacing: 20,
          scaleLabel: function (label) {
              return Math.round(label.value);
          },
          scales: {
              yAxes: [{
                  ticks: { beginAtZero: true }
              }],
              xAxes: [{
                  ticks: { autoSkip: false }
              }]
          },
          @if (in_array($b,array('maternal_rs','perujuk','matneo')))
          plugins: {
            labels: {
              render: 'value',
              fontSize: 13,
              fontStyle: 'bold',
              fontColor: '#333',
              fontFamily: '"Quicksand"'
            }
          },

          @else

            animation: {
                  duration: 500,
                  easing: "easeOutQuart",
                  onComplete: function () {
                      var ctx = this.chart.ctx;
                      ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart.defaults.global.defaultFontFamily);
                      ctx.textAlign = 'center';
                      ctx.textBaseline = 'bottom';

                      this.data.datasets.forEach(function (dataset) {
                          for (var i = 0; i < dataset.data.length; i++) {
                              var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
                                  scale_max = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._yScale.maxHeight,
                                  scale_x = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._xScale.maxWidth;

                              ctx.fillStyle = '#444';
                              var y_pos = model.y + 10;
                              var x_pos = model.x - 20;
                              if ((scale_x - model.x) / scale_x >= 0) x_pos = model.x + 30;
                              ctx.fillText(dataset.data[i], x_pos, y_pos);
                          }
                      });
                  }
              }
          @endif

        }

    });
  }
  @endforeach

  @foreach($pieChart as $b => $lab)
  window.{{$b}}Load = function() {
    var pie{{$b}} = document.getElementById("{{ $b }}Chart");
    var {{$b}}Chart = new Chart(pie{{$b}}, {
        type: 'pie',
        data: {
            labels: {{$b}}Label,
            datasets: [{
                label: '{{ $lab }}',
                borderWidth: 2,
                backgroundColor: ["{!!implode('","',$color[$b.'Color'])!!}"],
                hoverBackgroundColor: ["{!!implode('","',$color[$b.'ColorB'])!!}"],
                data: {{$b}}Serial,
            }]
        },
        options: {
            legend: {
                display: true,
            },
            title: {
               display: true,
               fontSize: 16,
               fontFamily: 'Quicksand',
               text: '{{ $lab }}'
            },
            plugins: {
              labels: {
                render: 'value',
                fontSize: 13,
                fontStyle: 'bold',
                fontColor: '#333',
                fontFamily: '"Quicksand"'
              }
            }
        }
    });
  }
  @endforeach

  window.generateChart = function(i) {
      @foreach($all_chart as $ch => $b)
        var canvas_{{ $ch }} = document.getElementById('{{ $ch }}Chart');
      @endforeach
      $('#c_statistik').val(canvas_statistik);
      @foreach($all_chart as $ch => $b)
        $('#c_{{ $ch }}').val(canvas_{{ $ch }}.toDataURL());
      @endforeach
      $('.waktu').val($('#waktuDropdown :selected').text())
      $('.rujukan').val($('#rujukanDropdown :selected').text())
      $('.perujuk').val($('#perujukDropdown :selected').text())
      $('.chartPost').submit();

    return false;
  }

  statistikListen()
  responListen()

  window.generateExcel = function() {
    $('.waktu').val($('#waktuDropdown').val())
    $('.rujukan').val($('#rujukanDropdown').val())
    $('.perujuk').val($('#perujukDropdown').val())
    $('.excelPost').submit();
  }


</script>
