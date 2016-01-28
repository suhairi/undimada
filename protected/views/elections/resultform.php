<div class="resultform">
<?php
$seatnumber=1;
foreach($seats as $seat){
	if($seatnumber++>1){
		echo "<p style='page-break-before:always'></p>";
	}
$i=1;
?>
	<h1>KEPUTUSAN <?php echo strtoupper($election->name);?></h1>
<h1>SENARAI KEPUTUSAN PEMILIHAN JEMAAH PENGARAH</h1>
	<h2>NAMA PPK/PPN/NAFAS : <?php echo $seat->name;?></h2>
<h2>TARIKH MESYUARAT AGUNG : <?php echo date('d/m/Y',strtotime($election->start_date));?></h2>
<table class='resultlist'>
<thead>
<tr><th class='header'>BIL. IKUT<br/>UNDI TERBANYAK</th><th class='header'>NAMA CALON</th><th>BIL. UNDI</th><th>CATATAN JIKA UNDI SAMA DSB.</th></tr>
</thead>
<tbody>
<?php foreach($seat->candidates() as $candidate){ ?>
<tr>
<td style="width: 10%"><?php echo $i++;?></td>
<td style="width: 40%"><?php echo $candidate->name; ?></td>
<td style="width: 10%"><?php echo $candidate->votescount; ?></td>
<td style="width: 40%"></td>
</tr>
<?php } ?>
</tbody>
</table>
<br/><br/>
<table style="width: 100% ">
<tr>
<td style="vertical-align: top;">
Pegawai Penyelia:<br/>
</td>
<td style="text-align:right;">
Tandatangan: ___________________________<br/><br/>
Nama: __________________________________<br/><br/>
Jawatan: _______________________________
</td>
</tr>
<tr>
<td colspan=2>
<hr/>
</td>
</tr>
<tr>
<td colspan=2>
&nbsp;
</td>
</tr>
<tr>
<td style="vertical-align: top;">
Pegawai Pemerhati 1:<br/>
</td>
<td style="text-align:right;">
Tandatangan: ___________________________<br/><br/>
Nama: __________________________________<br/><br/>
Jawatan: _______________________________
</td>
</tr>
<tr>
<td colspan=2>
<hr/>
</td>
</tr>
<tr>
<td colspan=2>
&nbsp;
</td>
</tr>
<tr>
<td style="vertical-align: top;">
Pegawai Pemerhati 2:<br/>
</td>
<td style="text-align:right;">
Tandatangan: ___________________________<br/><br/>
Nama: __________________________________<br/><br/>
Jawatan: _______________________________
</td>
</tr>
<tr>
<td>
(hendaklah disediakan dalam 2 salinan)<br/>
Salinan asal<br/>
Untuk Bahagian Pengurusan<br/>
LPP Negeri/Pendaftar<br/>
<br/>
Salinan Kedua<br/>
Untuk Simpanan PPK/PPN/NAFAS
</td>
</tr>
</table>
<?php
}
?>
</div>
