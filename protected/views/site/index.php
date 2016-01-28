<?php $this->pageTitle=Yii::app()->name; ?>
<h1>Selamat datang ke Sistem Undimaya</h1>
<?php if(!Yii::app()->user->isGuest){ ?>
<ul>
<li><?php echo CHtml::link('Elections',array('elections/'));?></li>
<li><?php echo CHtml::link('Seats',array('seats/'));?></li>
<li><?php echo CHtml::link('Candidates',array('candidates/'));?></li>
<li><?php echo CHtml::link('Tokens',array('tokens/'));?></li>
<li><?php echo CHtml::link('Votes',array('votes/'));?></li>
</ul>
<?php } ?>
