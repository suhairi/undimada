<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'stations-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'voters_count'); ?>
		<?php echo $form->textField($model,'voters_count'); ?>
		<?php echo $form->error($model,'voters_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'start_date'); ?>
<?php
$this->widget('zii.widgets.jui.CJuiDatePicker', array(
	'model'=>$model,
	'attribute'=>'start_date',
	// additional javascript options for the date picker plugin
	'options'=>array(
		'showAnim'=>'fold',
		'dateFormat'=>'yy-mm-dd',
	),
	'htmlOptions'=>array(
		'style'=>'height:20px;'
	),
));
?>
		<?php echo $form->error($model,'start_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'end_date'); ?>
<?php
$this->widget('zii.widgets.jui.CJuiDatePicker', array(
	'model'=>$model,
	'attribute'=>'end_date',
	// additional javascript options for the date picker plugin
	'options'=>array(
		'showAnim'=>'fold',
		'dateFormat'=>'yy-mm-dd',
	),
	'htmlOptions'=>array(
		'style'=>'height:20px;'
	),
));
?>
		<?php echo $form->error($model,'end_date'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
