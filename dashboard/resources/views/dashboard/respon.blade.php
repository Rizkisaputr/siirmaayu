
<script type="text/javascript">
window.responListen = function()
{
    var responLabel = []
    var responData = []
    $.ajax({
        url: '{{ route('listen','respon') }}',
        type: "GET", async : false,
        data: {
          waktu: '{{ $waktu }}',
          rujukan: '{{ $rujukan }}',
          perujuk: '{{ $perujuk }}'
        },
        dataType: 'json',
        cache: false,
        success: function(result) {
          responLabel = result.label
          responData = result.data

          dataRespon = {
              labels: responLabel,
              datasets: [{
                  backgroundColor: ["{!!implode('","',$color['responColor'])!!}"],
                  borderColor: ["{!!implode('","',$color['responColorB'])!!}"],
                  borderWidth: 2,
                  hoverBorderWidth: 0,
                  data: responData,
              }]
          };
          responSet()
          onListen("jenis_kasus")

        },error:function(xhr, ajaxOptions, thrownError){
            console.log(JSON.stringify(xhr));
        }
    })
}


window.responSet = function()
{
    var bar = document.getElementById("responChart").getContext('2d');
    var myBarChart = new Chart(bar, {
        type: 'horizontalBar',
        data: dataRespon,
        options: {
          legend: {
              display: false,
          },
          title: {
             display: true,
             fontSize: 15,
             fontFamily: 'Quicksand',
             padding: 10,
             text: 'Respon Time Rujukan'
          },
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero: true,
                  }
              }],
              xAxes: [{
                  ticks: {
                      autoSkip: false
                  }
              }]
          },
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
        }
    });
}
</script>
