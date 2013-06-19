<div class="wide form">

<?php
    /** @var CActiveForm $form */
    $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?><br>
		<?php echo $form->textField($model,'id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'route_type_id'); ?><br>
		<?php echo $form->dropDownList($model,'route_type_id',array('' => 'Показать все') + CHtml::listData($allRouteTypes, 'id', 'name')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?><br>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
	</div>
	<span class="spacer"></span>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Поиск'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->