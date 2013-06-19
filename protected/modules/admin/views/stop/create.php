<?php
$this->breadcrumbs=array(
	'Остановки'=>array('index'),
	'Новая остановка',
);

$this->menu=array(
	array('label'=>'Список остановок', 'url'=>array('index')),
	array('label'=>'Управление остановками', 'url'=>array('admin')),
);
?>

<article class="entry">
	<header class="entry-header">
		<h3 class="underlined">Новая остановка</h3>
	</header>

	<div class="entry-content">
		<?php echo $this->renderPartial('_form', array('model' => $model)); ?>
	</div>

</article>