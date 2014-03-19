<?php foreach ($politics as $politic): ?>
    <div id="mainnewslistinner" class="row-fluid" style="margin-bottom: 5px;">
        <div class="span3">
            <a href="<?php echo Article::model()->getArticlestriplink($politic); ?>" class="thumbnail margin">
                <div style="width:100%; height: 86px; background: url(<?php echo Article::model()->getImgpath($politic['id'], $politic['publish'], true, false, '_cat');
    ?>) no-repeat center center"></div>

            </a>
        </div>
        <div class="span9">
            <h2 class="news-h2">
                <a class="main-news-link" href="<?php echo Article::model()->getArticlestriplink($politic); ?>">
                    <?php echo trim($politic['title']); ?>
                </a>
            </h2>
            <p><?php echo $politic['introtext'] ?></p>

            <span class="created"><?php echo Helper::getFormattedtime($politic['publish'], false, true) ?></span>&nbsp;&nbsp;
                    <a href="news/<?php echo $politic['alias'] ?>"<span class="created"><?php echo $politic['fullname'] ?></span></a>&nbsp;&nbsp;
                    <span class="i-view"><?php echo $politic['hits'] ?></span>
                    <a href="<?php echo Article::model()->getArticlestriplink($politic); ?>#comments"><span class="i-comment"><?php echo $politic['comment_count'] ?></span></a>
        </div>
    </div>
<?php endforeach; ?>