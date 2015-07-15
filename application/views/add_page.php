<? @require_once('templates/_header.php');?>
<script type="text/javascript" src="<?=base_url('/asset/ckeditor/ckeditor.js')?>"></script>


<article class="row wow fadeInUp">
<? echo validation_errors('<div class="alert alert-warning">', '</div>'); ?>
<h1 class="text-danger col-sm-offset-2">新增頁面</h1>
<br> 
<form class="form-horizontal" role="form" method="post" action="">

  <div class="form-group">
    <label class="col-sm-2 control-label">頁面標題</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="pageName" placeholder="ex. 國際期刊" value="<? echo set_value('pageName');?>">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">頁面內容</label>
    <div class="col-sm-9">
      <textarea class="ckeditor" name="pageContent"><? echo set_value('pageContent');?></textarea>
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