<?php

class RssController extends CController {

    // actionIndex вызывается всегда, когда action не указан явно.
    function actionIndex() {

        Yii::import('ext.feed.*');
        $items = Article::model()->getRss(20, true);
// RSS 2.0 is the default type
        $feed = new EFeed();

        $feed->title = Yii::app()->name;
        $feed->description = 'Сургутское молодежное информационное агентство СИА-Пресс';

        $feed->setImage(Yii::app()->name, 'http://www.siapress.ru/', 'http://www.siapress.ru/logo.gif');

        $feed->addChannelTag('language', 'ru-ru');
        $feed->addChannelTag('pubDate', date(DATE_RSS, time()));
        $feed->addChannelTag('link', 'http://www.siapress.ru/');

// * self reference
        #$feed->addChannelTag('atom:link', 'http://www.siapress.ru/rss');

        foreach ($items as $it) {
            $item = $feed->createNewItem();

            if($it['author_alias']) $it['name'] = $it['author_alias'];

            if ($it['cat_id'] == 9)
                $item->title = $it['name'] . ': ' . $it['title'];
            else
                $item->title = $it['title'];

            $item->link = Yii::app()->createAbsoluteUrl(Article::model()->getCategoryAlias($it['cat_id']) . '/' . $it['id']);


            $item->date = $it['created'];
            $item->description =
                    '<p>' . Article::imageSV2($it['id'], $it['title'], 420,0,false) . '</p>' .
                    $it['introtext'];
// this is just a test!!
            #$item->setEncloser('http://www.tester.com', '1283629', 'audio/mpeg');

            $item->addTag('author',  'mnenie@novygorod.ru ('. $it['name'] .')' );
            $item->addTag('guid', Yii::app()->createAbsoluteUrl(Article::model()->getCategoryAlias($it['cat_id']) . '/' . $it['id']), array('isPermaLink' => 'true'));

            $feed->addItem($item);
        }


        $feed->generateFeed();

        Yii::app()->end();
    }

    function actionYandex() {

        Yii::import('ext.feed.*');
        $items = Article::model()->getRss(50);
// RSS 2.0 is the default type
        $feed = new EFeed('YANDEX');
        #$feed->type = "YANDEX";

        $feed->title = Yii::app()->name;
        $feed->description = 'Сургутское молодежное информационное агентство СИА-Пресс';

        $feed->setImage('СИА-ПРЕССС', 'http://www.siapress.ru/', 'http://www.siapress.ru/logo.gif');

        $feed->addChannelTag('language', 'ru-ru');
        $feed->addChannelTag('pubDate', date(DATE_RSS, time()));
        $feed->addChannelTag('link', 'http://www.siapress.ru/');

// * self reference
        #$feed->addChannelTag('atom:link', 'http://www.siapress.ru/rss');

        foreach ($items as $it) {
            $item = $feed->createNewItem();

            $item->title = $it['title'];
            $item->link = Yii::app()->createAbsoluteUrl(Article::model()->getCategoryAlias($it['cat_id']) . '/' . $it['id']);
            $item->addTag('pdaLink', Yii::app()->createAbsoluteUrl(Article::model()->getCategoryAlias($it['cat_id']) . '/' . $it['id']));
            $item->date = $it['created'];
            $item->addTag('description', $it['introtext']);
            $item->addTag('category', $it['catname']);
            #$item->description = $it['introtext'];
// this is just a test!!
            #$item->setEncloser('http://www.tester.com', '1283629', 'audio/mpeg');

            $item->addTag('yandex:genre', 'article');
            $item->addTag('yandex:full-text', strip_tags($it['fulltext']));

            $item->addTag('author', $it['name']);
            $item->addTag('guid', Yii::app()->createAbsoluteUrl(Article::model()->getCategoryAlias($it['cat_id']) . '/' . $it['id']), array('isPermaLink' => 'true'));

            $feed->addItem($item);
        }


        $feed->generateFeed();

        Yii::app()->end();
    }
    function actionFull() {

        Yii::import('ext.feed.*');
        $items = Article::model()->getRss(50, true);
// RSS 2.0 is the default type
        $feed = new EFeed();

        $feed->title = Yii::app()->name;
        $feed->description = 'Сургутское молодежное информационное агентство СИА-Пресс';

        $feed->setImage('СИА-ПРЕССС', 'http://www.siapress.ru/', 'http://www.siapress.ru/logo.gif');

        $feed->addChannelTag('language', 'ru-ru');
        $feed->addChannelTag('pubDate', date(DATE_RSS, time()));
        $feed->addChannelTag('link', 'http://www.siapress.ru/');

// * self reference
        #$feed->addChannelTag('atom:link', 'http://www.siapress.ru/rss');

        foreach ($items as $it) {
            $item = $feed->createNewItem();

            if($it['author_alias']) $it['name'] = $it['author_alias'];

            if ($it['cat_id'] == 9)
                $item->title = $it['name'] . ': ' . $it['title'];
            else
                $item->title = $it['title'];

            $item->link = Yii::app()->createAbsoluteUrl(Article::model()->getCategoryAlias($it['cat_id']) . '/' . $it['id']);


            $item->date = $it['created'];
            $item->description =
                    '<p>' . Article::imageSV2($it['id'], $it['title'], 420,0,false) .'</p>' .
                    $it['introtext'] . $it['fulltext'];
// this is just a test!!
            #$item->setEncloser('http://www.tester.com', '1283629', 'audio/mpeg');

            $item->addTag('author', $it['name']);
            $item->addTag('category', $it['catname']);
            $item->addTag('guid', Yii::app()->createAbsoluteUrl(Article::model()->getCategoryAlias($it['cat_id']) . '/' . $it['id']), array('isPermaLink' => 'true'));

            $feed->addItem($item);
        }


        $feed->generateFeed();

        Yii::app()->end();
    }

