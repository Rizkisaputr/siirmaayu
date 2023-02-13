<address>
  <strong>{{$data_rs->nama}}</strong><br>
  <span class="ion-ios-home-outline"></span> {{$data_rs->alamat}}<br>
  <abbr title="Phone"></abbr> <span class="ion-ios-telephone-outline"></span> {{$data_rs->telepon}}
</address>
<div class="detail-row my-2">
	<div class="detail-title mb-1"><h6>Dokter Spesialis On-Site / On-Call</h6></div>
	<table class="table table-striped table-hover" style="font-size: 11px;">
		<thead>
		<tr>
			<th>Nama Dokter</th>
			<th>Bidang</th>
		</tr>
		</thead>
		<tbody>
		@foreach($dokter as $row)
			<tr>
				<td>{{$row->nama}}</td>
				<td>{{$row->bidang}}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
</div>
<div class="detail-row my-2">
	<div class="detail-title mb-1"><h6>Fasilitas & Alkes Emergency</h6></div>
	<table class="table table-striped table-hover" style="font-size: 11px;">
		<thead>
		<tr>
			<th>Nama Fasilitas</th>
			<th>Jumlah</th>
		</tr>
		</thead>
		<tbody>
		@foreach($faskes as $row)
			<tr>
				<td>{{$row->nama_faskes}}</td>
				<td>{{$row->jumlah}}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
</div>

<div class="detail-row my-2">
	<div class="detail-title mb-1"><h6>Ruang Isolasi, Intesif Care, Khusus Ibu dan Bayi</h6></div>
	<table class="table table-striped table-hover" style="font-size: 11px;">
		<thead class="thead-dark">
		<tr>
			<th>NAMA FASILITAS</th>
			<th>KELAS</th>
			<th>TERSEDIA</th>
			<th>TERPAKAI</th>
		</tr>
		</thead>
		<tbody>
		@foreach($bed as $row)
			<tr>
				<td class="text-left">{{$row->nama}}</td>
				<td>{{$row->kelas}}</td>
				<td class="text-left">{{$row->kapasitas_l-$row->terpakai_l}}</td>
				<td class="text-left">{{$row->terpakai_l}}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
</div>
<div class="detail-row my-2">
	<div class="detail-title mb-1"><h6>Ruang Perawatan tanpa Pemisahan Laki / Perempuan</h6></div>
	<table class="table table-striped table-hover" style="font-size: 11px;">
		<thead class="thead-dark">
		<tr>
			<th>NAMA FASILITAS</th>
			<th>KELAS</th>
			<th>TERSEDIA</th>
			<th>TERPAKAI</th>
		</tr>
		</thead>
		<tbody>
		@foreach($bed2 as $row)
			<tr>
				<td>{{$row->nama}}</td>
				<td>{{$row->kelas}}</td>
				<td>{{$row->kapasitas_l-$row->terpakai_l}}</td>
				<td>{{$row->terpakai_l}}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
</div>
<div class="detail-row my-2">
	<div class="detail-title mb-1"><h6>Ruang Perawatan dengan Pemisahan Laki / Perempuan</h6></div>
	<table class="table table-striped table-hover" style="font-size: 11px;">
		<thead class="thead-dark">
		<tr>
			<th rowspan="2">NAMA FASILITAS</th>
			<th rowspan="2">KELAS</th>
			<th colspan="2" class="text-left">TERSEDIA</th>
			<th colspan="2" class="text-left">TERPAKAI</th>
		</tr>
		<tr>
			<th class="">L</th>
			<th class="">P</th>
			<th class="">L</th>
			<th class="">P</th>
		</tr>
		</thead>
		<tbody>
		@foreach($bed3 as $row)
			<tr>
				<td>{{$row->nama}}</td>
				<td>{{$row->kelas}}</td>
				<td>{{$row->kapasitas_l-$row->terpakai_l}}</td>
				<td>{{$row->kapasitas_p-$row->terpakai_p}}</td>
				<td>{{$row->terpakai_l}}</td>
				<td>{{$row->terpakai_p}}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
</div>
<div class="detail-row my-2">
	<div class="detail-title mb-1"><h6>Layanan</h6></div>
	<table class="table table-striped table-hover" style="font-size: 11px;">
		<thead>
		<tr>
			<th rowspan="1">Nama</th>
		</tr>
		</thead>
		<tbody>
		@foreach($layanan as $l)
			<tr>
				<td>{{$l->nama}}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
</div>


