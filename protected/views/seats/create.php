<?php
$this->breadcrumbs=array(
	'Elections'=>array('Elections/index'),
	$election->name=>array('Elections/view','id'=>$election->id),
	'Seats'=>array('Seats/index','election_id'=>$election->id),
	'Create',
);

$this->menu=array(
);
?>

<h1>Create Seats</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'election'=>$election)); ?>
