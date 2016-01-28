<?php
$this->breadcrumbs=array(
	'Votes',
);

$this->menu=array(
	array('label'=>'Create Votes', 'url'=>array('create')),
	array('label'=>'Manage Votes', 'url'=>array('admin')),
	array('label'=>'Start Voting', 'url'=>array('welcome')),
);
?>

<h1>Votes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
