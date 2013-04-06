<?php
/* @var $this ResearchController */
/* @var $model Research */

$this->breadcrumbs=array(
	'Researches'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Research', 'url'=>array('index')),
	array('label'=>'Create Research', 'url'=>array('create')),
	array('label'=>'Update Research', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Research', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Research', 'url'=>array('admin')),
);
?>

<h1>View Research #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'description',
		'download_count',
		'view_count',
		'create_date',
		'user_id',
		'research_group_id',
	),
)); ?>
