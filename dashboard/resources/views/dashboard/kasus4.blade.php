<script type="text/javascript">
var labelKasus4 = []
var dataKasus4 = []

window.kasus4Listen = function()
{

$.ajax({
    url: '{{ route('listen','kasus4') }}',
    type: "GET", async: false,
    data: param,
    dataType: 'json',
    cache: false,
    beforeSend: function() { },
    success: function(result) {
      labelKasus4 = result.label;
      dataKasus4 = result.data;
      kasus4Load()
      pemgso4Listen()

    },error:function(xhr, ajaxOptions, thrownError){
        console.log(JSON.stringify(xhr));
    }
})

}

window.kasus4Load = function(i)
{
var bar = document.getElementById("kasus4Chart").getContext('2d');
var myBarChart = new Chart(bar, {
    type: 'bar',
    data: {
        labels: labelKasus4,
        datasets: [
        @foreach(array(
          'Pre Eklamsia' => '#2a74a1',
          'Eklampsia' => '#2a9ea1',
          'HAP' => '#da12a0',
          'HPP' => '#f11d26'
        ) as $a => $b)
        {
            label: '{{ $a }}',
            backgroundColor: "{{ $b }}",
            hoverBackgroundColor: "{{ $b }}",
            data: dataKasus4['{{ $a }}'],
        },
        @endforeach
      ]
    },
    options: {
      title: {
         display: true,
         fontSize: 16,
         fontStyle: 'bold',
         fontFamily: 'Quicksand',
         text: 'Penerimaan RS untuk Kasus Pre-Eklampsi, Eklampsia, HAP, dan HPP'
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
})
}

</script>
