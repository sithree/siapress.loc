<?php

class ClickController extends Controller {

    public function actionIndex( $id) {
       # if (!$type)
           # $type = 'ad';
      #  switch ($type) {
      #      case 'ad':
                $br = Banner::model()->findByPk($id);
                if ($br and strlen($br->link) > 5) {
                    $br->click++;
                    $br->save();

                    $this->redirect($br->link);
                }

//                break;
//
//            default:
//                return false;
//                break;
//        }
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