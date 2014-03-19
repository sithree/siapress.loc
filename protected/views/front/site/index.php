
<?php $this->widget('application.components.widgets.Blogs');  ?>


<?php

Yii::app()->getClientScript()->registerScript('ajaxnewsbutton', "
    $('.newsajaxbutton').click(function(){
        $('#category').attr('value',$(this).attr('rel'));
        $('.newsajaxbutton').parent().removeClass('active');
        $(this).parent().addClass('active');
    });
");
?>


<?php // $this->widget('application.components.main.official'); ?>
<?php // $this->widget('application.components.main.quest'); ?>
<?php // include($_SERVER['DOCUMENT_ROOT'] . '/_lm8ea8f138e7abf12fd3b69de62a906877/linkmoney.php'); ?>
<?php // $this->widget('application.components.main.popular'); ?>



<?php

for ($pollCount = 0; $pollCount < 3; $pollCount++) {
    $this->widget('EPoll');
}
?>





