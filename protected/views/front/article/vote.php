<?php
$like = $model->like ? $model->like : 0;
$dislike = $model->dislike ? $model->dislike : 0;
$withoutlike = $like + $dislike == 0;
$onepercent = 100 / ($withoutlike ? 1 : $like + $dislike);
?>
<div class="a-right">
    <span class="thumb-up"><i class="fa fa-thumbs-up"></i> нравится (<?php echo (string) $like; ?>)</span> 
    <span class="thumb-down"><i class="fa fa-thumbs-down"></i> не нравится (<?php echo (string) $dislike; ?>)</span>
</div>
<div class="row diagram">
    <div class="col-xs-12">
        <div style="width: <?php echo $withoutlike ? 2 : $like * $onepercent ?>%" class="bar progress-success"></div>
        <div style="width: <?php echo $withoutlike ? 0 : $dislike * $onepercent ?>%" class="bar progress-danger"></div>
    </div>
</div>