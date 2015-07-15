<? @require_once('templates/_header.php');?>

<article class="row wow fadeInUp">
  <h1 class="text-info"><i class="fa fa-users fa-2x" id="icon-shadow"></i> 群組管理</h1>
  <button class="btn btn-info pull-right" data-toggle="modal" data-target="#add_group_btn"><span class="glyphicon glyphicon-plus"></span> 新增群組</button>    
  <!-- 分隔用 -->
  <div class="clearfix"><br><br><br></div> 

  <table class="table table-hover table-striped">
    <tr class="danger">
      <!-- <td>群組編號</td>  -->
      <td>群組名稱</td>
			<td>群組成員</td>
			<td>權限編輯</td>
			<td>刪除群組</td>
		</tr>
		<? foreach ($query as $key => $value) { ?>
			<tr class="wow slideInRight">
        <!-- <td><?= $value->groupId; ?></td> -->
				<td><h4><?= $value->groupName; ?></h4></td>
				<td><button class="btn btn-primary" onclick="location.href='<?= base_url('member/show_member/'.$value->groupId)?>'">群組成員</button> </td>
				<td><button class="btn btn-warning" onclick="location.href='<?= base_url('group/edit_group/'.$value->groupId)?>'">編輯</button> </td>
				<td><button class="btn btn-danger" onclick="if (confirm('刪除群組會將群組下的成員一並刪除喲，確認刪除？')){location.href='<?=base_url('group/delete_group/'.$value->groupId)?>'}"><span class="glyphicon glyphicon-remove"></span></button> </td>	
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
        <h1 class="modal-title text-info" id="myModalLabel">新增群組</h1>
      </div>
      <!-- 模組內文 -->
      <div class="modal-body">
        <form role="form" method="post" action="<?= base_url('group/add_group')?>">
          <div class="form-group">
            <label for="groupName">群組名稱</label>
            <input type="text" class="form-control" id="groupName" name="groupName" placeholder="">
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


