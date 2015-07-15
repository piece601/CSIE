<? @require_once('templates/_header.php');?>
<script type="text/javascript">
(function(){ // 匿名自啟函數
  window.onload = function(){ // 整個網頁下載完才執行
    var select_data = function(newsClass){
      if(newsClass == 'all'){
        newsClass = '';
      }
      $.ajax({
        url: 'welcome/select_data_json/'+newsClass,
        type: "GET",
        datatype: "json",
        success: function(data){
          result = jQuery.parseJSON(data);
          if(newsClass == ''){
            newsClass = 'all';
          }
          for (var i = 0; i < 10; i++) {
            $('#'+newsClass+' > table').append('<tr><td class="col-xs-3"><p class="text-info">'
              +result[i]['newsDate']+'</p></td>'+'<td><a href="news/view/'
              +result[i]['newsId']+'" style="text-decoration:none;"><p class="text-danger">'
              +result[i]['newsTitle']+'</p></a></td><td><p>'
              +result[i]['newsClassName']+'</p></td></tr>');
            // console.log(jQuery.parseJSON(data)[i]['newsTitle']);
          };
        },
        error: function(){
          alert("網頁出現問題，請稍後再試");
        }
      });
    }
    select_data('all');
    select_data('school');
    select_data('activity');
    select_data('csie');
    select_data('other'); 
  }
})();
</script>

<!-- 內容 -->
<article class="row">
  <!-- 左方選單 -->
<!--   <aside class="col-xs-12 col-md-3 well">
    <ul class="nav nav-pills nav-stacked">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="#">Profile</a></li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
          Dropdown <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
          <li><a href="#">Action</a></li>
          <li><a href="#">Another action</a></li>
          <li><a href="#">Something else here</a></li>
          <li class="divider"></li>
          <li><a href="#">Separated link</a></li>
        </ul>
      </li>
    </ul>
  </aside>  --> 
  <!-- END左方選單 -->

  <!-- 內容 -->
  <section class="col-xs-12 col-sm-12 col-md-9 wow fadeInUp">
    <ul class="nav nav-tabs" style="margin-bottom: 15px;">
      <li class="active"><a href="#all" data-toggle="tab" id="all_btn">所有公告</a></li>
      <li><a href="#school" data-toggle="tab" id="school_btn">學校公告</a></li>
      <li><a href="#csie" data-toggle="tab" id="csie_btn">系務公告</a></li>
      <li><a href="#activity" data-toggle="tab" id="activity_btn">活動公告</a></li>
      <li><a href="#other" data-toggle="tab" id="other_btn">其他公告</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane fade active in" id="all">
        <table class="table table-hover table-condensed table-striped"></table>
        <ul class="pager pull-right"><li><a href="<?= base_url('news/newslist')?>">查看更多 &rarr;</a></li></ul>
      </div>
      <div class="tab-pane fade" id="school">
        <table class="table table-hover table-condensed table-striped"></table>
        <ul class="pager pull-right"><li><a href="<?= base_url('news/newslist/school')?>">查看更多 &rarr;</a></li></ul>
      </div>
      <div class="tab-pane fade" id="csie">
        <table class="table table-hover table-condensed table-striped"></table>
        <ul class="pager pull-right"><li><a href="<?= base_url('news/newslist/csie')?>">查看更多 &rarr;</a></li></ul>
      </div>
      <div class="tab-pane fade" id="activity">
        <table class="table table-hover table-condensed table-striped"></table>
        <ul class="pager pull-right"><li><a href="<?= base_url('news/newslist/activity')?>">查看更多 &rarr;</a></li></ul>
      </div>
      <div class="tab-pane fade" id="other">
        <table class="table table-hover table-condensed table-striped"></table>
        <ul class="pager pull-right"><li><a href="<?= base_url('news/newslist/other')?>">查看更多 &rarr;</a></li></ul>
      </div>
    </div>
  </section>
  <!-- END內容 -->

  <!-- 右方廣告logo -->
  <aside class="hidden-xs hidden-sm col-md-3 wow fadeInRight">
    <ul class="nav nav-pills nav-stacked">
      <?php $delay = 0;?>
      <?php foreach ($adQuery as $key => $value): ?>
        <li class="wow bounceIn" data-wow-delay="<?= $delay+=0.1?>s" data-wow-offset="-9999"><a href="<?= $value->logoUrl?>">
          <img src="<?=base_url($value->logoPath)?>" class="img-responsive" style="width: 150px;"></a>
        </li>
        <hr>
      <?php endforeach ?>
    </ul>
  </aside> 
  <!-- END右方廣告LOGO -->

</article> 
<!-- END內容 --> 
<? @require_once('templates/_footer.php');?>