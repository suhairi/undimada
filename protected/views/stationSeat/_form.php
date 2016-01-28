<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'station-seat-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'seat_id'); ?>
		<?php echo $form->dropDownList($model, 'seat_id', CHtml::listData(Seats::model()->findAll(), 'id', 'name'), array('prompt' => 'Select a seat')); ?>
		<?php echo $form->error($model,'seat_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'station_id'); ?>
		<?php echo $form->dropDownList($model, 'station_id', CHtml::listData(Stations::model()->findAll(), 'id', 'name'), array('prompt' => 'Select a station')); ?>
		<?php echo $form->error($model,'station_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
