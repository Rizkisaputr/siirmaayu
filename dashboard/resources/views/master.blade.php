<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="Dashboard SI-IRMA-AYU"
            content="Dashboard SI-IRMA-AYU." />
        <meta name="keywords"
            content="flat ui, admin Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
        <meta name="author" content="colorlib" />

        <title>@yield('title', 'SI-IRMA-AYU KABUPATEN INDRAMAYU')</title>

        <link rel="icon" href="{{asset('img/favicon.ico')}}" type="image/x-icon">

        <style type="text/css">
        /* vietnamese */
        @font-face {
          font-family: 'Quicksand';
          font-style: normal;
          font-weight: 500;
          src: url('{{ asset('fonts/') }}/6xKtdSZaM9iE8KbpRA_hJFQNYuDyP7bh.woff2') format('woff2');
          unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
        }
        /* latin-ext */
        @font-face {
          font-family: 'Quicksand';
          font-style: normal;
          font-weight: 500;
          src: url('{{ asset('fonts/') }}/6xKtdSZaM9iE8KbpRA_hJVQNYuDyP7bh.woff2') format('woff2');
          unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }
        /* latin */
        @font-face {
          font-family: 'Quicksand';
          font-style: normal;
          font-weight: 500;
          src: url('{{ asset('fonts/') }}/6xKtdSZaM9iE8KbpRA_hK1QNYuDyPw.woff2') format('woff2');
          unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }
        /* vietnamese */
        @font-face {
          font-family: 'Quicksand';
          font-style: normal;
          font-weight: 700;
          src: url('{{ asset('fonts/') }}/6xKtdSZaM9iE8KbpRA_hJFQNYuDyP7bh.woff2') format('woff2');
          unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
        }
        /* latin-ext */
        @font-face {
          font-family: 'Quicksand';
          font-style: normal;
          font-weight: 700;
          src: url('{{ asset('fonts/') }}/6xKtdSZaM9iE8KbpRA_hJVQNYuDyP7bh.woff2') format('woff2');
          unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }
        /* latin */
        @font-face {
          font-family: 'Quicksand';
          font-style: normal;
          font-weight: 700;
          src: url('{{ asset('fonts/') }}/6xKtdSZaM9iE8KbpRA_hK1QNYuDyPw.woff2') format('woff2');
          unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }
        </style>

        <link rel="stylesheet" type="text/css" href="{{asset('vendor/admindek/bower_components/bootstrap/css/bootstrap.min.css')}}">

        <link rel="stylesheet" href="{{asset('vendor/admindek/assets/pages/waves/css/waves.min.css')}}" type="text/css" media="all">

        <link rel="stylesheet" type="text/css" href="{{asset('vendor/admindek/assets/icon/feather/css/feather.css')}}">

        <link rel="stylesheet" type="text/css" href="{{asset('vendor/admindek/assets/css/font-awesome-n.min.css')}}">

        <link rel="stylesheet" href="{{asset('vendor/admindek/bower_components/select2/dist/css/select2.min.css')}}" type="text/css" media="all">

        <link rel="stylesheet" type="text/css" href="{{asset('vendor/admindek/assets/css/style.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('vendor/admindek/assets/css/widget.css')}}">
        @yield('master_css')

        <style>
        .navbar-logo { color: #fff; text-align: left !important;line-height: 12px; position: relative;}
        .navbar-logo p {  font-size: 1.1em !important; padding-left: 50px; margin-top: 5px }
        .navbar-logo img{ padding-right: 0px; position: absolute; top: 0px; left: 0px}
        .navbar-logo span { font-size: 80% }
        #faskesDropdown { z-index: 9999}

        @media only screen and (max-width : 800px) {
            .form-filter {
                padding-top: 1100px
            }
        }
        </style>
    </head>

    <body>
        <div class="loader-bg">
            <div class="loader-bar"></div>
        </div>

        <div id="pcoded" class="pcoded">
            @yield('body')
        </div>
        <!--Scripts JS-->

        <script src="{{asset('vendor/admindek/bower_components/jquery/js/jquery.min.js')}}"></script>
        <script src="{{asset('vendor/admindek/bower_components/jquery-ui/js/jquery-ui.min.js')}}"></script>
        <script src="{{asset('vendor/admindek/bower_components/popper.js/js/popper.min.js')}}"></script>
        <script src="{{asset('vendor/admindek/bower_components/bootstrap/js/bootstrap.min.js')}}"></script>

        <script src="{{asset('vendor/admindek/assets/pages/waves/js/waves.min.js')}}" ></script>

        <script src="{{asset('vendor/admindek/bower_components/jquery-slimscroll/js/jquery.slimscroll.js')}}"></script>

        <script src="{{asset('vendor/admindek/assets/js/pcoded.min.js')}}" ></script>
        <script src="{{asset('vendor/admindek/assets/js/vertical/vertical-layout.min.js')}}" ></script>
        <script src="{{asset('vendor/admindek/assets/js/script.min.js')}}"></script>
        <script src="{{asset('vendor/admindek/bower_components/select2/dist/js/select2.min.js')}}" ></script>

        <script type="text/javascript">
        $( document ).ready(function() {
            $( "#pcoded" ).pcodedmenu({
              themelayout: 'horizontal',
              FixedHeaderPosition: true, FixedNavbarPosition: false,
              defaultHorizontalMenu: {
              desktop : "compact",
              tablet : "compact",
              phone : "compact",
          },
        })

        $('#waktuDropdown').select2().on('select2:select', function (e) {
          init()
        })

        $('#perujukDropdown, #rujukanDropdown').select2({
          width: '100%',
          placeholder: 'Seluruh Faskes',
          ajax: {
              url: '{{ route('listen','faskes') }}',
              dataType: 'json',
              type: "GET",
              data: function (q) {
                var param = {
                  term: q.term
                }
                return param
              },
               processResults: function (data) {
              return {
                results:  $.map(data, function (item) {
                  return {
                    text: item.nama+' - '+item.jenis,
                    id: item.id_rs
                  }
                })
              }
            },
            }
        }).on('select2:select', function (e) {
          init()
        })

  });



</script>
@yield('master_js')
</html>
