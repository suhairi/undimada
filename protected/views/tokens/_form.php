<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tokens-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'token'); ?>
		<?php echo $form->textField($model,'token',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'token'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'election_id'); ?>
		<?php echo $form->textField($model,'election_id'); ?>
		<?php echo $form->error($model,'election_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'done_vote'); ?>
		<?php echo $form->textField($model,'done_vote'); ?>
		<?php echo $form->error($model,'done_vote'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_vote'); ?>
		<?php echo $form->textField($model,'date_vote'); ?>
		<?php echo $form->error($model,'date_vote'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->