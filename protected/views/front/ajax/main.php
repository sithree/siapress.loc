<div class="widget b-light-gray main-news">
    <div class="header">
        <h2><a href="/news">Новости</a></h2>
    </div>
    <ul>
        <?php foreach ($politics as $politic): ?>
            <li>
                <header class="clearfix">
                    <?php if (is_file(Article::model()->getImgpath($politic['id'], $politic['created'], true, false, '_cat'))): ?>
                        <a href="<?php echo Article::model()->getArticlestriplink($politic); ?>">
                            <img src="<?php echo Article::model()->getImgpath($politic['id'], $politic['created'], true, false, '_cat'); ?>" alt="<?php echo CHtml::decode(trim($politic['title'])) ?>" />
                        </a>
                    <?php endif; ?>
                    <h3>
                        <a href="<?php echo Article::model()->getArticlestriplink($politic); ?>"><?php echo CHtml::decode(trim($politic['title'])) ?></a>
                    </h3>
                </header>
                <footer class="row clearfix">
                    <div class="col-xs-8"><a href="news/<?php echo $politic['alias'] ?>"><?php echo $politic['fullname'] ?></a>, <?php echo Helper::getFormattedtime($politic['publish'], false, true) ?></div>
                    <div class="col-xs-4 a-right"><i class="fa fa-eye"></i> <?php echo $politic['hits'] ?> <i class="fa fa-comment"></i> <?php echo $politic['comment_count'] ?></div>
                </footer>
            </li>

        <?php endforeach; ?>
    </ul>
</div>
