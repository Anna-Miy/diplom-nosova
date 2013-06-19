<?php
$this->breadcrumbs=array(
	'Маршруты',
);

$this->menu=array(
	array('label'=>'Добавить новый маршрут', 'url'=>array('create')),
	array('label'=>'Управление маршрутами', 'url'=>array('admin')),
);
?>


<article class="entry">

  <header class="entry-header">
    <h2>Маршруты</h2>
  </header>

  <div class="entry-content">

    <?php $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'_view',
        'itemsTagName' => 'ul'
    )); ?>

  </div>
  <!-- END .entry-content -->
</article>