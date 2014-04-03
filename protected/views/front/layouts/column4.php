
<!--<div class="input-group" id="search">
    <form action="/search" id="searchForm" method="GET">
        <input type="text" id="SearchForm_text" name="SearchForm[text]" placeholder="Поиск по сайту" class="form-control">
        <span class="input-group-btn">
            <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
        </span>
    </form>
</div>-->

<div>
    <a class="red-button" href="/radios" id="radioLink">Слушать радио онлайн</a>
</div>

<script type="text/javascript">
    jQuery(function($) {
        $('#radioLink').on('click', function() {
            var newWin = window.open("http://siapress.loc/site/radio",
                    "Radio",
                    "width=420,height=230,resizable=no,scrollbars=no,status=no,menubar=no,toolbar=no,location=no,directories=no"
                    );

            newWin.focus();
        });
    });
</script>

<!-- C1 -->
<div id="rontar_adplace_5695"></div>
<!--<script type="text/javascript">

    (function(w, d, n) {
        var ri = {rontar_site_id: 1717, rontar_adplace_id: 5695, rontar_place_id: 'rontar_adplace_5695', adCode_rootUrl: 'http://adcode.rontar.com/'};
        w[n] = w[n] || [];
        w[n].push(
                ri
                );
        var a = document.createElement('script');
        a.type = 'text/javascript';
        a.async = true;
        a.src = 'http://adcode.rontar.com/rontar2_async.js?rnd=' + Math.round(Math.random() * 100000);
        var b = document.getElementById('rontar_adplace_' + ri.rontar_adplace_id);
        b.parentNode.insertBefore(a, b);
    })(window, document, 'rontar_ads');
//</script>-->

<!-- // C1 -->
<br /><br />
<!-- C2 -->
<div id="rontar_adplace_5692"></div>
<!--<script type="text/javascript">

    (function(w, d, n) {
        var ri = {rontar_site_id: 1717, rontar_adplace_id: 5692, rontar_place_id: 'rontar_adplace_5692', adCode_rootUrl: 'http://adcode.rontar.com/'};
        w[n] = w[n] || [];
        w[n].push(
                ri
                );
        var a = document.createElement('script');
        a.type = 'text/javascript';
        a.async = true;
        a.src = 'http://adcode.rontar.com/rontar2_async.js?rnd=' + Math.round(Math.random() * 100000);
        var b = document.getElementById('rontar_adplace_' + ri.rontar_adplace_id);
        b.parentNode.insertBefore(a, b);
    })(window, document, 'rontar_ads');
//</script>-->
<!-- // C2 -->
<br /><br />


<?php $this->widget('application.components.widgets.quest'); ?>

<!-- C3 -->
<div id="rontar_adplace_5693"></div>
<!--<script type="text/javascript">

    (function(w, d, n) {
        var ri = {rontar_site_id: 1717, rontar_adplace_id: 5693, rontar_place_id: 'rontar_adplace_5693', adCode_rootUrl: 'http://adcode.rontar.com/'};
        w[n] = w[n] || [];
        w[n].push(
                ri
                );
        var a = document.createElement('script');
        a.type = 'text/javascript';
        a.async = true;
        a.src = 'http://adcode.rontar.com/rontar2_async.js?rnd=' + Math.round(Math.random() * 100000);
        var b = document.getElementById('rontar_adplace_' + ri.rontar_adplace_id);
        b.parentNode.insertBefore(a, b);
    })(window, document, 'rontar_ads');
//</script>-->

<!-- // C3 -->
<br />

<?php include($_SERVER['DOCUMENT_ROOT'] . '/_lm8ea8f138e7abf12fd3b69de62a906877/linkmoney.php'); ?>

<?php
if ($this->beginCache("popular", array('dependency' => array(
                'class' => 'system.caching.dependencies.CDbCacheDependency',
                'sql' => 'SELECT MAX(id) FROM sia_comments')))) {
    ?>
    <?php $this->widget('application.components.widgets.popular'); ?>
    <?php
    $this->endCache();
}
?>
<!-- LM -->   <?php #include($_SERVER['DOCUMENT_ROOT'] . '/_lm8ea8f138e7abf12fd3b69de62a906877/linkmoney.php');          ?>

<!--<div class="widget gray-border-light main-news">
    <div class="header">
        <h2>Реклама на сайте</h2>
    </div>
    <p class="no-margin">Тел.: <b>(3462) 44-23-23, доб. 205</b><br />
        e-mail: <b>ng@surgutreklama.ru</b></b></p>
</div>-->
<!--
<div class="portlet-content">

    <div style="position:relative;" class="com">
        <noindex>				
            <a href="http://www.thn.ru" target="_blank" rel="nofollow"><img style="max-width: 100%" alt="На правах рекламы" src="http://www.siapress.ru/media/com/280х130.jpg"></a>            </noindex>
    </div>
    <br />
    <div style="position:relative;" class="com">
        <noindex>				
            <a href="http://echo.msk.ru/sounds/stream.html" target="_blank" rel="nofollow"><img style="max-width: 100%" alt="На правах рекламы" src="http://www.siapress.ru/media/com/59.jpg"></a>            </noindex>
    </div>
    <br />
</div>-->


<script type="text/javascript" src="//vk.com/js/api/openapi.js?108"></script>

<!-- VK Widget -->
<div id="vk_groups"></div>
<script type="text/javascript">
    VK.Widgets.Group("vk_groups", {mode: 0, width: "270", height: "250"}, 63451219);
</script>


<?php #include($_SERVER['DOCUMENT_ROOT'] . '/profit_partner/market_vert_3.txt');  ?>


