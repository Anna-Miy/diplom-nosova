<?php
$this->breadcrumbs=array(
	'Точки'=>array('index'),
	'#' . $model->id,
);

$this->menu=array(
	array('label'=>'Список точек', 'url'=>array('index')),
	array('label'=>'Добавить точку', 'url'=>array('create')),
	array('label'=>'Редактировать точку', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить точку', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Управление точками', 'url'=>array('admin')),
);
?>
<article class="entry">
	<header class="entry-header">
		<h3 class="underlined">Точка #<?= $model->id ?></h3>
	</header>

	<div class="entry-content">

		<?php $this->widget('zii.widgets.CDetailView', array(
					'data' => $model,
					'attributes' => array('id','route_id','stop_id','lat','lng'),
		 )); ?>

	</div>

</article>