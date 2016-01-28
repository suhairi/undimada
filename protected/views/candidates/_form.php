<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'candidates-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'election_id'); ?>
		<?php echo $seat->election->name;?>
		<?php echo $form->hiddenField($model,'election_id',array('value'=>$seat->election->id)); ?>
		<?php echo $form->error($model,'election_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'seat_id'); ?>
		<?php echo $seat->name;?>
		<?php echo $form->hiddenField($model,'seat_id',array('value'=>$seat->id)); ?>
		<?php echo $form->error($model,'seat_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nickname'); ?>
		<?php echo $form->textField($model,'nickname',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'nickname'); ?>
	</div>

	<!--<div class="row">
		<?php echo $form->labelEx($model,'picture'); ?>
		<?php echo $form->textField($model,'picture',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'picture'); ?>
	</div>-->

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
