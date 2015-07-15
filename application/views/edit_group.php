<? @require_once('templates/_header.php');?>
<article class="row wow fadeInUp">
  	<h1 class="text-info"><span class="glyphicon glyphicon-edit"></span>  編輯權限 - <?= $query->groupName;?></h1>
  	<form class="form-horizontal" role="form" method="post" action="<?= base_url('group/editing_group')?>">
  	  <input class="hidden" name="groupId" value="<?= $query->groupId?>">
  	  <div class="form-group">
  	  	<label class="col-sm-2 control-label">群組名稱</label>
  	  	<div class="col-sm-9">
  	  		<input class="form-control" type="text" name="groupName" value="<?= $query->groupName?>">
  	  	</div>
  	  </div>		

  	  <div class="form-group">
  	  	<label class="col-sm-2 control-label">公告管理權限</label>
  	  	<div class="col-sm-9">
	  	  <select class="form-control" name="news_token">
	  	  	  <option value="0">關</option>
	  	  	<? if($query->news_token == 1){ ?>
	          <option value="1" selected>開</option>
	        <? }else{ ?>
	          <option value="1">開</option>
	        <? } ?>
	      </select>
  	  	</div>
  	  </div>

  	  <div class="form-group">
  	  	<label class="col-sm-2 control-label">群組管理權限</label>
  	  	<div class="col-sm-9">
  		  <select class="form-control" name="group_token">
	  	  	  <option value="0">關</option>
	  	  	<? if($query->group_token == 1){ ?>
	          <option value="1" selected>開</option>
	        <? }else{ ?>
	          <option value="1">開</option>
	        <? } ?>
	      </select>
  	  	</div>
  	  </div>

  	  <div class="form-group">
  	  	<label class="col-sm-2 control-label">成員管理權限</label>
  	  	<div class="col-sm-9">
  	  	  <select class="form-control" name="member_token">
	  	  	  <option value="0">關</option>
	  	  	<? if($query->member_token == 1){ ?>
	          <option value="1" selected>開</option>
	        <? }else{ ?>
	          <option value="1">開</option>
	        <? } ?>
	      </select>
  	  	</div>
  	  </div>

  	  <div class="form-group">
  	  	<label class="col-sm-2 control-label">檔案管理權限</label>
  	  	<div class="col-sm-9">
  	  	  <select class="form-control" name="file_token">
	  	  	  <option value="0">關</option>
	  	  	<? if($query->file_token == 1){ ?>
	          <option value="1" selected>開</option>
	        <? }else{ ?>
	          <option value="1">開</option>
	        <? } ?>
	      </select>
  	  	</div>
  	  </div>

  	  <div class="form-group">
  	  	<label class="col-sm-2 control-label">頁面管理權限</label>
  	  	<div class="col-sm-9">
  	  	  <select class="form-control" name="page_token">
	  	  	  <option value="0">關</option>
	  	  	<? if($query->page_token == 1){ ?>
	          <option value="1" selected>開</option>
	        <? }else{ ?>
	          <option value="1">開</option>
	        <? } ?>
	      </select>
  	  	</div>
  	  </div>

  	  <div class="form-group">
  	  	<label class="col-sm-2 control-label">廣告管理權限</label>
  	  	<div class="col-sm-9">
  	  	  <select class="form-control" name="ad_token">
	  	  	  <option value="0">關</option>
	  	  	<? if($query->ad_token == 1){ ?>
	          <option value="1" selected>開</option>
	        <? }else{ ?>
	          <option value="1">開</option>
	        <? } ?>
	      </select>
  	  	</div>
  	  </div>

	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	      <button type="submit" class="btn btn-success btn-lg">送出</button>
	    </div>
	  </div>
	</form>
</article>
<? @require_once('templates/_footer.php');?>


