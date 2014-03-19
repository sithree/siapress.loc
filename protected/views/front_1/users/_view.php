<li>
	<?php echo CHtml::link(CHtml::encode($data->name),Yii::app()->request->hostInfo .
            '/search?SearchForm%5Btext%5D=&SearchForm%5Bcategory%5D=&SearchForm%5Bauthor%5D=' .str_replace(' ', '+',CHtml::encode($data->name)). '&yt0=',
            array('rel'=>'noindex')); ?>
</li>