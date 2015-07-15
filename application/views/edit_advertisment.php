<? @require_once('templates/_header.php');?>

<article class="row wow fadeInUp">
  
<? echo validation_errors('<div class="alert alert-warning">', '</div>'); ?>

<h1 class="text-danger col-sm-offset-2"><span class="glyphicon glyphicon-edit"></span> 編輯廣告資料</h1>
<br> 
<form class="form-horizontal" role="form" method="post" action=""  enctype="multipart/form-data">

  <div class="form-group">
    <label class="col-sm-2 control-label">Logo名稱</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="logoTitle" placeholder="ex. 谷歌" value="<?= $query->logoTitle;?>">
    </div>
  </div>

  <div class="form-group">
    <label for="inputAccount" class="col-sm-2 control-label">Logo網址</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="logoUrl" placeholder="http://" value="<?= $query->logoUrl;?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">圖片位置</label>
    <div class="col-sm-9">
      <input type="file" name="userfile" class="form-control" />
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