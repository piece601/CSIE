<? @require_once('templates/_header.php');?>
<article class="row wow fadeInUp">
	<h1 class="text-info"><i class="fa fa-folder fa-2x" id="icon-shadow"></i> 檔案管理系統</h1>
  <button class="btn btn-info pull-right" data-toggle="modal" data-target="#add_group_btn"><span class="glyphicon glyphicon-plus"></span> 新增檔案分類</button>    
	<div class="clearfix"><br><br><br></div> 

	<? $count = 1;?>
  	<table class="table table-hover table-striped">
  		<tr class="success">
  			<td>No.</td>
  			<td>分類名稱</td>
  			<td>刪除</td>
  		</tr>
		<? foreach ($query as $key => $value) { ?>
		<tr>
			<td><?= $count++;?></td>
			<td><button class="btn btn-warning wow bounceIn" onclick="location.href='<?= base_url('file/download/'.$value->fileClass)?>'"><?= $value->fileClassName;?></button></td>
			<td><button class="btn btn-danger wow slideInRight" onclick="if(confirm('確定要刪除這個分類嗎？如果刪除了會將分類下的檔案一並刪除喲！')){location.href='<?= base_url('file/delete_category/'.$value->fileClass)?>'}"><span class="glyphicon glyphicon-remove"></span></button></td>
		</tr>
	  	<? } ?>
  	</table>
</article>

<!-- 下滑選單模組 -->
<div class="modal fade" id="add_group_btn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- 模組表頭 -->
      <div class="modal-header"> 
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h1 class="modal-title text-info" id="myModalLabel"><span class="glyphicon glyphicon-plus-sign"></span> 新增檔案分類</h1>
      </div>
      <!-- 模組內文 -->
      <div class="modal-body">
        <form role="form" method="post" action="<?= base_url('file/add_category')?>">
          <div class="form-group">
            <label for="fileClassName">分類名稱</label>
            <input type="text" class="form-control" id="fileClassName" name="fileClassName" placeholder="ex.可愛P文件">
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


