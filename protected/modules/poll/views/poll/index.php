<h1 class="title entry-title">Все опросы СИА-ПРЕСС</h1>
<hr />
<?php
foreach ($models as $poll) {
    if (Yii::app()->getModule('poll')->forceVote && $poll->userCanVote()) {
        $choices = array();
        foreach ($poll->choices as $choice) {
            $choices[$choice->id] = CHtml::encode($choice->label);
        }
        echo $this->renderPartial('vote', array('model' => $poll, 'choices' => $choices, 'vote' => new PollVote()));
    } else
    {
        echo $this->renderPartial('results', array('model' => $poll));
    }
} ?>
<hr />
<div class="pagination ">
<?php $this->widget('bootstrap.widgets.BootPager', array(
    'pages' => $pages
)); ?>
</div>
