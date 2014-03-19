<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">

    <?php
    foreach ($list as $row): ?>
        <url>
            <loc><?php echo CHtml::encode($row['loc']); ?></loc>
            <news:news>
                <news:publication>
                    <news:name>Информационное агентство СИА-ПРЕСС</news:name>
                    <news:language>ru</news:language>
                </news:publication>
                <?php
                    if($row['cat_id'] == 14 )
                        echo "<news:genres>PressRelease</news:genres>\r\n";
                    elseif($row['cat_id'] == 9)
                        echo "<news:genres>Blog</news:genres>\r\n";
                    elseif($row['cat_id'] == 8)
                        echo "<news:genres>Opinion</news:genres>\r\n";
                ?>
                <news:publication_date><?php echo Helper::getFormattedtime($row['publish'], 'Y-m-d\TH:m:d+06:00')  ?></news:publication_date>
                <news:title><?php echo CHtml::encode($row['title']) ?></news:title>
                <news:keywords><?php echo CHtml::encode($row['metakey']) ?></news:keywords>
            </news:news>
        </url>
    <?php endforeach; ?>

</urlset>
