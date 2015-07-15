<? @require_once('templates/_header.php');?>
<article class="row wow fadeInUp">
  	<h1 class="text-info"><i class="fa fa-paper-plane-o fa-2x"></i> <?= $page_category->pageClassName;?> - 頁面分類</h1>
  	<? if($this->session->userdata('page_token')){ ?>
	<button class="btn btn-info pull-right" onclick="location.href='<?= base_url('page/add_page/'.$page_category->pageClass)?>'"><span class="glyphicon glyphicon-plus"></span> 新增頁面</button>    
	<? } ?>
  	<!-- 分隔用 -->
	<div class="clearfix"><br><br><br></div>
	<table class="table table-hover">
		<tr	class="danger">
			<td>No.</td>
			<td>頁面名稱</td>
			<? if($this->session->userdata('page_token')){ ?>
			<td>編輯</td>
			<td>刪除</td>
			<? } ?>
		</tr>
		<? $count = 1;?>
		<? foreach ($query as $key => $value) { ?>
		<tr class="wow slideInRight">
			<td><?= $count++;?></td>
			<td><a href="<?= base_url('page/view/'.$value->pageId)?>" style="text-decoration:none;"><h4><?= $value->pageName?></h4></a></td>
			<? if($this->session->userdata('page_token')){ ?>
			<td><button class="btn btn-warning" onclick="location.href='<?= base_url('page/edit_page/'.$value->pageId)?>'">編輯</button></td>
			<td><button class="btn btn-danger" onclick="if(confirm('確定刪除頁面？')){location.href='<?= base_url('page/delete_page/'.$value->pageClass.'/'.$value->pageId)?>'}"><span class="glyphicon glyphicon-remove"></span></button></td>
			<? } ?>
		</tr>
		<? } ?>
	</table>
</article>
<? @require_once('templates/_footer.php');?>


