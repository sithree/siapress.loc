<div id="top-blogs">
    <div class="row">
        <?php
        foreach ($items as $item):
            ?>
            <div class="col-xs-4">
                <a href="blogs/<?php echo $item['id'] ?>">
                    <img src="<?php echo User::model()->getAuthoravatar($item['author'], true); ?>" alt="<?php echo $item['name'] ?>">
                    <div class="author"><?php echo $item['name']; ?></div>
                    <h2><?php echo $item['title'] ?></h2>
                    <div class="stat"><i class="fa fa-eye"></i> <?php echo $item['hits'] ?> <i class="fa fa-comment"></i> <?php echo $item['comment_count'] ?></div>                                        
                </a>
            </div>
            <?php
        endforeach;
        ?>
    </div>
</div>