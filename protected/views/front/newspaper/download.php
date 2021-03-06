<p style="text-align:center; color: #b1b1b1">Электронная версия газеты "Новый Город"</p>

<div style="border:1px solid #dfdfdf; background:white; width:660px; margin:auto; padding:25px;">

    <div style="float:left; width:50%">
        <img style="max-width:100%;" src="http://www.siapress.ru/images/logo_ng.gif" />
    </div>
    <div style="float:right; width:50%; text-align:right;" >
        <h1 style="font-size:36px; font-weight:normal; margin:0;">Выпуск №<?php echo $newspaper->num ?></h1>
        <h2 style="font-size:17px; font-weight:normal; margin:0 0 15px">от <?php echo date("d.m.Y", strtotime($newspaper->date)) ?>.</h2>
    </div>
    <div style="clear:both"></div>

    <p>Здравствуйте, уважаемый <strong><?php echo ($user->firstname) ? $user->firstname . ' ' . $user->middlename : 'Подписчик' ?></strong>!</p>
    <p>Скачивание начнется автоматический через несколько секунд. Если этого не произошло, нажмите на кнопку ниже.</p>

    <p style="padding: 25px 0;">
        <a style="margin:10px 0px 15px; text-decoration:none; dispay:inline-block; color:white; background:#D61E0E; padding: 15px 25px; font-weight:bold;"
           href="<?php
echo Yii::app()->request->hostInfo . '/' . Yii::app()->request->pathInfo . '?' .
 Yii::app()->request->queryString
?>&download=1">Скачать газету</a>
    </p>

    <?php if ($archive): ?>
        <div style="background:#f8f8f8; padding: 5px 25px 10px 25px; margin: 0 -25px;">
            <h3 style="font-weight:normal; font-size:22px; margin-top: 10px;">Прошлые выпуски</h3>
            <ul>
                <?php
                foreach ($archive as $a) :
                    ?>
                    <li><a href="http://www.siapress.ru/newspaper/download?num=<?php echo $a->num ?>&hash=<?php echo $user->hash ?>&">Выпуск №<?php echo $a->num ?></a> от <?php echo date("d.m.Y", strtotime($a->date)) ?></li>
                <?php endforeach; ?>
            </ul>
            <?php
            $all = Yii::app()->request->getQuery('all');
            if (!$all):
                ?>
                <ul>
                    <li><a href="http://www.siapress.ru/newspaper/download?hash=<?php echo $user->hash ?>&all=1">Смотреть весь архив</a></li>
                </ul>
        <?php endif; ?>
        </div>
<?php endif; ?>
    <p>По всем возникшим вопросам обращайтесь по телефону 8 (3462) 44-23-23 или по адресу: город Сургут, Бульвар Свободы 1,
        СИА-ПРЕСС Центр</p>

</div>
<p style="text-align:center; color: #b1b1b1">ЗАО СМИА «СИА-ПРЕСС» 2013. <br />
    628403, Россия, ХМАО-Югра, город Сургут, Бульвар Свободы 1<br />
    Телефон: +7 (3462) 44-23-23</p>
