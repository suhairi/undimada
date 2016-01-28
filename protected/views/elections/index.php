<?php
$this->breadcrumbs=array(
	'Elections',
);

$this->menu=array(
	array('label'=>'Create Election', 'url'=>array('create')),
);
?>
<div id="elections">

<h1>Elections</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

</div>
