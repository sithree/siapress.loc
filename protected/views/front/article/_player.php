<?php
$positions = ArticleVideo::model()->findAll('article = ' . $model['id']);
Yii::app()->clientScript->registerScriptFile('/scripts/device.js');
if ($positions):
    ?>

    <div id="player"></div>
    <script>
        jQuery(function($) {
            if (!device.ios()) {
                $('#playerNav').show(0);
            }

            
            $("iframe").attr('width', 477);

        });



        var tag = document.createElement('script');

        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        var player;

        function onYouTubeIframeAPIReady() {
            player = new YT.Player('player', {
                height: '322',
                width: '477',
                videoId: '<?php echo trim($model['video']) ?>',
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            });
        }
        // 4. The API will call this function when the video player is ready.
        function onPlayerReady(event) {
            //event.target.playVideo();
        }

        // 5. The API calls this function when the player's state changes.
        //    The function indicates that when playing a video (state=1),
        //    the player should play for six seconds and then stop.
        var done = false;
        function onPlayerStateChange(event) {
    //            if (event.data == YT.PlayerState.PLAYING && !done) {
    //                setTimeout(stopVideo, 6000);
    //                done = true;
    //            }
        }
        function stopVideo() {
            player.stopVideo();
        }



    </script>
    <div id="pBlock">

        <ul id="playerNav" style="display:none;">
            <h6>Смотреть:</h6>
            <?php foreach ($positions as $pos): ?>
                <li><a href="#" onclick="player.stopVideo();
                        player.seekTo(<?php echo $pos->start ?>, <?php echo $pos->end ?>);
                        return false;"> <?php echo $pos->title ?></a></li>
                <?php endforeach; ?>
        </ul>
    </div>
    <?php Yii::app()->clientScript->registerCss("player", "
        #playerNav {
            margin: 0;
            padding: 0;
            list-style: none;
            
            margin: 2px 0 15px;
        }
        #playerNav li  {
            padding:0;
            color:#333;
            font-size:13px;
            border-bottom: 1px solid #F4F4F4;
        }
        #pBlock {
            background: #FFF;
        }
        
        #playerNav li a {
            color:#333;
            padding: 6px 10px 6px 15px;
            display: block;
            
        }
        #playerNav li a:hover {
            background: #f5f5f5;
        }
        #playerNav li .pTime {
            color:#ca0000;
            font-size:14px;
        }
        "); ?>

<?php else: ?>

    <iframe width="573" height="322" src="//www.youtube.com/embed/<?php echo trim($model['video']) ?>?rel=0" frameborder="0" allowfullscreen></iframe>

<?php endif; ?>
