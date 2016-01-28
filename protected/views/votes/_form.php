<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'votes-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'token_id'); ?>
		<?php echo $form->textField($model,'token_id'); ?>
		<?php echo $form->error($model,'token_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'candidate_id'); ?>
		<?php echo $form->dropDownList($model, 'candidate_id', CHtml::listData(Candidates::model()->findAll(), 'id', 'name'), array('prompt' => 'Select a candidate')); ?>
		<?php echo $form->error($model,'candidate_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created_date'); ?>
		<?php echo $form->textField($model,'created_date'); ?>
		<?php echo $form->error($model,'created_date'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
