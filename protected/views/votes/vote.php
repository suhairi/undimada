<div class='undi'>
<?php
Yii::app()->clientScript->registerScript('clickscript',"
var selected = 0;
$('.ticked').hide();
$.each($('.calon'),function(dcalon){
	if($(this).find('.field').val()){
		$(this).find('.ticked').show();
		$(this).find('.gambar').hide();
		$(this).data('chosen',true);
		$(this).find('.field').val('1');
		selected+=1;
		}
	else{
		$(this).find('.ticked').hide();
		$(this).find('.gambar').show();
		$(this).data('chosen',false);
		$(this).find('.field').val('0');
	}
	});
if(selected>=".$seat->minimum_choice."){
	$('#submitb').removeAttr('disabled');
}
else{
	$('#submitb').attr('disabled','disabled');
}
$('.calon').bind('click', function() {
	if($(this).data('chosen')){
		$(this).find('.ticked').hide();
		$(this).find('.gambar').show();
		$(this).data('chosen',false);
		$(this).find('.field').val('0');
		selected-=1;
	}
	else{
		if(selected<".$seat->candidate_amount."){
		$(this).find('.ticked').show();
		$(this).find('.gambar').hide();
		$(this).data('chosen',true);
		$(this).find('.field').val('1');
		selected+=1;
	}
	else{
		alert('Pilihan anda telah mencapai had jumlah calon');
		}
	}
	if(selected>=".$seat->minimum_choice."){
		$('#submitb').removeAttr('disabled');
	}
	else{
		$('#submitb').attr('disabled','disabled');
	}
});
$('#undian').submit(function(){
	if(selected==0){
	alert('Pilih sekurang-kurangnya seorang calon');
	return false;
		}
else{
	return true;
	};
	});
",CClientScript::POS_READY);
?>
<h1>Undi Calon Pilihan Anda</h1>
<?php if($seat){ ?>
<?php if($nextseat){ ?>
<form id="undian" action="vote" method="post">
<?php } else { ?>
<form id="undian" action="verify" method="post">
<?php } ?>
<h2><?php echo $seat->name;?></h2>
<p>Perlu undi paling kurang <?php echo $seat->minimum_choice;?> orang dan paling ramai <?php echo $seat->candidate_amount;?> orang</p>
<ul>
	<?php $count=1; foreach($candidates as $calon){ ?>
	<li class="calon" data-id="<?php echo $calon->id?>">
	<img class="profile" src="<?php echo '../images/profile/' . $calon->picture?>" width="70" height="70" />
	<p><?php echo $count++.". ".$calon->name?></p>
	<img class="ticked" src="../images/ticked.png"/>
<?php if($calon->picture) { ?>
	<img class="gambar" src="../images/defaultface.png"/>
<?php } else { ?>
	<img class="gambar" src="../images/defaultface.png"/>
<?php } ?>
<?php if(is_array($chosen) && isset($chosen[$seat->id])){ ?>
<input type="hidden" class="field" name="calon<?php echo $calon->id?>" value="<?php echo in_array($calon->id,$chosen[$seat->id]);?>"/>
<?php } else { ?>
<input type="hidden" class="field" name="calon<?php echo $calon->id?>" value=""/>
<?php } ?>
	</li>
	<?php } ?>
</ul>
<hr style="float: none; clear: both"/>
<?php if($nextseat){ ?>
<input type="hidden" name="nextseat_id" value="<?php echo $nextseat->id?>"/>
<?php } ?>
<input type="hidden" name="seat_id" value="<?php echo $seat->id?>"/>
<input type="hidden" name="election_id" value="<?php echo $election->id?>"/>
<input type="hidden" name="token_id" value="<?php echo $token->id?>"/>
<input name="submitb" id="submitb" class="button" type="submit" value="Undi"/>
</form>
<?php } ?>
</div>
