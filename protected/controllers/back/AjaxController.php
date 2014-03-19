<?php

class AjaxController extends CController {

    public function filters() {
        return array(
            'ajaxOnly + index',
        );
    }

    // actionIndex вызывается всегда, когда action не указан явно.
    function actionCacheClean() {
        if (Yii::app()->request->isAjaxRequest) {
            file_get_contents('http://www.siapress.ru/cache.php');
            Yii::app()->cache->flush();
            return true;
            Yii::app()->end();
        }
        return;
    }

    function actionNewspaper() {

        ini_set('max_execution_time', 3600);

        Yii::app()->clientScript->reset();
        $this->layout = 'application.views.front.layouts.clear';

        $users = Subscribe::model()->findAll(array('condition' => 'active = 1', 'order' => 'id DESC'));
        $news = Newspaper::model()->find(array('order' => 'id DESC'));
        $archive = Newspaper::model()->findAll(array('condition'=> 'id != ' .$news->id.' AND `date` > "' . date("Y") . '-01-01 00:00:00"', 'order' => 'id DESC', 'limit' => 5));
        $i=0;$b=0;
        #die(Yii::getPathOfAlias('webroot.log'). '/subscribe_' . date('Y_m_d') .'.txt');
        $log = fopen(Yii::getPathOfAlias('webroot.log'). DIRECTORY_SEPARATOR . 'subscribe_' . date('Y_m_d') .'.txt', 'a');

        if ($users and $news) {
            foreach ($users as $user) {
                $b++;
                $name = '=?UTF-8?B?' . base64_encode("Новый Город. Электронная версия.") . '?=';
                $subject = '=?UTF-8?B?' . base64_encode("Выпуск № {$news->num}") . '?=';
                $headers = "From: $name <no-reply@siapress.ru>\r\n" .
                        "Reply-To: no-reply@siapress.ru\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-type: text/html; charset=UTF-8";

                $body = $this->render('application.views.front.newspaper._mail', array('newspaper' => $news, 'user' => $user, 'archive' => $archive), true);
                if(mail(trim($user->email), $subject, $body, $headers)){
                    $i++;
                    echo "Отправляем ". $user->id . ': ' . $user->email . '<br />';
                    fwrite($log,  "Отправляем ". $user->id . ': ' . $user->email . " - ".date("Y-m-d H:i:s") ."\r\n");
                } else {
                    "Ошибка! ". $user->id . ': ' . $user->email . '<br />';
                }
                sleep(2);

                if($b%15 == 0)
                    sleep(5);
            }
            fclose($log);
            echo '<br />--- Отправлено ' . $i .' писем.';
        } else
            echo "Ошибка!";

    }

    function actionGenerateHash(){
        $users = Subscribe::model()->findAll();

        foreach($users as $user){
            $user->hash = md5( $user->email  .'+siapress');
            $user->save();
        }
    }
    
    function actionVideoPositionForm($index){
         if (Yii::app()->request->isAjaxRequest) {
             $video = new ArticleVideo;
             $this->renderPartial('application.views.back.article._videoPositions', array('model' => $video, 'index' => $index));
         }
    }

}

?>
