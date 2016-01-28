<?php
$this->breadcrumbs=array(
	'Elections'=>array('Elections/index'),
	$seat->election->name=>array('Elections/view','id'=>$seat->election_id),
	'Seats'=>array('Seats/index','election_id'=>$seat->election_id),
	$seat->name=>array('Seats/view','id'=>$seat->id),
	'Candidates',
);

$this->menu=array(
	array('label'=>'Create Candidates', 'url'=>array('create','seat_id'=>$seat->id)),
);
?>

<h1>Candidates</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
