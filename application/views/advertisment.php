<? @require_once('templates/_header.php');?>
<script>
  window.onload=function(){
    $( 'tbody' ).sortable();
    $( 'tbody' ).disableSelection();
  };
</script>
<article class="row wow fadeInUp">
  <h1 class="text-warning" ><i class="fa fa-bookmark-o fa-2x" id="icon-shadow"></i> 廣告管理系統</h1>
  <button class="btn btn-info pull-right" data-toggle="modal" data-target="#add_ad_btn"><span class="glyphicon glyphicon-plus"></span> 新增廣告</button>    
  <div class="clearfix"><br><br><br></div> 
  <!-- <img src="<?= base_url('asset/img/ad_readme.jpg')?>" style="width:300px;"> -->
  <table class="table table-hover">
    
    <tr class="success">
      <td>Logo</td>
      <td>名稱</td>
      <td>刪除</td>
    </tr>
    <tbody>
    <? foreach ($query as $key => $value) { ?>
      <tr class="sortable">
        <td><a href="<?= base_url('advertisment/edit_advertisment/'.$value->adId)?>"><img src="<?= base_url($value->logoPath)?>" class="img-responsive" style="width: 150px;"></a></td>
        <td><h3><?= $value->logoTitle?></h3></td> 
        <td><button class="btn btn-danger" onclick="if (confirm('確認刪除？')){location.href='<?=base_url('advertisment/delete_advertisment/'.$value->adId)?>'}"><span class="glyphicon glyphicon-remove"></span></button></td>
      </tr>
    <? } ?>
    </tbody>
  </table>
</article>

<!-- 新增廣告下滑選單模組 -->
<div class="modal fade" id="add_ad_btn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- 模組表頭 -->
      <div class="modal-header"> 
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h1 class="modal-title text-info" id="myModalLabel"><span class="glyphicon glyphicon-plus-sign"></span> 新增廣告</h1>
      </div>
      <!-- 模組內文 -->
      <div class="modal-body">

    <form class="form-horizontal" role="form" method="post" action="<?= base_url('advertisment/add_advertisment')?>" enctype="multipart/form-data">
      <div class="form-group">
        <label class="col-sm-2 control-label">Logo名稱</label>
        <div class="col-sm-9">
          <input type="text" name="logoTitle" class="form-control" placeholder="谷歌">
        </div>  
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">Logo網址</label>
        <div class="col-sm-9">
          <input type="text" name="logoUrl" class="form-control" placeholder="http://google.com.tw">
        </div>  
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">logo圖片</label>
        <div class="col-sm-9">
            <input type="file" name="userfile" class="form-control" />
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-primary btn-lg">送出</button>
        </div>
      </div>
    </form>

      </div>
      <!-- 模組底部 -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END模組 -->

<? @require_once('templates/_footer.php');?>


