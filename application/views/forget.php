<? @require_once('templates/_header.php');?>

<article class="row wow fadeInUp">
  
<? echo validation_errors('<div class="alert alert-warning">', '</div>'); ?>

<h1 class="text-danger col-sm-offset-2"><i class="fa fa-envelope fa-2x"></i> 忘記密碼</h1>
<br> 
<form class="form-horizontal" role="form" method="post" action="">

  <div class="form-group">
    <label class="col-sm-2 control-label">輸入E-mail</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="email" placeholder="xxx@gmail.com" value="<? echo set_value('email');?>">
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