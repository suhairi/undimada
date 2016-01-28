<?php
$this->breadcrumbs=array(
	'Tokens'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Tokens', 'url'=>array('index')),
	array('label'=>'Manage Tokens', 'url'=>array('admin')),
);
?>

<h1>Create Tokens</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>