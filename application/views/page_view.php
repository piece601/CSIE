<? @require_once('templates/_header.php');?>
<article class="row wow fadeInUp">
	<? if($this->session->userdata('page_token')){ ?>
	<button class="btn btn-danger pull-right" onclick="if(confirm('確定刪除頁面？')){location.href='<?= base_url('page/delete_page/'.$query->pageClass.'/'.$query->pageId)?>'}"><span class="glyphicon glyphicon-remove"></span> 刪除</button>    
	<div class="pull-right">&nbsp; &nbsp; &nbsp; </div>
	<button class="btn btn-warning pull-right" onclick="location.href='<?= base_url('page/edit_page/'.$query->pageId)?>'"><span class="glyphicon glyphicon-edit"></span> 編輯頁面</button>    
	<? } ?>
  	<!-- 分隔用 -->
	<section>
		<h1 class="text-info"><?= $query->pageName?></h1>
		<blockquote><?= $query->pageContent;?></blockquote>
	</section>
</article>
<? @require_once('templates/_footer.php');?>


