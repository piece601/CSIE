<? @require_once('templates/_header.php');?>
<article class="row wow fadeInUp">
	<?php if ($this->session->userdata('news_token')): ?>
	<button class="btn btn-danger pull-right" onclick="if(confirm('確定刪除這篇公告？')){location.href='<?= base_url('news/delete_news/'.$query->newsClass.'/'.$query->newsId)?>'}"><span class="glyphicon glyphicon-remove"></span> 刪除</button>    
	<div class="pull-right">&nbsp; &nbsp; &nbsp; </div>
	<button class="btn btn-warning pull-right" onclick="location.href='<?= base_url('news/edit_news/'.$query->newsId)?>'"><span class="glyphicon glyphicon-edit"></span> 編輯公告</button>    
	<?php endif ?>

	<section>
		<h1 class="text-warning" style="font-size: 50px;"><?= $query->newsTitle;?></h1>
		<blockquote><?= $query->newsContent?></blockquote>
		<?php if ($this->session->userdata('news_token')): ?>
			<button class="btn btn-success pull-right" data-toggle="modal" data-target="#add_newsFile_btn"><span class="glyphicon glyphicon-plus"></span> 新增檔案</button>
		<?php endif ?>
		<?php if ( ! empty($queryFile)): ?>
			<table class="table table-bordered">
				<tr class="active">
					<td>No.</td>
					<td>檔案名稱</td>
					<td>下載</td>
					<?php if ($this->session->userdata('news_token')): ?>
						<td>刪除</td>		
					<?php endif ?>
				</tr>
				<? $count = 1;?>
				<?php foreach ($queryFile as $key => $value): ?>
				<tr>

					<td><h4><?= $count++;?></h4></td>
					<td><h4><?= $value->newsFileName;?></h4></td>
					<td><button class="btn btn-info" onclick="location.href='<?= base_url($value->newsFilePath)?>'">下載</button></td>
					<? if($this->session->userdata('news_token')) { ?>
					<td><button class="btn btn-danger" onclick="if(confirm('確定刪除檔案？')){location.href='<?= base_url('news/delete_newsFile/'.$value->newsFileId.'/'.$value->newsId)?>'}"><span class="glyphicon glyphicon-remove"></span></button></td>
					<? } ?>
				</tr>
				<?php endforeach ?>
			</table>			
		<?php endif ?>
		<p class="pull-right text-danger"><?= $query->newsDate?> - 作者: <?= $query->newsAuthor?></p>	
	</section>
</article>


<!-- 新增成員下滑選單模組 -->
<div class="modal fade" id="add_newsFile_btn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- 模組表頭 -->
      <div class="modal-header"> 
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h1 class="modal-title text-info" id="myModalLabel"><span class="glyphicon glyphicon-plus-sign"></span> 新增檔案</h1>
      </div>
      <!-- 模組內文 -->
      <div class="modal-body">

      	<form class="form-horizontal" role="form" method="post" action="<?= base_url('news/add_newsFile/'.$query->newsId)?>" enctype="multipart/form-data">
		  <div class="form-group">
		    <label class="col-sm-2 control-label">檔案名稱</label>
		    <div class="col-sm-9">
		        <input type="text" class="form-control" name="newsFileName" />
		    </div>
		  </div>

		  <div class="form-group">
		    <label class="col-sm-2 control-label">檔案位置</label>
		    <div class="col-sm-9">
		        <input type="file" class="form-control" name="userfile" />
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


