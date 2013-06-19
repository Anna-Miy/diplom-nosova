<?php
$this->breadcrumbs=array(
	'Маршруты'=>array('index'),
	'Добавить новый',
);

$this->menu=array(
	array('label'=>'Список маршрутов', 'url'=>array('index')),
	array('label'=>'Управление маршрутами', 'url'=>array('admin')),
);
?>


<article class="entry">
	<header class="entry-header">
		<h3 class="underlined">Добавление маршрута</h3>
	</header>

	<div class="entry-content">
		<?php echo $this->renderPartial('_form', array('model' => $model)); ?>
	</div>

</article>