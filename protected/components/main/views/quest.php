<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php if ($item): ?>
    <h6 class="block-header">Задай вопрос</h6>
    <div class="well block-comment block-style">
        <a title="Задать вопрос" href="<?php echo Article::model()->getArticlestriplink($item); ?>" style=" color: #333; border-bottom:none; font-size:12px;">
            <img style="width: 260px;" src="<?php echo $item->getImgpath($item->id, $item->created, true, false, '_item');
    ?>" alt="<?php echo $item->title ?>">
            <h2 class="news-h2" style="font-size:12px; line-height: 135%; margin-top: 10px; margin-bottom:5px;">
                <span style="font-size: 13px;
                      border-bottom: none;
                      font-weight: bold;" href="/news/economics/20145">
                    <?php echo $item->title ?>              </span>
            </h2>
            <p><?php echo $item->introtext ?></p>
        </a>
        <div class="blogs-block">
                <span style="color:gray;">Просмотров: <?php echo $item->articleAdd->hits ?>, вопросов: <?php echo count($item->comments); ?></span>

            </div>
    </div>
<?php endif; ?>

