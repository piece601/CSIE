<? @require_once('templates/_header.php');?>
<script type="text/javascript" src="<?=base_url('/asset/ckeditor/ckeditor.js')?>"></script>


<article class="row wow fadeInUp">
<h1 class="text-danger col-sm-offset-2"><span class="glyphicon glyphicon-edit"></span> <?= $query->pageName;?> - 編輯頁面</h1>
<br> 
<form class="form-horizontal" role="form" method="post" action="<?= base_url('page/editing_page/'.$query->pageClass.'/'.$query->pageId)?>">

  <div class="form-group">
    <label class="col-sm-2 control-label">頁面標題</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="pageName" placeholder="ex. 國際期刊" value="<?= $query->pageName;?>">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">頁面內容</label>
    <div class="col-sm-9">
      <textarea class="ckeditor" name="pageContent"><?= $query->pageContent;?></textarea>
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