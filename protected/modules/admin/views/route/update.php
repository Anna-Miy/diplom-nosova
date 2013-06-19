<?php
$this->breadcrumbs=array(
	'Маршруты'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Редактировать',
);

$this->menu=array(
	array('label'=>'Список маршрутов', 'url'=>array('index')),
	array('label'=>'Добавить новый маршрут', 'url'=>array('create')),
	array('label'=>'View Route', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление маршрутами', 'url'=>array('admin')),
);
?>
<article class="entry">
	<header class="entry-header">
		<h3 class="underlined">Редактирование маршрута "<?php echo $model->name; ?>"</h3>
	</header>

	<div class="entry-content">
		<?php echo $this->renderPartial('_form', array('model' => $model, 'encodedRoutePoints' => $encodedRoutePoints)); ?>
	</div>

</article>