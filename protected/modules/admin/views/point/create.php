<?php
$this->breadcrumbs=array(
	'Точки'=>array('index'),
	'Новая точка',
);

$this->menu=array(
	array('label'=>'Список точек', 'url'=>array('index')),
	array('label'=>'Управление точками', 'url'=>array('admin')),
);
?>

<article class="entry">
	<header class="entry-header">
		<h3 class="underlined">Новая точка</h3>
	</header>

	<div class="entry-content">
		<?php echo $this->renderPartial('_form', array('model' => $model)); ?>
	</div>

</article>