<?php
$this->breadcrumbs=array(
	'Остановки',
);

$this->menu=array(
	array('label'=>'Добавить остановку', 'url'=>array('create')),
	array('label'=>'Управление остановками', 'url'=>array('admin')),
);
?>

<h1>Stops</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
