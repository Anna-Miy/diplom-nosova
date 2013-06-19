<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="one-fourth">
		<?php echo $form->label($model,'id'); ?><br>
		<?php echo $form->textField($model,'id',array('size'=>15,'maxlength'=>10)); ?>
	</div>
	
	<div class="three-fourth last">
		<?php echo $form->label($model,'pos'); ?><br>
		<?php echo $form->textField($model,'pos',array('size'=>15,'maxlength'=>10)); ?>
	</div>

	<div class="one-fourth">
		<?php echo $form->label($model,'route_id'); ?><br>
		<?php echo $form->textField($model,'route_id',array('size'=>15,'maxlength'=>10)); ?>
	</div>

	<div class="three-fourth last">
		<?php echo $form->label($model,'stop_id'); ?><br>
		<?php echo $form->textField($model,'stop_id',array('size'=>15,'maxlength'=>10)); ?>
	</div>

	<div class="one-fourth">
		<?php echo $form->label($model,'lat'); ?><br>
		<?php echo $form->textField($model,'lat',array('size'=>15,'maxlength'=>10)); ?>
	</div>

	<div class="three-fourth last">
		<?php echo $form->label($model,'lng'); ?><br>
		<?php echo $form->textField($model,'lng',array('size'=>15,'maxlength'=>10)); ?>
	</div>

	<span class="spacer"></span>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Поиск'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->