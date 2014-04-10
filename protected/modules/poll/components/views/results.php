<div class="portlet-decoration">
    <div class="portlet-title"><?php echo $model->title; ?></div>
</div>
<a name="poll_<?php echo $model->id ?>"></a>
<div class="form well padding" style="border-bottom: 1px solid #ca0000;border: 1px solid #ca0000; margin-bottom: 15px;">
    <?php
    foreach ($model->choices as $choice) {
    $this->render('poll.views.pollchoice._resultsChoice', array(
    'choice' => $choice,
    'percent' => $model->totalVotes > 0 ? 100 * round($choice->votes / $model->totalVotes, 3) : 0,
    'voteCount' => $choice->votes,
    ));
    }
    ?>
    <p class="created" style="text-align: right">Всего голосов: <strong><?php echo $model->totalVotes; ?></strong></p>
    <?php //if ($userVote->id): ?>
<!--    <p id="pollvote-<?php //echo $userVote->id ?>">
        Вы проголосовали: <em style="font-size:90%; line-height: 110%;"><?php //echo $userChoice->label ?></em>.<br />
    </p>-->
    <?php //endif; ?>
</div>
