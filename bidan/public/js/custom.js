//
//$ =
//jQuery = require('jquery');
// //
//Cookies = require('js-cookie');
// import 'datatables.net-bs4';
// $.extend(true, $.fn.dataTable.defaults, {
//     language: {
//         url:  '/dt/indonesia.json'
//     },
// });


//Swal = require('sweetalert2');


function notify(message, type){
  $.growl({
      message: message
  },{
      type: type,
      allow_dismiss: false,
      label: 'Cancel',
      className: 'btn-xs btn-success',
      placement: {
          from: 'top',
          align: 'center'
      },
      delay: 2500,
      animate: {
              enter: 'animated fadeInRight',
              exit: 'animated fadeOutRight'
      },
      offset: {
          x: 30,
          y: 30
      }
  });
};

successSet = function (message,dom)
{
  notify('<i class="feather icon-check" style="font-size: 140%"></i> '+message, 'success');
}


failSet = function (message,dom)
{
    notify('<i class="feather icon-alert-circle" style="font-size: 140%"></i> '+message, 'danger');
}


loaderSet = function(message,dom)
{
    $('.panel-alert').html('<div class="alert alert-warning"><span class="close" data-dismiss="alert">×</span><i class="fas fa-circle-notch fa-spin fa-2x pull-left m-r-10"></i><p class="m-t-5 m-b-0">'+message+'</p></div>').fadeIn()
}


loaderUnset = function()
{
    $('.panel-alert').html(null);
}

logout = function (i) {
    var c = $(i).attr('href');
    swal({
        title: "Perhatian.",
        text: "Anda yakin mengakhiri pemakaian Aplikasi?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#f86c6b",
        cancelButtonColor: "#ddd",
        confirmButtonText: "Keluar Aplikasi",
        cancelButtonText: "Batal",
        allowOutsideClick: false,
    },
    function(){
        $('#logoutBtn').submit()
    })
    return false;
}

formOpen = function (i) {
    $.ajax({
        url: $(i).attr('href'),
        cache: false,
        beforeSend: function() {
            loaderSet('Memuat ...');
        },
        success: function(result) {
            loaderUnset();
            $('.panel-form').html(result);
            $('.panel-table, .btn-create').hide();
            $("html, body").animate({ scrollTop: 0 }, 0);
        },error:function(xhr, ajaxOptions, thrownError){
            console.log(JSON.stringify(xhr));
        }
    });
    return false;
}

formRedirect = function (i,panel)
{
  $.ajax({
      url: i,
      cache: false,
      beforeSend: function() {
        loaderSet('Memuat ...');
      },
      success: function(result) {
        loaderUnset();
        $('.'+(panel?panel:'panel-form')).html(result);
      },error:function(xhr, ajaxOptions, thrownError){
          console.log(JSON.stringify(xhr));
      }
  });
}


formClose = function (i) {
  swal({
      title: "Perhatian.",
      text: "Anda yakin ingin keluar dari form?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f86c6b",
      cancelButtonColor: "#ddd",
      confirmButtonText: "Tutup",
      cancelButtonText: "Batal",
      allowOutsideClick: false,
  },
  function(){
        $('.btn-close').show()
        $('.panel-form').html(null);
        if ($('.flatpickr-calendar').length) $('.flatpickr-calendar').remove();
        $('.panel-table').show();
        $("html, body").animate({ scrollTop: 0 }, 0);
    })
    return false;

}


formSubmit = function(i)
{
    $.ajax({
        url: $(i).attr('action'),
        type: "POST",
        data: $(i).serialize()+'&ajax=true',
        cache: false,
        dataType: "json",
        beforeSend: function() {
            $('.btn-close').hide();
            $('.btn-save').attr('disabled','disabled').html('Menyimpan');
        },
        success: function(result) {
            if (result.status == true)
            {
                successSet(result.message);
                if (result.redirect) {
                  formRedirect(result.redirect)
                } else {
                  $('.panel-table').show();
                  $('.panel-form').html(null);
                  $('.btn-create').show();
                  //if ($('.flatpickr-calendar').length) $('.flatpickr-calendar').remove();
                  //$('.btn-save').removeAttr('disabled').html('Simpan');
                }
                drawTable();
                $("html, body").animate({ scrollTop: $(document).height() }, 0);
            } else {
                $('.btn-close').show();
                $('.btn-save').removeAttr('disabled').removeClass('btn-success').addClass('btn-danger').html('Simpan Gagal!');
            }
        },error:function(xhr, ajaxOptions, thrownError){
            console.log(JSON.stringify(xhr));
            $('.btn-save').removeAttr('disabled').html('Simpan');
        }
    });
    return false;
}

hapusData = function (i) {
    swal({
        title: "Perhatian.",
        text: "Anda yakin ingin menghapus data?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#f86c6b",
        cancelButtonColor: "#ddd",
        confirmButtonText: "Hapus!",
        cancelButtonText: "Batal",
        allowOutsideClick: false,
    },
    function(){
            loaderSet('Menghapus Data ...')
            $.ajax({
                url: $(i).attr('href'),
                cache: false,
                success: function(result) {
                    loaderUnset()
                    successSet('Berhasil menghapus data ...')
                    drawTable()
                },error:function(xhr, ajaxOptions, thrownError){
                    console.log(JSON.stringify(xhr));
                }
            });
    })
    return false;
}
