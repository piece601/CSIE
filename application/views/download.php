<? @require_once('templates/_header.php');?>
<article class="row wow fadeInUp">
  	<h1 class="text-info"><i class="fa fa-2x fa-cloud-download" id="icon-shadow"></i> <?= $file_category->fileClassName;?></h1>
  		<? if($this->session->userdata('file_token')){ ?>
		<button class="btn btn-info pull-right" onclick="location.href='<?= base_url('file/upload/'.$file_category->fileClass)?>'"><i class="fa fa-2x fa-cloud-upload"></i> 上傳檔案</button>    
		<? } ?>
		<!-- 分隔用 -->
		<div class="clearfix"><br><br><br></div>
	<? $count = 1;?> 
	<table class="table table-hover">
		<tr class="success">
			<td>No.</td>
			<td>檔案名稱</td>
			<td>下載</td>
			<? if($this->session->userdata('file_token')){ ?>
			<td>編輯</td>
			<td>刪除</td>
			<? } ?>
		</tr>
		<? foreach ($query as $key => $value) { ?>
		<tr class="wow slideInRight">
			<td><?= $count++;?></td>
			<td><?= $value->fileName;?></td>
			<td><button class="btn btn-info" onclick="location.href='<?= base_url("$value->filePath")?>'">下載</button></td>
			<? if($this->session->userdata('file_token')){ ?>
			<td><button class="btn btn-warning" onclick="location.href=">編輯</button></td>
			<td><button class="btn btn-danger" onclick="if (confirm('確認刪除？')){location.href='<?=base_url('file/delete_file/'.$value->fileClass.'/'.$value->fileId)?>'}"><span class="glyphicon glyphicon-remove"></span></button></td>
			<? } ?>
		</tr>
		<? } ?>
	</table>
</article>
<? @require_once('templates/_footer.php');?>


