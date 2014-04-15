<?php

if ($comments):
    foreach ($comments as $comment):
        if ($comment->author->perm_id == 6)
            $this->renderPartial('application.views.front.comments._comments_official', array('comment' => $comment, 'new' => $new, 'url' => $url));
        else
            $this->renderPartial('application.views.front.comments._comments', array('comment' => $comment, 'new' => $new, 'url' => $url));
    endforeach;
endif;
?>
