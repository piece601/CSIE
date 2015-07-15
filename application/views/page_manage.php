<? @require_once('templates/_header.php');?>
<article class="row wow fadeInUp">
  	<h1 class="text-warning"><i class="fa fa-file-text fa-2x" id="icon-shadow"></i> 頁面管理</h1>
	<button class="btn btn-info pull-right" data-toggle="modal" data-target="#add_page_btn"><span class="glyphicon glyphicon-plus"></span> 新增頁面分類</button>    
  	<!-- 分隔用 -->
	<div class="clearfix"></div> 
	<hr>
	<? foreach ($query as $key => $value) { ?>
	<section class="col-xs-12 col-sm-4 col-md-4">
    <ul class="list-inline text-center">
      <li><button class="btn btn-success btn-lg wow bounceIn" onclick="location.href='<?= base_url('page/category/'.$value->pageClass)?>'"><?= $value->pageClassName?></button></li>
      <li><button class="btn btn-xs btn-danger" style="margin: 0px 0px 70px -20px;" onclick="if(confirm('確定要刪除這個頁面分類嗎？')){location.href='<?= base_url('page/delete_category/'.$value->pageClass)?>'}"><span class="glyphicon glyphicon-remove"></span></button></li>
    </ul>
    <hr>
	</section>
	<? } ?>
</article>

<!-- 下滑選單模組 -->
<div class="modal fade" id="add_page_btn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- 模組表頭 -->
      <div class="modal-header"> 
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h1 class="modal-title text-info" id="myModalLabel">新增頁面分類</h1>
      </div>
      <!-- 模組內文 -->
      <div class="modal-body">
        <form role="form" method="post" action="<?= base_url('page/add_category')?>">
          <div class="form-group">
            <label for="pageClassName">分類名稱</label>
            <input type="text" class="form-control" id="pageClassName" name="pageClassName" placeholder="">
          </div>
          <button type="submit" class="btn btn-danger btn-lg">送出新增</button>
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


