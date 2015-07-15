<? @require_once('templates/_header.php');?>

<article class="row wow fadeInUp">

<h1 class="text-danger col-sm-offset-2"><i class="fa fa-envelope fa-2x"></i> 修改密碼</h1>
<br> 
<form class="form-horizontal" role="form" method="post" action="">

  <div class="form-group">
    <label class="col-sm-2 control-label">輸入密碼</label>
    <div class="col-sm-9">
      <input type="password" class="form-control" name="data[password]">
    </div>
  </div>
   <div class="form-group">
    <label class="col-sm-2 control-label">重複輸入密碼</label>
    <div class="col-sm-9">
      <input type="password" class="form-control" name="data[passwordwrt]">
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