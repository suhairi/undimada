<?php
$this->breadcrumbs=array(
	'Elections'=>array('Elections/index'),
	$seat->election->name=>array('Elections/view','id'=>$seat->election_id),
	'Seats'=>array('Seats/index','election_id'=>$seat->election_id),
	$seat->name=>array('Seats/view','id'=>$seat->id),
	'Candidates'=>array('Candidates/index','seat_id'=>$seat->id),
	'Create',
);

$this->menu=array(
);
?>

<h1>Create Candidates</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'seat'=>$seat)); ?>
