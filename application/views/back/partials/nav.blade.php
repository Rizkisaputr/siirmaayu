<div id="sidebar" class="sidebar">
	<div data-scrollbar="true" data-height="100%">
        <ul class="nav">
            <li class="nav-profile">
                <a href="javascript:;" data-toggle="nav-profile">
                    <div class="cover with-shadow"></div>
                    <div class="image">
                        <img src="{{load_asset('dist/img/avatar5.png')}}" alt="">
                    </div>
                    <div class="info">
                        <b class="caret"></b>
                        {{$user->full_name}}
                        <small>{{$user->email}}</small>
                    </div>
                </a>
            </li>
            <li>
                <ul class="nav nav-profile open" style="display: block;">
                    <li><a href="{{base_url('panel/lainya/profil')}}">Ubah Profil <i class="ion-ios-arrow-thin-right text-white"></i> </a></li>
                </ul>
            </li>
        </ul>
        <ul class="nav">
            <li class="nav-header">Navigation</li>

             <li class="has-sub {{nav_active(array('panel','dashboard'))}} {{nav_active(array('panel','dashboard_psc'))}} {{nav_active(array('panel','dashboard'))}}">
                <a href="javascript:;">
                    <b class="caret"></b>
                    <i class="ion-ios-speedometer-outline bg-gradient-blue"></i> 
                    <span>Dashboard</span>
                </a>
                <ul class="sub-menu">
                    <li class="{{nav_active(array('panel','dashboard'))}}"><a href="{{('https://siirmaayu.id/dashboard/')}}" target="_blank">Dashboard Penggunaan</a></li>
                    <!--<li class="{{nav_active(array('panel','dashboard'))}}"><a href="{{base_url('panel/dashboard')}}">Dashboard Rujukan</a></li>-->
                    <li class="{{nav_active(array('panel','dashboard_psc'))}}"><a href="{{base_url('panel/dashboard_psc')}}">Dashboard PSC</a></li>
                    <li class="{{nav_active(array('panel','home'))}}"><a href="{{base_url('./home')}}" target="_blank">Dashboard Bed RS</a></li>
                    @if(get_instance()->ion_auth->is_admin())
                    <!--<li class="{{nav_active(array('panel','dashboard_bumil'))}}"><a href="{{base_url('')}}">Dashboard Bumil</a></li>
                    <li class="{{nav_active(array('panel','dashboard_bufas'))}}"><a href="{{base_url('')}}">Dashboard Bufas</a></li>
                    <li class="{{nav_active(array('panel','dashboard_bbl'))}}"><a href="{{base_url('')}}">Dashboard BBL</a></li>
                    <li class="{{nav_active(array('panel','dashboard_pwskia'))}}"><a href="{{base_url('panel/dashboard_pwskia')}}">Dashboard PWSKIA</a></li>-->
                    
                    @endif
                </ul>
            </li>

            @if(get_instance()->ion_auth->is_admin())
            <li class="has-sub {{nav_active(array('panel','rujukan'))}} {{nav_active(array('panel','rujukan'))}} {{nav_active(array('panel','data_rujukan'))}}">
                <a href="javascript:;">
                    <b class="caret"></b>
                    <i class="ion-android-map bg-gradient-blue"></i> 
                    <span>Map GIS Faskes</span>
                </a>
                <ul class="sub-menu">
                    <!--<li class="{{nav_active(array('panel','data_rujukan'))}}"><a href="{{base_url('./index.php/map')}}" target="_blank">Map Bumil</a></li>
                    <li class="{{nav_active(array('panel','data_rujukan_all'))}}"><a href="{{base_url('./index.php/map')}}" target="_blank">Map Rujukan</a></li>
                    <li class="{{nav_active(array('panel','home'))}}"><a href="{{base_url('./home')}}" target="_blank">Map Ambulan</a></li>-->
                    <li class="{{nav_active(array('panel','rujukan','psc'))}}"><a href="{{base_url('./map')}}" target="_blank"><i class="ion-android-car bg-red"></i> <span>Map Faskes</span></a></li>
                </ul>
            </li>
            @endif

             <li class="has-sub {{nav_active(array('panel','rujukan'))}} {{nav_active(array('panel','rujukan'))}} {{nav_active(array('panel','data_rujukan'))}}">
                <a href="javascript:;">
                    <b class="caret"></b>
                    <i class="ion-ios-medical bg-gradient-red"></i> 
                    <span>Rujukan dan PSC</span>
                </a>
                <ul class="sub-menu">
                    <li class="{{nav_active(array('panel','rujukan'))}}"><a href="{{base_url('panel/rujukan/psc/add')}}">Entri Laporan PSC</a></li>
                    <li class="{{nav_active(array('panel','rujukan'))}}"><a href="{{base_url('panel/rujukan/rujuk/add')}}">Entri Rujukan</a></li>
                    <li class="{{nav_active(array('panel','rujukan'))}}"><a href="{{base_url('panel/rujukan/covid/add')}}">Entri Rujukan COVID</a></li>
                    <li class="{{nav_active(array('panel','data_rujukan'))}}"><a href="{{base_url('panel/data_rujukan')}}">Rujukan 10 Jam</a></li>
                    <li class="{{nav_active(array('panel','data_rujukan_all'))}}"><a href="{{base_url('panel/data_rujukan_all')}}">Semua Rujukan</a></li>
                    @if(get_instance()->ion_auth->is_admin())
                    <li class="{{nav_active(array('panel','rujukan','konfirmasi'))}}"><a href="{{base_url('panel/rujukan/konfirmasi')}}"><i class="ion-android-sync bg-yellow"></i> <span>Rujukan Balik</span></a></li>                                       
                    @endif
                    <li class="{{nav_active(array('panel','rujukan','psc'))}}"><a href="{{base_url('panel/rujukan/psc')}}"><i class="ion-android-car bg-red"></i> <span>Kasus PSC SPGDT</span></a></li>
                    <li class="{{nav_active(array('panel','rujukan','pasien'))}}"><a href="{{base_url('panel/rujukan/pasien')}}"><i class="ion-woman bg-purple"></i> <span>Data Pasien</span></a></li>                                     
                    @if (isset($_SESSION['is_rs']) or (isset($_SESSION['is_puskesmas'])))
                    <li class="{{nav_active(array('panel','rujuk'))}}"><a href="{{base_url('panel/rujukan/rujuk')}}">Rujukan Keluar</a></li>
                    <li class="{{nav_active(array('panel','rujukan','konfirmasi'))}}"><a href="{{base_url('panel/rujukan/konfirmasi')}}"><i class="ion-android-sync bg-yellow"></i> <span>Rujukan Balik Dikirim</span></a></li>
                    <li class="{{nav_active(array('panel','rujukan','konfirmasi'))}}"><a href="{{base_url('panel/rujukan/konfirmasi')}}"><i class="ion-android-sync bg-yellow"></i> <span>Rujukan Balik Diterima</span></a></li>
                    @endif
                </ul>
            </li>

            
             @if(get_instance()->ion_auth->is_admin()) 
            <li class="has-sub {{nav_active(array('panel','rujukan'))}} {{nav_active(array('panel','rujukan'))}} {{nav_active(array('panel','data_rujukan'))}}">
                <a href="javascript:;">
                    <b class="caret"></b>
                    <i class="ion-stats-bars bg-gradient-pink"></i> 
                    <span>Data Pasien Maternal</span>
                </a>
                <ul class="sub-menu">                    
                    <!--<li class="{{nav_active(array('panel','rujukan','psc'))}}"><a href="{{base_url('panel/rujukan/pasien')}}"><i class="ion-android-car bg-red"></i> <span>Kohort Ibu</span></a></li>
                    <li class="{{nav_active(array('panel','rujukan','psc'))}}"><a href="{{base_url('panel/rujukan/pasien')}}"><i class="ion-android-car bg-red"></i> <span>Kohort Bayi</span></a></li>
                    <li class="{{nav_active(array('panel','rujukan','psc'))}}"><a href="{{base_url('panel/rujukan/pasien')}}"><i class="ion-android-car bg-red"></i> <span>Bumil Risti</span></a></li> 
                    <li class="{{nav_active(array('panel','rujukan','psc'))}}"><a href="{{base_url('panel/rujukan/pasien')}}"><i class="ion-android-car bg-red"></i> <span>Bufas Risti</span></a></li>-->  
                    <li class="{{nav_active(array('panel','rujukan','pasien'))}}"><a href="{{base_url('panel/rujukan/pasien')}}"><i class="ion-woman bg-purple"></i> <span>Data WUS dan Bumil</span></a></li>
                    <li class="{{nav_active(array('panel','rujukan','pwskia'))}}"><a href="{{base_url('panel/rujukan/pwskia')}}"><i class="ion-clock"></i> <span>Data PWS KIA</span></a></li> 
                </ul>
            </li>  
            @endif
                        
            <li class="has-sub @if (nav_active(array('panel','rumah_sakit','stok_darah')) != "active") {{nav_active(array('panel','rumah_sakit'))}} @endif">
                <a href="javascript:;">
                    <b class="caret"></b>
                    <i class="ion-home bg-green"></i> 
                    <span>Data Dasar Faskes</span>
                </a>
                <ul class="sub-menu">
                    <li class="{{nav_active(array('panel','rumah_sakit','rs'))}}"><a href="{{base_url('panel/rumah_sakit/rs')}}">Profil Faskes</a></li>
                    <li class="{{nav_active(array('panel','rumah_sakit','bed'))}}"><a href="{{base_url('panel/rumah_sakit/bed')}}">Data Bed</a></li>
                    <li class="{{nav_active(array('panel','rumah_sakit','faskes'))}}"><a href="{{base_url('panel/rumah_sakit/faskes')}}">Data Alat Kesehatan</a></li>
                    <li class="{{nav_active(array('panel','rumah_sakit','dokter'))}}"><a href="{{base_url('panel/rumah_sakit/dokter')}}">Data Dokter</a></li>
                    <li class="{{nav_active(array('panel','rumah_sakit','jadwal_dokter'))}}"><a href="{{base_url('panel/rumah_sakit/jadwal_dokter')}}">Jadwal Dokter</a></li>
                    <li class="{{nav_active(array('panel','rumah_sakit','ambulance'))}}"><a href="{{base_url('panel/rumah_sakit/ambulance')}}">Data Ambulance</a></li>
                    <!-- <li><a href="{{base_url('panel/rumah_sakit/ambulance')}}">Data Ketersediaan Darah <span class="text-danger">New</span></a></li> -->
                    <li class="{{nav_active(array('panel','rumah_sakit','nakes'))}}"><a href="{{base_url('panel/rumah_sakit/nakes')}}">Tenaga Kesehatan <span class="text-danger">New</span></a></li>
                    <li class="{{nav_active(array('panel','rumah_sakit','stok_darah'))}}"><a href="{{base_url('panel/rumah_sakit/stok_darah')}}"><i class="ion-waterdrop bg-red"></i> <span>Data Ketersediaan Darah</span></a></li>
                </ul>
            </li>
            
            <li class="has-sub {{nav_active(array('panel','laporan'))}}">
                <a href="javascript:;">
                    <b class="caret"></b>
                    <i class="ion-ios-printer-outline bg-gradient-blue"></i> 
                    <span>Laporan</span>
                </a>
                <ul class="sub-menu">
                    <li class="{{nav_active(array('panel','laporan','bed'))}}"><a href="{{base_url('panel/laporan/bed')}}">Laporan Bed</a></li>
                    <li class="{{nav_active(array('panel','laporan','rujukan'))}}"><a href="{{base_url('panel/laporan/rujukan')}}">Rujukan Keluar</a></li>
                    <li class="{{nav_active(array('panel','laporan','rujukan_balik'))}}"><a href="{{base_url('panel/laporan/rujukan_balik')}}">Rujukan Masuk</a></li>
                </ul>
            </li>
            <!--@if(get_instance()->ion_auth->is_admin())
            <li class="has-sub {{nav_active(array('panel','antrian'))}}">
                <a href="javascript:;">
                    <b class="caret"></b>
                    <i class="ion-android-list bg-gradient-orange"></i> 
                    <span>Antrian</span>
                    <span class="text-danger">Coming Soon</span>
                </a>
                <ul class="sub-menu">
                    <li class="{{nav_active(array('panel','antrian','harian'))}}"><a href="{{base_url('panel/admin/kelas_bed')}}">Antrian Harian</a></li>
                    <li class="{{nav_active(array('panel','antrian','booking'))}}"><a href="{{base_url('panel/admin/layanan')}}">Booking Antrian</a></li>
                </ul>
            </li>-->
            
            
            <li class="nav-header">Admin Area</li>
            <li class="has-sub {{nav_active(array('panel','admin','kelas_bed'))}} {{nav_active(array('panel','admin','layanan'))}} {{nav_active(array('panel','admin','jenis'))}} {{nav_active(array('panel','admin','icdx'))}} {{nav_active(array('panel','admin','desa'))}}">
                <a href="javascript:;">
                    <b class="caret"></b>
                    <i class="ion-ios-book bg-gradient-orange"></i> 
                    <span>Referensi</span>
                </a>
                <ul class="sub-menu">
                    <li class="{{nav_active(array('panel','admin','kelas_bed'))}}"><a href="{{base_url('panel/admin/kelas_bed')}}">Kelas Bed</a></li>
                    <li class="{{nav_active(array('panel','admin','layanan'))}}"><a href="{{base_url('panel/admin/layanan')}}">Jenis Layanan</a></li>
                    <li class="{{nav_active(array('panel','admin','jenis'))}}"><a href="{{base_url('panel/admin/jenis')}}">Jenis Faskes</a></li>
                    <li class="{{nav_active(array('panel','admin','icdx'))}}"><a href="{{base_url('panel/admin/icdx')}}">ICD X</a></li>
                    <li class="{{nav_active(array('panel','admin','desa'))}}"><a href="{{base_url('panel/admin/desa')}}">Desa</a></li>
                </ul>
            </li>
            <li class="{{nav_active(array('panel','admin','users'))}}"><a href="{{('https://drzuhdy.com/kode-icd-10/')}}" target="_blank"><i class="ion-ios-gear-outline bg-red"></i> <span>Kode ICD-X (Bhs Ind)</span></a></li>
            <li class="{{nav_active(array('panel','admin','users'))}}"><a href="{{base_url('panel/admin/users')}}"><i class="ion-ios-gear-outline bg-green"></i> <span>Manajemen Pengguna</span></a></li>
            <li class="{{nav_active(array('panel','admin','dokumentasi'))}}"><a href="https://www.dropbox.com/s/ekzhgkxhq0txgj7/Buku%20Manual%20Penggnaan%20SIIRMAYU%20Dec2020.pdf?dl=0?dl=0" target="_blank"><i class="ion-document bg-pink"></i> <span>Panduan SIIRMAAYU 2020 <span class="label label-theme m-l-10">New</span></span></a> </li>
            @endif
            <!-- begin sidebar minify button -->
        </ul>
    </div>
</div>
<div class="sidebar-bg"></div>
