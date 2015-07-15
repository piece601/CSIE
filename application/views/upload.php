<? @require_once('templates/_header.php');?>

<article class="row wow fadeInUp">

<script type="text/javascript" src="<?=base_url('/asset/ckeditor/ckeditor.js')?>"></script>

<? echo validation_errors('<div class="alert alert-warning">', '</div>'); ?>


<h1 class="text-danger col-sm-offset-2"><?= $query->fileClassName;?> - 檔案上傳</h1>
<br> 
<form class="form-horizontal" role="form" method="post" action="<?=base_url('file/uploading/'.$query->fileClass)?>" enctype="multipart/form-data">
  <input type="hidden" name="fileClass" value="<?= $query->fileClass?>">

  <div class="form-group">
    <label for="inputAccount" class="col-sm-2 control-label">檔案名稱</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="fileName" placeholder="">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">檔案位置</label>
    <div class="col-sm-9">
        <input class="form-control" type="file" name="userfile" />
    </div>
  </div>

  <!-- <div class="form-group">
    <label class="col-sm-2 control-label">圖片內文</label>
    <div class="col-sm-9">
      <textarea class="ckeditor" name="img_text"></textarea>
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