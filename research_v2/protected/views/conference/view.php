<?php
/* @var $this ConferenceController */
/* @var $model Conference */

$this->breadcrumbs=array(
	'Conferences'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Conference', 'url'=>array('index')),
	array('label'=>'Create Conference', 'url'=>array('create')),
	array('label'=>'Update Conference', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Conference', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Conference', 'url'=>array('admin')),
);
?>

<h1>View Conference #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'description',
		'start_date',
		'end_date',
		'location',
		'address',
		'city',
		'country',
	),
)); ?>
