<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'seats-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'election_id'); ?>
		<?php echo $election->name;?>
		<?php echo $form->hiddenField($model,'election_id',array('value'=>$election->id)); ?>
		<?php echo $form->error($model,'election_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'minimum_choice'); ?>
		<?php echo $form->textField($model,'minimum_choice'); ?>
		<?php echo $form->error($model,'minimum_choice'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'candidate_amount'); ?>
		<?php echo $form->textField($model,'candidate_amount'); ?>
		<?php echo $form->error($model,'candidate_amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'priority'); ?>
		<?php echo $form->textField($model,'priority'); ?>
		<?php echo $form->error($model,'priority'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
