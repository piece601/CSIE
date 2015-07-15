<? @require_once('templates/_header.php');?>
<script type="text/javascript" src="<?=base_url('/asset/ckeditor/ckeditor.js')?>"></script>

<article class="row wow fadeInUp">
  
<? echo validation_errors('<div class="alert alert-warning">', '</div>'); ?>

<h1 class="text-danger col-sm-offset-2"><span class="glyphicon glyphicon-plus-sign" id="icon-shadow"><?= $query2->newsClassName?> 新增公告</span> </h1>
<br> 
<form class="form-horizontal" role="form" method="post" action="" enctype="multipart/form-data">

  <div class="form-group">
    <label class="col-sm-2 control-label">公告類別</label>
    <div class="col-sm-9">
      <select class="form-control" name="newsClass">
        <? foreach ($query as $key => $value) { ?>
          <? if(($value->newsClass != '') && ($value->newsClass != $query2->newsClass)) { // 判斷是不是全部公告?>
          <option value="<?= $value->newsClass?>"><?= $value->newsClassName?></option>
          <? } ?>
          <? if(($value->newsClass != '') && ($value->newsClass == $query2->newsClass)) { // 判斷是不是全部公告?>
          <option value="<?= $value->newsClass?>" selected><?= $value->newsClassName?></option>
          <? } ?>
        <? } ?>
      </select>
    </div>  
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">公告標題</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="newsTitle" placeholder="ex. 王小明" value="<? echo set_value('newsTitle');?>">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">公告內容</label>
    <div class="col-sm-9">
      <textarea class="ckeditor" name="newsContent"><? echo set_value('newsContent');?></textarea>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">檔案</label>
    <div class="col-sm-9" id="userfile">
      <ul class="list-inline">
        <li><input type="file" class="form-control" name="userfile0"/></li>
        <li><input type="text" class="form-control" name="newsFileName[userfile0]" placeholder="檔案名稱"></li>
      </ul>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label"></label>
    <div class="col-sm-9">
      <a class="btn btn-info btn-xs" id="add_uploadfield_btn" role="button"><span class="glyphicon glyphicon-plus"></span></a>
    </div>
  </div>
      

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary btn-lg">送出</button>
    </div>
  </div>
</form>
</article>


<script>
  //set the default value
  var txtId = 1;
  
  //add input block in showBlock
  $("#add_uploadfield_btn").click(function () {
      $("#userfile").append('<ul class="list-inline" id="div'+ txtId+'"><li><input type="file" class="form-control" name="userfile' + txtId + '" /></li> <li><input type="text" class="form-control" placeholder="檔案名稱" name="newsFileName[userfile'+ txtId +']"></li> <li><input type="button" class="btn btn-danger btn-xs" onclick="del_uploadfield_btn('+txtId+')" value="X" /></li></ul>');
      txtId++;
  });
 
  //remove div
  function del_uploadfield_btn(id) {
      $("#div"+id).remove();
  }
</script> 
<? @require_once('templates/_footer.php');?>