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
	array('label'=>'Update Candidate', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Candidate', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Candidates #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'election_id',
		'seat_id',
		'name',
		'nickname',
	),
)); ?>
