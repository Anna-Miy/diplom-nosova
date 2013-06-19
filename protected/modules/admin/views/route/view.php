<?php
$this->breadcrumbs=array(
	'Маршруты'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Список маршрутов', 'url'=>array('index')),
	array('label'=>'Добавить новый маршрут', 'url'=>array('create')),
	array('label'=>'Редактировать маршрут', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить маршрут', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Управление маршрутами', 'url'=>array('admin')),
);
?>
<article class="entry">
	<header class="entry-header">
		<h3 class="underlined"><?= $model->name ?></h3>
	</header>

	<div class="entry-content">

		<?php $this->widget('zii.widgets.CDetailView', array(
					'data' => $model,
					'attributes' => array('id','route_type_id','name',),
		 )); ?>

	</div>

</article>