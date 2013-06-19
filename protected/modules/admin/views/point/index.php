<?php
$this->breadcrumbs=array(
	'Точки',
);

$this->menu=array(
	array('label'=>'Добавить точку', 'url'=>array('create')),
	array('label'=>'Управление точками', 'url'=>array('admin')),
);
?>
<article class="entry">
	<header class="entry-header">
		<h3 class="underlined">Точки</h3>
	</header>

	<div class="entry-content">
		<?php $this->widget('zii.widgets.CListView', array('dataProvider' => $dataProvider,'itemView' => '_view')); ?>
	</div>

</article>