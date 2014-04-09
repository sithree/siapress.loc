<?php

class AjaxController extends CController {
    public function actionVote() {
        $model = $this->loadModel($id);
        $vote = new PollVote;

        if (!$model->userCanVote())
            $this->redirect(array('view', 'id' => $model->id));

        if (isset($_POST['PollVote'])) {
            $vote->attributes = $_POST['PollVote'];
            if ($vote->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        // Convert choices to form options list
        $choices = array();
        foreach ($model->choices as $choice) {
            $choices[$choice->id] = CHtml::encode($choice->label);
        }

        $this->render('vote', array(
            'model' => $model,
            'vote' => $vote,
            'choices' => $choices,
        ));
    }
}