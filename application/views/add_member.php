<? @require_once('templates/_header.php');?>

<article class="row wow fadeInUp">
  
<? echo validation_errors('<div class="alert alert-warning">', '</div>'); ?>

<h1 class="text-danger col-sm-offset-2"><span class="glyphicon glyphicon-plus-sign"></span> 新增成員資料</h1>
<br> 
<form class="form-horizontal" role="form" method="post" action="">
  
  <div class="form-group">
    <label class="col-sm-2 control-label">群組</label>
    <div class="col-sm-9">
      <select class="form-control" name="groupId">
        <? foreach ($query as $key => $value) { ?>
          <option value="<?= $value->groupId?>"><?= $value->groupName?></option>
        <? } ?>
      </select>
    </div>  
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">姓名</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="name" placeholder="ex. 王小明" value="<? echo set_value('name');?>">
    </div>
  </div>

  <div class="form-group">
    <label for="inputAccount" class="col-sm-2 control-label">帳號</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="account" placeholder="帳號 (至少6個字元)" value="<? echo set_value('account');?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">密碼</label>
    <div class="col-sm-9">
      <input type="password" class="form-control" name="password" placeholder="密碼 (至少6個字元)">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">重複密碼</label>
    <div class="col-sm-9">
      <input type="password" class="form-control" name="passwordrt" placeholder="與上一欄位相符同">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">信箱</label>
    <div class="col-sm-9">
      <input type="email" class="form-control" name="email" placeholder="test@google.com.tw">
    </div>
  </div>
  <!-- <div class="form-group">
    <label class="col-sm-2 control-label">信箱</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="email" placeholder="ex. 123@gmail.com" value="<? echo set_value('email');?>">
    </div>
  </div> -->
  

  <!-- <div class="form-group">
    <label class="col-sm-2 control-label">電話</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="telephone" placeholder="ex. 0222334455" value="<? echo set_value('telephone');?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">地址</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="address" placeholder="新北市、台北市" value="<? echo set_value('address');?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">地區</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="region" placeholder="三民區、" value="<? echo set_value('region');?>">
    </div>
  </div> -->

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary btn-lg">送出</button>
    </div>
  </div>
</form>
</article>
<? @require_once('templates/_footer.php');?>