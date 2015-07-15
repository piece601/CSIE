<? @require_once('templates/_header.php');?>

<article class="row wow fadeInUp">
	
  	<h1 class="text-info"><i class="fa fa-user fa-2x" id="icon-shadow"></i> 成員管理</h1>

  	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<form class="form-inline" role="form" action="<?= base_url('member/search_member')?>" method="post">
		    <div class="input-group">
		      	<input type="text" class="form-control" id="inputSuccess" name="searchName">
		      	<span class="input-group-btn">
			        <button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-search"></span> 搜尋</button>
				</span>
		    </div><!-- /input-group -->
			</form>
		</div><!-- /.col-lg-6 -->
	</div>
	<div class="clearfix"><br></div>
	<button class="btn btn-info pull-right" onclick="location.href='<?= base_url('member/add_member')?>'"><span class="glyphicon glyphicon-plus"></span> 新增成員</button>
	<div class="pull-right">&nbsp; &nbsp; &nbsp; </div>
	<button class="btn btn-warning pull-right" data-toggle="modal" data-target="#add_member_btn"><span class="glyphicon glyphicon-plus"></span> 批次新增成員</button>    
  	<!-- 分隔用 -->
	<div class="clearfix"><br><br><br></div> 

	<table class="table table-hover table-striped">
		<tr class="success">
			<td>帳號</td>
			<td>姓名</td>
			<td>群組</td>
			<td>編輯</td>
			<td>刪除</td>
		</tr>
		<? foreach ($query as $key => $value) { ?>
		<tr class="wow slideInRight">
			<td><?= $value->account; ?></td>
			<td><?= $value->name; ?></td>
			<td><?= $value->groupName; ?></td>
			<td><button class="btn btn-warning" onclick="location.href='<?= base_url('member/edit_member/'. $value->account);?>'">編輯</button></td>	
			<td><button class="btn btn-danger" onclick="if (confirm('確認刪除？')){location.href='<?=base_url('member/delete_member/'.$value->account)?>'}"><span class="glyphicon glyphicon-remove"></span></button></td>
		</tr>
		<? } ?>
	</table>
</article>

<!-- 新增成員下滑選單模組 -->
<div class="modal fade" id="add_member_btn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- 模組表頭 -->
      <div class="modal-header"> 
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h1 class="modal-title text-info" id="myModalLabel"><span class="glyphicon glyphicon-plus-sign"></span> 批次新增成員</h1>
      </div>
      <!-- 模組內文 -->
      <div class="modal-body">

      	<form class="form-horizontal" role="form" method="post" action="<?= base_url('member/upload_member_list')?>" enctype="multipart/form-data">
		  <div class="form-group">
		    <label class="col-sm-2 control-label">群組</label>
		    <div class="col-sm-9">
		      <select class="form-control" name="groupId">
		        <? foreach ($group as $key => $value) { ?>
		          <option value="<?= $value->groupId?>"><?= $value->groupName?></option>
		        <? } ?>
		      </select>
		    </div>  
		  </div>
		  <div class="form-group">
		    <label class="col-sm-2 control-label">Excel檔案</label>
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

		<img src="<?= base_url('asset/img/upload_member_excel.jpg')?>" class="img-responsive img-rounded">

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


