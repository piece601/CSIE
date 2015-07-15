<? @require_once('templates/_header.php');?>
<article class="row wow fadeInUp">
  	<h1 class="text-info"><i class="fa fa-female fa-2x"></i><?= $query2->groupName?> - 群組成員</h1>
	<button class="btn btn-info pull-right" onclick="location.href='<?= base_url('member/add_member')?>'"><span class="glyphicon glyphicon-plus"></span> 新增成員</button>
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
		<tr>
			<td><?= $value->account; ?></td>
			<td><?= $value->name; ?></td>
			<td><?= $value->groupName; ?></td>
			<td><button class="btn btn-warning" onclick="location.href='<?= base_url('member/edit_member/'.$value->account)?>'">編輯</button></td>	
			<td><button class="btn btn-danger" onclick="if (confirm('確認刪除？')){location.href='<?=base_url('member/delete_member/'.$value->account)?>'}"><span class="glyphicon glyphicon-remove"></span></button></td>
		</tr>
		<? } ?>
	</table>
</article>
<? @require_once('templates/_footer.php');?>


