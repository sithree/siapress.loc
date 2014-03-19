<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<h6 class="block-header">Пресс-релизы</h6>

<div class="well block-comment block-style">
    <div class="row-fluid">
        <?php
        $i = -1;

        foreach ($items as $item):
            ?>

            <?php
            $i++;
            $cadd = ComArticle::model()->find('article_id = ' . $item['id'])->company_id;
            $company = Company::model()->find('id = ' . $cadd);

            if ($i % 2 == 0 and $i != 0):
                ?>
            </div>
            <div class="row-fluid">
    <?php endif; ?>
            <div class="span6">
                <div class="official-header"><?php echo is_file("images/official/". $cadd ."_ico.jpg") ? '<img src="images/official/'. $cadd .'_ico.jpg" alt="Пресс-релизы" style="display:block; margin-right: 5px; float:left; width: 16px; height: 16px;" />' : ''; ?> <?php echo $company['name'] ?>:</div>
                <div class="row-fluid">
                    <div class="span12">
                        <a style="display: block;" href="<?php echo Yii::app()->createUrl('news/official/' . $item['id']); ?>">
                            <h4 class="official-title"><?php echo $item['title'] ?></h4>
                        </a>
                        <p><?php echo (empty($item['introtext'])) ? Helper::trimText($item['fulltext']) : $item['introtext']; ?></p>
                    </div>
                </div>
            </div>
            <?php
        endforeach;
        ?>
    </div>

    <div class="row-fluid" style="text-align: right">
        <div class="span12">
            <br />
            Читать <a href="<?php echo Yii::app()->createUrl('news/official') ?>">все пресс-релизы →</a>
        </div>
    </div>
</div>