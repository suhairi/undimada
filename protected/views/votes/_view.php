<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('token_id')); ?>:</b>
	<?php echo CHtml::encode($data->token_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('candidate_id')); ?>:</b>
	<?php echo CHtml::encode($data->candidate_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_date')); ?>:</b>
	<?php echo CHtml::encode($data->created_date); ?>
	<br />


</div>