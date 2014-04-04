<div class="row-fluid">
    <div class="col-xs-10 diagram row-fluid">
        <?php
        $like = $model->like;
        $dislike = $model->dislike;
        $withoutlike = $like + $dislike == 0;
        $onepercent = 100 / ($withoutlike ? 1 : $like + $dislike);
        ?>
        <div style="width: <?php echo $withoutlike ? 50 : $like * $onepercent ?>%" class="bar progress-success"></div>
        <div style="width: <?php echo $withoutlike ? 50 : $dislike * $onepercent ?>%" class="bar progress-danger"></div>
    </div>
    <div>
        <span class="thumb-up"><i class="fa fa-thumbs-up"></i> <?php echo (string) $like; ?></span> 
        <span class="thumb-down"><i class="fa fa-thumbs-down"></i> <?php echo (string) $dislike; ?></span>
    </div>
</div>