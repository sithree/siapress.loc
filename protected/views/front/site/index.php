<div id="rontar_adplace_5712"></div>
<script type="text/javascript"><!--

    (function(w, d, n) {
        var ri = {rontar_site_id: 1717, rontar_adplace_id: 5712, rontar_place_id: 'rontar_adplace_5712', adCode_rootUrl: 'http://adcode.rontar.com/'};
        w[n] = w[n] || [];
        w[n].push(
                ri
                );
        var a = document.createElement('script');
        a.type = 'text/javascript';
        a.async = true;
        a.src = 'http://adcode.rontar.com/rontar2_async.js?rnd=' + Math.round(Math.random() * 100000);
        var b = document.getElementById('rontar_adplace_' + ri.rontar_adplace_id);
        b.parentNode.insertBefore(a, b);
    })(window, document, 'rontar_ads');
//--></script>

<?php
if ($this->beginCache("TrueMainNews", array('dependency' => array(
                'class' => 'system.caching.dependencies.CExpressionDependency',
                'expression' => "Article::getCacheDependency('TrueMainNews')")))) {
    ?>
    <?php $this->widget('application.components.widgets.TrueMainNews'); ?>
    <?php
    $this->endCache();
}
?>

<div id="rontar_adplace_5719"></div>
<script type="text/javascript"><!--

    (function(w, d, n) {
        var ri = {rontar_site_id: 1717, rontar_adplace_id: 5719, rontar_place_id: 'rontar_adplace_5719', adCode_rootUrl: 'http://adcode.rontar.com/'};
        w[n] = w[n] || [];
        w[n].push(
                ri
                );
        var a = document.createElement('script');
        a.type = 'text/javascript';
        a.async = true;
        a.src = 'http://adcode.rontar.com/rontar2_async.js?rnd=' + Math.round(Math.random() * 100000);
        var b = document.getElementById('rontar_adplace_' + ri.rontar_adplace_id);
        b.parentNode.insertBefore(a, b);
    })(window, document, 'rontar_ads');
//--></script>
<br /><br />

<?php
//if ($this->beginCache("OpinionsMain", array('dependency' => array(
//                'class' => 'system.caching.dependencies.CExpressionDependency',
//                'expression' => "Article::getCacheDependency('OpinionsMain')")))) {
    $this->widget('application.components.widgets.Blogs');
//    $this->endCache();
//}
?>

<?php
//if ($this->beginCache("OnlineProjects", array('dependency' => array(
//                'class' => 'system.caching.dependencies.CExpressionDependency',
//                'expression' => "Article::getCacheDependency('OnlineProjects')")))) {
    $this->widget('application.components.widgets.OnlineProjects');
//    $this->endCache();
//}
?>

<?php
//if ($this->beginCache("OldSurgut", array('dependency' => array(
//                'class' => 'system.caching.dependencies.CExpressionDependency',
//                'expression' => "Article::getCacheDependency('OldSurgut')")))) {
    $this->widget('application.components.widgets.OldSurgut');
//    $this->endCache();
//}
?>
<?php
//if ($this->beginCache("Photos", array('dependency' => array(
//                'class' => 'system.caching.dependencies.CExpressionDependency',
//                'expression' => "Article::getCacheDependency('Photos')")))) {
    $this->widget('application.components.widgets.Photos');
//    $this->endCache();
//}
?>
<?php
//if ($this->beginCache("SpecProjects", array('dependency' => array(
//                'class' => 'system.caching.dependencies.CExpressionDependency',
//                'expression' => "Article::getCacheDependency('SpecProjects')")))) {
    $this->widget('application.components.widgets.SpecProjects');
//    $this->endCache();
//}
?>

<?php // $this->widget('application.components.widgets.OldSurgut'); ?>
<?php // $this->widget('application.components.widgets.Photos'); ?>
<?php // $this->widget('application.components.widgets.SpecProjects');  ?>

<?php
Yii::app()->getClientScript()->registerScript('ajaxnewsbutton', "
    $('.newsajaxbutton').click(function(){
        $('#category').attr('value',$(this).attr('rel'));
        $('.newsajaxbutton').parent().removeClass('active');
        $(this).parent().addClass('active');
    });
");
?>


<?php // $this->widget('application.components.main.official');   ?>
<?php // $this->widget('application.components.main.quest');   ?>
<?php // include($_SERVER['DOCUMENT_ROOT'] . '/_lm8ea8f138e7abf12fd3b69de62a906877/linkmoney.php');    ?>
<?php // $this->widget('application.components.main.popular');     ?>




<!--<div>
    <a class="gray-light-button" href="/">Больше опросов</a>
</div>-->





