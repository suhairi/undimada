

<div class="mainheader" align="center">

<?php
Yii::app()->clientScript->registerScript('clickscript',"
$('#token').focus();
",CClientScript::POS_READY);
?>

<img src="<?php echo Yii::app()->request->baseUrl;?>/images/logo.jpg"/>
<h1>Selamat Datang Ke Sistem e-Undi</h1>
<h1>Lembaga Kemajuan Pertanian Muda <br /> (MADA)</h1>

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
<input id="token" type="text" name="token"/>
<input class="votebutton" type="submit" value="Tekan Sini Untuk Undian"/>
</form>
