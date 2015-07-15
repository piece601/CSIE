<? @require_once('templates/_header.php');?>
<script type="text/javascript" src="<?=base_url('/asset/ckeditor/ckeditor.js')?>"></script>

<article class="row wow fadeInUp">

<h1 class="text-danger col-sm-offset-2"><span class="glyphicon glyphicon-edit"></span> 編輯公告</h1>
<br> 
<form class="form-horizontal" role="form" method="post" action="<?= base_url('news/editing_news/'.$query->newsId)?>">

  <div class="form-group">
    <label class="col-sm-2 control-label">公告類別</label>
    <div class="col-sm-9">
      <select class="form-control" name="newsClass">
        <? foreach ($query2 as $key => $value) { ?>
          <? if(($value->newsClass != '') && ($value->newsClass != $query->newsClass)) { // 判斷是不是全部公告?>
          <option value="<?= $value->newsClass?>"><?= $value->newsClassName?></option>
          <? } ?>
          <? if(($value->newsClass != '') && ($value->newsClass == $query->newsClass)) { // 判斷是不是全部公告?>
          <option value="<?= $value->newsClass?>" selected><?= $value->newsClassName?></option>
          <? } ?>
        <? } ?>
      </select>
    </div>  
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">公告標題</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="newsTitle" value="<?= $query->newsTitle?>">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">公告內容</label>
    <div class="col-sm-9">
      <textarea class="ckeditor" name="newsContent"><?= $query->newsContent?></textarea>
    </div>
  </div>


  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary btn-lg">送出</button>
    </div>
  </div>
</form>
</article>
