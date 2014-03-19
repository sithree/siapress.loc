<div class="widget gray-border-light main-news popular">
    <div class="header">
        <h2><a href="/news/official">Пресс-релизы</a></h2>
    </div>
    
    <ul>
        <?php
        foreach ($items as $item):
            $cadd = ComArticle::model()->find('article_id = ' . $item['id'])->company_id;
            $company = Company::model()->find('id = ' . $cadd);
            ?>
            <li>
                <header class="clearfix">
                    <h3 class="official-title">
                        <?php echo $company['name'] ?>
                    </h3>
                    <h4>
                        <a href="<?php echo Yii::app()->createUrl('news/official/' . $item['id']); ?>">
                            <?php echo $item['title'] ?>
                        </a>    
                    </h4>
                </header>
            </li>
        <?php endforeach; ?>
    </ul>
    
    <div class="footer">
        <a href="<?php echo Yii::app()->createUrl('news/official') ?>">все пресс-релизы →</a>
    </div>
</div>