<?php
$this->breadcrumbs=array(
	'Elections'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Seats', 'url'=>array('Seats/index','election_id'=>$model->id)),
	array('label'=>'Results', 'url'=>array('results','id'=>$model->id)),
	array('label'=>'Tokens', 'url'=>array('Tokens/index','election_id'=>$model->id)),
	array('label'=>'Update Election', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Election', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Elections #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'voters_count',
		'start_date',
		'end_date',
	),
)); ?>
