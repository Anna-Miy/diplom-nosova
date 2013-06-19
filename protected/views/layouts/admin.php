<?php $this->beginContent('//layouts/_layout'); ?>

<div id="sidebar" class="one-third" style="float: left;">
  <div class="deco-top"></div>
  <div class="deco-center">
    <div class="content">


      <aside class="widget list-widget">
        <h3 class="widget-title">Меню</h3>
	      <span class="spacer"></span>
        <div class="widget-content">
				<?php $this->widget('zii.widgets.CMenu', array(
						'items'=>$this->menu,
						'htmlOptions'=>array('class'=>'operations'),
				)); ?>
        </div>
      </aside>

    </div>
    <!-- END .content -->
  </div>
  <!-- END .deco-center -->
  <div class="deco-bottom"></div>
</div>
<!-- END #sidebar -->



<div id="content" class="two-third last">

  <?php echo $content ?>

</div>
<!-- END #content -->

<?php $this->endContent(); ?>