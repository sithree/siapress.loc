<?php

class NewspaperController extends Controller {

    public function actionDownload() {
        Yii::app()->clientScript->reset();
        $this->layout = 'clear';

        $hash = Yii::app()->request->getQuery('hash');
        $num = Yii::app()->request->getQuery('num');
        $all = Yii::app()->request->getQuery('all');
//        $year = Yii::app()->request->getQuery('year');
        $download = Yii::app()->request->getQuery('download');

        if (!$hash) {
            $this->render('error');
            return;
        }

        $user = Subscribe::model()->find("hash = '{$hash}'");
        if (!$user) {
            $this->render('error');
            return;
        } else {
            if ($num) {
//                if ($year != date("Y")) {
//                    $paper = new Newspaper;
//                    $paper->setTableName("{{newspaper_$year}}");
//                    die($paper->getTableAlias());
//                    $newspaper = $paper->model()->find("num = '$num'");
//                }
//                else
                    $newspaper = Newspaper::model()->find("num = '$num'");
            } else {
                $newspaper = Newspaper::model()->find(array('order' => 'id DESC'));
            }
        }
        if (!$newspaper) {
            $this->render('error');
            return;
        }

        if ($all)
            $limit = 500;
        else {
            Yii::app()->clientScript->registerMetaTag("1; url=http://www.siapress.ru/newspaper/download?num=" . $newspaper->num . '&hash=' . $user->hash . '&download=1', NULL, 'refresh');
            $limit = 5;
        }


        $archive = Newspaper::model()->findAll(array('condition' => 'id != ' . $newspaper->id . ' AND `date` >= "' . date("Y") . '-01-01"', 'order' => 'id DESC', 'limit' => $limit));

        if ($download) {
            $newspaper->download++;
            $newspaper->save();

            header('Content-type: application/pdf');
            header('Content-Disposition: attachment; filename="Новый Город [выпуск ' . $newspaper->num . '].pdf"');
            readfile('http://www.siapress.ru/media/ng/' . date("Y") . '/' . $newspaper->num . '.pdf');
            Yii::app()->end();
        }



        $this->render('download', array('user' => $user, 'newspaper' => $newspaper, 'archive' => $archive));
    }

    // Uncomment the following methods and override them if needed
    /*
      public function filters()
      {
      // return the filter configuration for this controller, e.g.:
      return array(
      'inlineFilterName',
      array(
      'class'=>'path.to.FilterClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }

      public function actions()
      {
      // return external action classes, e.g.:
      return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
      'class'=>'path.to.AnotherActionClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }
     */
}