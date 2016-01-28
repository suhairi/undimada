<?php
$this->breadcrumbs=array(
	'Station Seats',
);

$this->menu=array(
	array('label'=>'Create StationSeat', 'url'=>array('create')),
	array('label'=>'Manage StationSeat', 'url'=>array('admin')),
);
?>

<h1>Station Seats</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
