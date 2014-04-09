<?php

Yii::import('zii.widgets.CPortlet');

class EPoll extends CPortlet {

    public $poll_id = 0;

    /**
     * Initializes the portlet.
     */
    public function init() {
        parent::init();
    }

    /**
     * Renders the portlet content.
     */
    public function renderContent() {
        $model = null;
        if ($this->poll_id == 0) {
            $model = Poll::model()->open()->latest()->findAll();
        } else {
            $criteria = new CDbCriteria();
            $criteria->condition = 'id='.$this->poll_id.' and status='.poll::STATUS_OPEN;
            $model = Poll::model()->find($criteria);
            $model = array($model);
        }
        if (!$model) {
            return;
        }

        foreach ($model as $poll) {
            if (Yii::app()->getModule('poll')->forceVote && $poll->userCanVote()) {
                $choices = array();
                foreach ($poll->choices as $choice) {
                    $choices[$choice->id] = CHtml::encode($choice->label);
                }
                $this->render('vote', array('model' => $poll, 'choices' => $choices, 'vote' => new PollVote()));
            } else {
                $this->render('results', array('model' => $poll));
            }
        }
    }

    /**
     * Returns the PollChoice model based on primary key or a new PollChoice instance.
     * @param integer the ID of the PollChoice to be loaded
     */
    public function loadChoice($choice_id) {
        if ($choice_id) {
            foreach ($this->_poll->choices as $choice) {
                if ($choice->id == $choice_id)
                    return $choice;
            }
        }

        return new PollChoice;
    }

    /**
     * Returns the PollVote model based on primary key or a new PollVote instance.
     */
    public function loadVote($model) {
        foreach ($model->votes as $vote) {
            if ($vote->user_id == $userId and $userId != 0) {
                if (Yii::app()->getModule('poll')->ipRestrict && $isGuest && $vote->ip_address != $_SERVER['REMOTE_ADDR'])
                    continue;
                else
                    return $vote;
            }
        }

        return new PollVote;
    }

}
