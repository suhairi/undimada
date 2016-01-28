<?php
$this->breadcrumbs=array(
	'Elections'=>array('Elections/index'),
	$model->election->name=>array('Elections/view','id'=>$model->election_id),
	'Seats'=>array('Seats/index','election_id'=>$model->election_id),
	$model->name,
);

$this->menu=array(
	array('label'=>'Candidates', 'url'=>array('Candidates/index','seat_id'=>$model->id)),
	array('label'=>'Update Seat', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Seat', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Seats #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'election_id',
		'name',
		'minimum_choice',
		'candidate_amount',
		'priority',
	),
)); ?>
