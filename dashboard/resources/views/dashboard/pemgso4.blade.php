
<script type="text/javascript">

var labelpemgso4 = []
var datapemgso4 = []

window.pemgso4Listen = function()
{


$.ajax({
    url: '{{ route('listen','pemgso4') }}',
    type: "GET", async : false,
    data: {
      waktu: '{{ $waktu }}',
      rujukan: '{{ $rujukan }}',
      perujuk: '{{ $perujuk }}'
    },
    dataType: 'json',
    cache: false,
    beforeSend: function() { },
    success: function(result) {
      labelpemgso4 = result.label;
      datapemgso4 = result.data;
      pemgso4Load()
      onListen("biaya")

    },error:function(xhr, ajaxOptions, thrownError){
        console.log(JSON.stringify(xhr));
    }
})
}

window.pemgso4Load = function()
{
var bar = document.getElementById("pemgso4Chart").getContext('2d');
var myBarChart = new Chart(bar, {
    type: 'bar',
    data: {
        labels: labelpemgso4,
        datasets: [
            @foreach(array(
              'Pre Eklamsia' => '#2D74a1',
              'Eklampsia' => '#2E9ea1',
              'MGSO4' => '#ff5733',
            ) as $a => $b)
            {
                label: '{{ $a }}',
                backgroundColor: "{{ $b }}",
                hoverBackgroundColor: "{{ $b }}",
                data: datapemgso4['{{ $a }}'],
            },
            @endforeach
          ]
      },
    options: {
      title: {
         display: true,
         fontSize: 16,
         fontFamily: 'Quicksand',
         text: 'Rujukan PE/E dengan Tata Laksana MgSO4'
      },
      barValueSpacing: 20,
      scaleMinSpace: 60,
      scales: {
          yAxes: [{
              ticks: {
                  beginAtZero: true
              }
          }],
          xAxes: [{
              ticks: {
                  autoSkip: false
              }
          }]
      },
      plugins: {
        labels: {
          render: 'value',
          fontSize: 13,
          fontStyle: 'bold',
          fontColor: '#383',
          fontFamily: '"Quicksand"'
        }
      },
    }
});
}

</script>
