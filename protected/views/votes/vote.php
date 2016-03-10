<div class='undi'>
<?php
Yii::app()->clientScript->registerScript('clickscript',"

$(window).scroll(function()
{
  $('#message_box').animate({top:$(window).scrollTop()+'px' },{queue: false, duration: 350});
});

$('#close_message').click(function()
{
  //the messagebox gets scrool down with top property and gets hidden with zero opacity
  $('#message_box').animate({ top:'+=15px',opacity:0 }, 'slow');
});

$('#message_box').html('<h3>Bilangan undian yang telah dibuat</h3><h2>0/' + $seat->candidate_amount + '</h2>');

var selected = 0;
$('.ticked').hide();

$.each($('.calon'),function(dcalon){

	if($(this).find('.field').val()){
		$(this).find('.ticked').show();
		$(this).find('.gambar').hide();
		$(this).data('chosen',true);
		$(this).find('.field').val('1');
		selected+=1;
		
	} else {
		$(this).find('.ticked').hide();
		$(this).find('.gambar').show();
		$(this).data('chosen',false);
		$(this).find('.field').val('0');
	}
});


if(selected>=".$seat->minimum_choice."){
	$('#submitb').removeAttr('disabled');
} else {
	$('#submitb').attr('disabled','disabled');
}


$('.calon').bind('click', function() {

	if($(this).data('chosen')){

		$(this).find('.ticked').hide();
		$(this).find('.gambar').show();
		$(this).data('chosen',false);
		$(this).find('.field').val('0');
		selected-=1;
		$('#message_box').html('<h3>Pilihan yang telah dibuat</h3><h2>' + selected + '/' + $seat->candidate_amount + '</h2>');

	} else {
		if(selected<".$seat->candidate_amount."){
		$(this).find('.ticked').show();
		$(this).find('.gambar').hide();
		$(this).data('chosen',true);
		$(this).find('.field').val('1');
		selected+=1;
		$('#message_box').html('<h3>Pilihan yang telah dibuat</h3><h2>' + selected + '/' + $seat->candidate_amount + '</h2>');		
	} else {
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
	} else {
		return true;
	}
});
",CClientScript::POS_READY);
?>
<style type="text/css">
#message_box {
	position: absolute;
	top: 0; right: 0;
	z-index: 10;
	background:#ffc;
	padding:5px;
	border:1px solid #CCCCCC;
	text-align:center;
	font-weight:bold;
	width:250px;
	height: 80px;
}



</style>


<div id="message_box">
    <img id="close_message" style="float:right;cursor:pointer" src="../images/24-em-cross.png" />
    
</div>

<h1>Undi Calon Pilihan Anda</h1>
<?php if($seat){ ?>
<?php if($nextseat){ ?>
<form id="undian" action="vote" method="post">
<?php } else { ?>
<form id="undian" action="verify" method="post">
<?php } ?>
<h2><?php echo $seat->name;?></h2>
<h3 style="color: blue">Perlu undi paling kurang <?php echo $seat->minimum_choice;?> orang dan paling ramai <?php echo $seat->candidate_amount;?> orang</h3>
<ul>
	<?php $count=1; foreach($candidates as $calon){ ?>
	<li class="calon" data-id="<?php echo $calon->id?>">
	<img class="profile" src="<?php echo '../images/profile/' . $calon->picture?>" width="80" height="80" />
	<p style="font-size: 25px"><?php echo $count++.". ".$calon->name?></p>
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
