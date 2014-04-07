<?php include 'head.php' ?>


<div style="width: 730px; height: 90px; margin-bottom: 10px;"> 
    <div id="rontar_adplace_5761"></div>
    <script type="text/javascript"><!--

        (function(w, d, n) {
            var ri = {rontar_site_id: 1717, rontar_adplace_id: 5761, rontar_place_id: 'rontar_adplace_5761', adCode_rootUrl: 'http://adcode.rontar.com/'};
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
    //--></script>

</div>
<div class="row" style="width: 740px; float:left;">
    <div class="col-xs-3" id="left" style="width: 253px;">
        <?php include Yii::getPathOfAlias('application.views.front.layouts') . DIRECTORY_SEPARATOR . 'column1.php' ?>
    </div>
    <div  class="col-xs-6" id="center"  style="width: 487px;">
        <?php echo $content; ?>
    </div>
</div>

<div  class="col-xs-3" id="right" style=" float: right;
      margin-left: 5px;
      margin-right: -5px;
      width: 270px; margin-top:-100px;">
    <?php include Yii::getPathOfAlias('application.views.front.layouts') . DIRECTORY_SEPARATOR . 'column4.php' ?>
</div>



<?php include 'footer.php'; ?>
