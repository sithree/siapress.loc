<?php

/* @var $model Poll */
/* @var $head string */
$this->renderPartial($head, array('model' => $model));
if ($model->userCanVote())
{
    $choices = array();
    foreach ($model->choices as $choice)
    {
        $choices[$choice->id] = CHtml::encode($choice->label);
    }
    echo $this->renderPartial('vote', array('model' => $model, 'choices' => $choices, 'vote' => new PollVote()));
} else
{
    echo $this->renderPartial('results', array('model' => $model));
}
?>

<?php

if ($comment)
{
    $this->widget('application.components.widgets.Comments', array('object_type_id' => 2, 'object_id' => $model->id, 'comment_on' => true));
}