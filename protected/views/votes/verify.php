<div class='undi'>
<h1>Sila Sahkan Pilihan Anda</h1>
<?php
	$chosen=Yii::app()->session['chosenones'];
?>
<?php foreach($seats as $seat) { ?>
<h2 style="display: inline;"><?php echo $seat->name?></h2>
<form style="display: inline;" action="vote" method="post">
<input type="hidden" name="nextseat_id" value="<?php echo $seat->id?>"/>
<input type="hidden" name="seat_id" value="<?php echo $seat->id?>"/>
<input type="hidden" name="election_id" value="<?php echo $election->id?>"/>
<input type="hidden" name="token_id" value="<?php echo $token->id?>"/>
<input type="hidden" name="correction" value="1"/>
<input type="submit" class="votebutton" value="Tekan Sini Untuk Membuat Pembetulan"/>
</form>
<ul>
<?php 

	foreach($candidates[$seat->id] as $calon){ ?>
	<li class="calon" data-id="<?php echo $calon->id?>">
<!--<?php if($calon->picture) { ?>
	<img class="gambar" src="<?php echo $calon->picture?>"/>
<?php } else { ?>
	<img class="gambar" src="../images/defaultface.png"/>
<?php } ?>-->
	<p><?php echo $cnumber[$calon->id].". ".$calon->name?></p>
	</li>
<?php } ?>
</ul>
<hr style="float: none; clear: both"/>
<?php } ?>
<form action="thanks" method="post">
<input type="hidden" name="election_id" value="<?php echo $election->id?>"/>
<input type="hidden" name="token_id" value="<?php echo $token->id?>"/>
<input class="votebutton button" type="submit" value="Tekan Sini Untuk Sahkan Undian Anda"/>
</form>
</div>
