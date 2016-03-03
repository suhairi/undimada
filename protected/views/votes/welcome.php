

<div class="mainheader" align="center">

<?php
Yii::app()->clientScript->registerScript('clickscript',"
$('#token').focus();
",CClientScript::POS_READY);
?>

<img src="<?php echo Yii::app()->request->baseUrl;?>/images/logo.jpg"/>

<h1>Selamat Datang Ke Sistem e-Undi</h1>
<!-- <h1>Lembaga Kemajuan Pertanian Muda <br /> (MADA)</h1> -->
<blockquote>Wahai orang-orang yang beriman! Janganlah kamu mengambil orang-orang yang menjadikan agama kamu sebagai ejek-ejekan dan permainan dari orang-orang yang telah diberikan Kitab sebelum kamu dan orang-orang kafir musyrik itu: Menjadi penolong-penolong dan bertakwalah kepada Allah, jika kamu benar-benar orang yang beriman.</blockquote>
<small><small><blockquote>... Al-Maidah 5:57</blockquote></small></small>

</div>
<?php
if($error_msg){
?>
	<script type='text/javascript'>
	alert('<?php echo $error_msg?>');
	</script>
<?php
}
?>
<form id="tokenform" action="vote" method="post">
<label>Taipkan nombor anda di sini :</label>
<input id="token" type="text" name="token" autocomplete="off" /><br />
<input class="votebutton" type="submit" value="Tekan Sini Untuk Undian"/>
</form>
