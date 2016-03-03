<?php $this->beginContent('//layouts/main'); ?>
<div class="span-19">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="span-5 last">
	<div id="sidebar">
	<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Operations',
		));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'operations'),
		));
		$this->endWidget();
		?>

		<ol>
			<li>AJP Terbuka</li>
			<li>AJP Peladang Muda</li>
			<li>AJP Peladang Nita</li>
			<li>Perwakilan ke MAT PPN</li>
			<li>Calon AJP PPN</li>
			<li>Calon AJP Peladang Muda PPN</li>
			<li>Calon AJP Nita PPN</li>
			<li>Calon Perwakilan PPN ke MAT NAFAS</li>
			<li>Calon Audit Dalam PPK</li>
		<ol>
		
	</div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>