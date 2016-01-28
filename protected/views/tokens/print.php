<h1>Tokens For <?php echo $election->name;?></h1>

<style>
tr {
	border: 1px solid black;
}
table {
width: 100%;
border-collapse: collapse;
border: 1px solid black;
}
</style>
<?php
foreach($tokens as $data){
?>
<div class="view">
<table>
<tr>
<td style="vertical-align: top; width: 50%;">
	<b><?php echo CHtml::encode($data->getAttributeLabel('token')); ?>:</b>
	<?php echo CHtml::encode($data->token); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('done_vote')); ?>:</b>
	<?php echo CHtml::encode($data->done_vote); ?>
	<br />

	<?php if($data->done_vote){ ?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('date_vote')); ?>:</b>
	<?php echo CHtml::encode(date('h:i a d/m/Y',strtotime($data->date_vote))); ?>
	<br />
	<?php } ?>
	</td>
<td>
<?php if($data->done_vote){
	foreach($seats as $seat) { 
	$i=1;
	$seatsid=null;
	$cnumber=null;
	foreach($seat->candidates() as $candidate){
		$seatsid[]=$candidate->id;
		$cnumber[$candidate->id]=$i;
		$i++;
	}
	echo "<b>".$seat->name."</b><br/>";
	$finallist = null;
	foreach($data->votes() as $vote){
		if(in_array($vote->candidate_id,$seatsid)){
			$finallist[$cnumber[$vote->candidate_id]]=$cnumber[$vote->candidate_id].". ".$vote->candidate->name;
		}
	}
	if($finallist){
		ksort($finallist);
		echo join("<br/>",$finallist);
	}
	echo "<br/>";
	}
}?>
</td>
</tr>
</table>

</div>
<?php
}
?>

