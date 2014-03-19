<?php
$html = $model['fulltext'];
if (class_exists(nokogiri)):

    $saw = new nokogiri('<?xml encoding = "UTF-8">' . $html);
    if ($saw->get('h3')->toArray()):
        ?>
        <div id="articleNav">
            <h6>Читать:</h6>
            <ul>
                <?php
                $i = 0;

                foreach ($saw->get('h3')->toArray() as $h3) {
                    $title = $h3['#text'][0] ? $h3['#text'][0] : $h3['strong'][0]['#text'][0];
                    if(strlen($title) < 2)
                    continue;
                    echo "<li><a href='" . Yii::app()->request->requestUri . "#link$i'> $title</a></li>";
                    
                    $model['fulltext'] = str_replace($title, "<a name='link$i'></a>$title", $model['fulltext']);
                    $i++;
                }
                ?>
            </ul>
        </div>
        <div id="emptyNav"></div>
        <?php #die();  ?>
        <?php Yii::app()->clientScript->registerCss('fixedNav', "
                .navFixed {
                    position: fixed;
                    margin-left: 600px;
                    width: 270px;
                    top: 20px;
                }
                #articleNav {
                    borde-top:1px solid #f4f4f4;
                    padding: 5px 0 5px 0;
                    margin-bottom: 15px;
                }
                #articleNav ul, #articleNav li {
                    margin: 0;
                    padding: 0;
                    list-style: none;
                }
                #articleNav li a {
                    display: block;
                    width: auto;
                    height: 100%;
                    padding: 5px 10px 5px 15px;
                    color:#333;
                }
                #articleNav li {
                    border-bottom: 1px solid #f4f4f4;
                }
                #articleNav li a:hover {
                    background: #f5f5f5;
                }
                #articleNav.navFixed li a:hover {
                    background: #f5f5f5;
                }
                #articleNav.navFixed li a {
                    
                    background: #f9f9f9;
                }

            "); ?>
        <script>
            //$(function(){
            var emptyHeight = $('#articleNav').height();
            //});
            $(function() {
                $(document).scroll(function() {

                    var blogs = $('#blogs').height();
                    var top = $(this).scrollTop();
                    var nav = $('#articleNav');
                    var empty = $('#emptyNav');
                    if (top > (blogs + 300)) {
                        empty.css('height', (emptyHeight + 25) + 'px');
                        nav.addClass('navFixed');

                    } else {
                        nav.removeClass('navFixed');
                        empty.css('height', 'auto');
                    }


                });
            });
        </script>
    <?php endif; ?>
<?php endif; ?>