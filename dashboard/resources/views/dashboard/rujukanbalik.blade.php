var labelRujukanDikembalikan = []
var dataRujukanDikembalikan = []

window.rujukanBalikListen = function() {


  $.ajax({
      url: '{{ route('listen','rujukanbalik') }}',
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
        labelRujukanDikembalikan = result.label;
        dataRujukanDikembalikan = result.data;
        rujukanBalikLoad()
        onListen("perujuk")

      },error:function(xhr, ajaxOptions, thrownError){
          console.log(JSON.stringify(xhr));
      }
  })
}

window.rujukanBalikLoad = function()
{
  var bar = document.getElementById("rujukanBalikChart").getContext('2d');
  var myBarChart = new Chart(bar, {
      type: 'bar',
      data: {
          labels: labelRujukanDikembalikan,
          datasets: [
          @foreach(array(
            'Rujukan' => '#2a9ea1',
            'Dikembalikan' => '#103206',
            'Batal' => '#c70039',
          ) as $a => $b)
          {
              label: '{{ $a }}',
              backgroundColor: "{{ $b }}",
              hoverBackgroundColor: "{{ $b }}",
              data: dataRujukanDikembalikan['{{ $a }}'],
          },
          @endforeach
        ]
      },
      options: {
        title: {
           display: true,
           fontSize: 16,
           fontFamily: 'Quicksand',
           text: 'Penerimaan Rujukan versus Rujukan Dikembalikan versus Rujukan Batal per RS'
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
            fontColor: '#396',
            fontFamily: '"Quicksand"'
          }
        },
      }
  });
  }
