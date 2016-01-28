<?php
$this->breadcrumbs=array(
	'Elections'=>array('Elections/index'),
	$model->seat->election->name=>array('Elections/view','id'=>$model->seat->election_id),
	'Seats'=>array('Seats/index','election_id'=>$model->seat->election_id),
	$model->seat->name=>array('Seats/view','id'=>$model->seat->id),
	'Candidates'=>array('Candidates/index','seat_id'=>$model->seat->id),
	$model->name,
);

$this->menu=array(
);
?>

<h1>Update Candidates <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'seat'=>$seat)); ?>
