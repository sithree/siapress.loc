<?php
$this->setPageTitle('Фоторепортажи — ' . Yii::app()->name);
?>

<?php
Yii::app()->getClientScript()->registerScript('exclusive', "

  $('.exclusive').hover(function(){
            var h = $('.ex_desc', this).height();
            var h2 = 123;
            $('.ex_cont', this).animate({
                marginTop: h2 - h
            }, 200);
        }, function(){
            var h = $('.ex_desc', this).height();
            var h2 = 123;
            $('.ex_cont', this).animate({
                marginTop: h2
            }, 200);
        });
 ");
?>

<h2>Фоторепортажи <a title="RSS лента раздела Политика" href="#"><span class="label label-warning">RSS</span></a></h2>
<hr />
<?php
if (!count($items))
    throw new CHttpException('', 'Отсутствуют записи', 404);
?>
<?php echo $this->renderPartial('_form', array('items' => $items)); ?>

<hr />
<?php
echo Chtml::form();
echo CHtml::hiddenField('page', '2', array('autocomplete' => 'off'));
?>
<div id="asd"></div>
<div class="row-fluid">
    <div style="text-align: center" id="morebutton">
        <noindex>
            <?php
            echo Chtml::ajaxLink('Загрузить еще...', array('ajax/getphotos'), array(
                'type' => 'POST',
                #'update' => '#ph',
                'beforeSend' => 'function(){
                        var page =  parseInt($("#page").attr("value"));
                        now = page + 1;
                        $("#page").attr("value", now);
                        $("#morebutton").addClass("loading");
                    }',
                'complete' => 'function(){
                       $("#morebutton").removeClass("loading");

                    }',
                'success' => "function(html){
        $('#ph').append(html);
        $('.exclusive').hover(function(){
            var h = $('.ex_desc', this).height();
            var h2 = 123;
            $('.ex_cont', this).animate({
                marginTop: h2 - h
            }, 200);
        }, function(){
            var h = $('.ex_desc', this).height();
            var h2 = 123;
            $('.ex_cont', this).animate({
                marginTop: h2
            }, 200);
        });

}"
                    ), array('class' => 'newsajaxbutton', 'rel' => 'politics', 'style' => 'color:gray; padding:10px; display: block; background-color: #eee; font-weight: bold; text-transform: uppercase;'));
            ?>
        </noindex>
    </div>
</div>

<?php
echo Chtml::form();
#new MPagination(Article::model()->getCountitems($category['id']), $category['alias']);
?>
