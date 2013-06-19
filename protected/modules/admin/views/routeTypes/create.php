<?php
$this->breadcrumbs=array(
	'Типы маршрутов'=>array('index'),
	'Создать новый тип',
);

$this->menu=array(
	array('label'=>'Список типов маршрута', 'url'=>array('index')),
	array('label'=>'Управление типами маршрутов', 'url'=>array('admin')),
);
?>


<article class="entry">

	<header class="entry-header">
		<h3 class="underlined">Новый тип маршрута</h3>
	</header>

	<div class="entry-content">
		<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</article>