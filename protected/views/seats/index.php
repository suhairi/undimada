<?php
$this->breadcrumbs=array(
	'Elections'=>array('Elections/index'),
	$election->name=>array('Elections/view','id'=>$election->id),
	'Seats',
);

$this->menu=array(
	array('label'=>'Create Seat', 'url'=>array('create','election_id'=>$election->id)),
);
?>
<div id="seats">

<h1>Seats</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

</div>
