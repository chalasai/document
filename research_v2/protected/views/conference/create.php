<?php
/* @var $this ConferenceController */
/* @var $model Conference */

$this->breadcrumbs=array(
	'Conferences'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Conference', 'url'=>array('index')),
	array('label'=>'Manage Conference', 'url'=>array('admin')),
);
?>

<h1>Create Conference</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>