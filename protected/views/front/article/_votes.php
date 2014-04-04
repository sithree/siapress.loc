<div class="block clearfix" id="articleVotes">
    <div class="block-inner">            
        <div id="vote">
            <?php
            $like = $model->articleAdd->like ? $model->articleAdd->like : 0;
            $dislike = $model->articleAdd->dislike ? $model->articleAdd->dislike : 0;
            $withoutlike = $like + $dislike == 0;
            $onepercent = 100 / ($withoutlike ? 1 : $like + $dislike);
            ?>
            <div class="a-right">
                <?php if (!Yii::app()->request->cookies['articlelike_' . $model->id]->value AND !isset(Yii::app()->session['articlelike_' . $model->id])): ?>
                    <a class="newsLikebutton" rel="<?php echo $model->id ?>" title="Нравится" href="#"><i class="fa fa-thumbs-up"></i> нравится (<?php echo (string) $like; ?>)</a>
                    <a class="newsDislikebutton" rel="<?php echo $model->id ?>" title="Не нравится" href="#"><i class="fa fa-thumbs-down"></i> не нравится (<?php echo (string) $dislike; ?>)</a>
                <?php else: ?>
                    <span class="thumb-up"><i class="fa fa-thumbs-up"></i> нравится (<?php echo (string) $like; ?>)</span> 
                    <span class="thumb-down"><i class="fa fa-thumbs-down"></i> не нравится (<?php echo (string) $dislike; ?>)</span>
                <?php endif; ?>
            </div>
            <div class="row diagram">
                <div class="col-xs-12">
                    <div style="width: <?php echo $withoutlike ? 2 : $like * $onepercent ?>%" class="bar progress-success"></div>
                    <div style="width: <?php echo $withoutlike ? 0 : $dislike * $onepercent ?>%" class="bar progress-danger"></div>
                </div>
            </div>
        </div>
    </div>            
</div>
<script>
    jQuery(function($) {

        $('.newsLikebutton').click(function() {
            var t = $(this);
            $.ajax({
                'type': 'POST',
                // 'id':'morenewsbutton',
                'beforeSend': function() {
                },
                'complete': function() {
                },
                'success': function(html) {
                    $('#vote').html(html);
                },
                'url': '/ajax/likearticle',
                'cache': false,
                'data': 'id=' + t.attr('rel') + '&type=like'
            });
            return false;
        });
        $('.newsDislikebutton').click(function() {
            var t = $(this);
            $.ajax({
                'type': 'POST',
                //'id':'morenewsbutton',
                'beforeSend': function() {
                },
                'complete': function() {
                },
                'success': function(html) {
                    $('#vote').html(html);
                },
                'url': '/ajax/likearticle',
                'cache': false,
                'data': 'id=' + t.attr('rel') + '&type=dislike'
            });
            return false;
        });
    });
</script>
