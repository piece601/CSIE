</div>
<!-- 底部 -->
<footer class="col-xs-12 col-sm-12 col-md-12">
  <hr>
  <blockquote class="text-danger pull-right">2014 &copy; Piece.</blockquote>
</footer>
<!-- END底部 -->
</div>
<!--[if lt IE 9]>
  <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
  <script src="http://cdn.bootcss.com/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
<script type="text/javascript" src="<?=base_url('asset/js/jquery.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url('asset/js/bootstrap.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url('asset/js/wow.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url('asset/js/jquery-ui.min.js')?>"></script>
<script type="text/javascript">
(function(){
  // Set WOW
  new WOW().init();

  // Menu settings
  $('#menuToggle, .menu-close, .close-menu').on('click', function(){
    $('#menuToggle').toggleClass('active');
    $('body').toggleClass('body-push-toleft');
    $('#theMenu').toggleClass('menu-open');
  });
})();
</script>
</body>
</html>