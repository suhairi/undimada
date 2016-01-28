<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'token'); ?>
		<?php echo $form->textField($model,'token',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'election_id'); ?>
		<?php echo $form->textField($model,'election_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'done_vote'); ?>
		<?php echo $form->textField($model,'done_vote'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_vote'); ?>
		<?php echo $form->textField($model,'date_vote'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