    function actionMail() {

        Yii::import('ext.feed.*');
        $items = Article::model()->getRss(50);
// RSS 2.0 is the default type
        $feed = new EFeed('YANDEX');
        #$feed->type = "YANDEX";

        $feed->title = Yii::app()->name;
        $feed->description = 'Сургутское молодежное информационное агентство СИА-Пресс';

        $feed->setImage('СИА-ПРЕССС', 'http://www.siapress.ru/', 'http://www.siapress.ru/logo.gif');

        $feed->addChannelTag('language', 'ru-ru');
        $feed->addChannelTag('pubDate', date(DATE_RSS, time()));
        $feed->addChannelTag('link', 'http://www.siapress.ru/');

// * self reference
        #$feed->addChannelTag('atom:link', 'http://www.siapress.ru/rss');

        foreach ($items as $it) {
            $item = $feed->createNewItem();

            $item->title = $it['title'];
            $item->link = Yii::app()->createAbsoluteUrl(Article::model()->getCategoryAlias($it['cat_id']) . '/' . $it['id']);
            $item->addTag('pdaLink', Yii::app()->createAbsoluteUrl(Article::model()->getCategoryAlias($it['cat_id']) . '/' . $it['id']));
            $item->date = $it['created'];
            $item->addTag('description', $it['introtext']);
            $item->addTag('category', $it['catname']);
            #$item->description = $it['introtext'];
// this is just a test!!
            #$item->setEncloser('http://www.tester.com', '1283629', 'audio/mpeg');

            $item->addTag('yandex:genre', 'article');
            $item->addTag('yandex:full-text', strip_tags($it['fulltext']));

            $item->addTag('author', $it['name']);
            $item->addTag('guid', Yii::app()->createAbsoluteUrl('news/' . Article::model()->getCategoryAlias($it['cat_id']) . '/' . $it['id']), array('isPermaLink' => 'true'));

            $feed->addItem($item);
        }


        $feed->generateFeed();

        Yii::app()->end();
    }

}

?>
