<?php
Yii::import('zii.widgets.jui.CJuiInputWidget');

class AnyTime extends CJuiInputWidget
{
	public $i18nScriptFile = "jquery-ui-i18n.min.js";
	public $extraScriptFile = "anytimec.js";
	public $extraScriptFile2 = "anytimetz.js";
	public $extraCssFile = "anytimec.css";
	
	public function init()
	{
		parent::init();
		$path = pathinfo(__FILE__);
		$basePath = $path['dirname']. '/assets';
		$baseUrl=Yii::app()->getAssetManager()->publish($basePath);
		$cs=Yii::app()->getClientScript();
		$cs->registerCssFile($baseUrl.'/'.$this->extraCssFile);
		$cs->registerScriptFile($baseUrl.'/'.$this->extraScriptFile, CClientScript::POS_END);
		$cs->registerScriptFile($baseUrl.'/'.$this->extraScriptFile2, CClientScript::POS_END);
	}

	public function run()
	{
		list($name,$id)=$this->resolveNameID();
		if(isset($this->htmlOptions['id']))
			$id=$this->htmlOptions['id'];
		else
			$this->htmlOptions['id']=$id;
		if(isset($this->htmlOptions['name']))
			$name=$this->htmlOptions['name'];
		else
			$this->htmlOptions['name']=$name;
		if($this->hasModel())
			echo CHtml::activeTextField($this->model,$this->attribute,$this->htmlOptions);
		else
			echo CHtml::textField($name,$this->value,$this->htmlOptions);
		$options=CJavaScript::encode($this->options);
		$js = "jQuery('#{$id}').AnyTime_picker($options);";
		Yii::app()->getClientScript()->registerScript(__CLASS__.'#'.$id, $js);
	}
}
