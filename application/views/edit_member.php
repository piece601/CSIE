<? @require_once('templates/_header.php');?>

<article class="row wow fadeInUp">
  
<? echo validation_errors('<div class="alert alert-warning">', '</div>'); ?>

<h1 class="text-danger col-sm-offset-2"><span class="glyphicon glyphicon-edit"></span> 編輯成員資料</h1>
<br> 
<form class="form-horizontal" role="form" method="post" action="<?= base_url('member/editing_member')?>">
  
  <div class="form-group">
    <label class="col-sm-2 control-label">群組</label>
    <div class="col-sm-9">
      <select class="form-control" name="groupId">
      <? foreach ($query as $key => $value) { ?>
        <? if ($memberQuery->groupId == $value->groupId){ ?>
        <option value="<?= $value->groupId?>" selected><?= $value->groupName?></option>
        <? continue;?>
        <? } ?>
        <option value="<?= $value->groupId?>"><?= $value->groupName?></option>
      <? } ?>
      </select>
    </div>  
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">姓名</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="name" placeholder="ex. 王小明" value="<?= $memberQuery->name; ?>">
    </div>
  </div>

  <div class="form-group">
    <label for="inputAccount" class="col-sm-2 control-label">帳號</label>
    <div class="col-sm-9">
      <p class="form-control"><?= $memberQuery->account; ?></p>
      <input type="text" class="hidden" name="account" placeholder="帳號 (至少6個字元)" value="<?= $memberQuery->account ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">密碼</label>
    <div class="col-sm-9">
      <input type="password" class="form-control" name="password" placeholder="如果為空，表示原先的密碼">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">信箱</label>
    <div class="col-sm-9">
      <input type="email" class="form-control" name="email" placeholder="xxx@xxx.com" value="<?= $memberQuery->email; ?>">
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary btn-lg">送出</button>
    </div>
  </div>
</form>
</article>
<? @require_once('templates/_footer.php');?>