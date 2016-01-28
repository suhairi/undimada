<?php
$this->breadcrumbs=array(
	'Elections'=>array('Elections/index'),
	$model->election->name=>array('Elections/view','id'=>$model->election_id),
	'Seats'=>array('Seats/index','election_id'=>$model->election_id),
	$model->name=>array('Seats/view','election_id'=>$model->election_id,'id'=>$model->id),
	'Update'
);

$this->menu=array(
);
?>

<h1>Update Seats <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'election'=>$election)); ?>
