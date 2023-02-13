<address>
  <strong><?php echo e($data_rs->nama); ?></strong><br>
  <span class="ion-ios-home-outline"></span> <?php echo e($data_rs->alamat); ?><br>
  <abbr title="Phone"></abbr> <span class="ion-ios-telephone-outline"></span> <?php echo e($data_rs->telepon); ?>

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
		<?php $__currentLoopData = $dokter; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><?php echo e($row->nama); ?></td>
				<td><?php echo e($row->bidang); ?></td>
			</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
		<?php $__currentLoopData = $faskes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><?php echo e($row->nama_faskes); ?></td>
				<td><?php echo e($row->jumlah); ?></td>
			</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
		<?php $__currentLoopData = $bed; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td class="text-left"><?php echo e($row->nama); ?></td>
				<td><?php echo e($row->kelas); ?></td>
				<td class="text-left"><?php echo e($row->kapasitas_l-$row->terpakai_l); ?></td>
				<td class="text-left"><?php echo e($row->terpakai_l); ?></td>
			</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
		<?php $__currentLoopData = $bed2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><?php echo e($row->nama); ?></td>
				<td><?php echo e($row->kelas); ?></td>
				<td><?php echo e($row->kapasitas_l-$row->terpakai_l); ?></td>
				<td><?php echo e($row->terpakai_l); ?></td>
			</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
		<?php $__currentLoopData = $bed3; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><?php echo e($row->nama); ?></td>
				<td><?php echo e($row->kelas); ?></td>
				<td><?php echo e($row->kapasitas_l-$row->terpakai_l); ?></td>
				<td><?php echo e($row->kapasitas_p-$row->terpakai_p); ?></td>
				<td><?php echo e($row->terpakai_l); ?></td>
				<td><?php echo e($row->terpakai_p); ?></td>
			</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
		<?php $__currentLoopData = $layanan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><?php echo e($l->nama); ?></td>
			</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tbody>
	</table>
</div>


