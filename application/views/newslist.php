<? @require_once('templates/_header.php');?>
<article class="row wow fadeInUp">
	<h1 class="text-info"><i class="fa fa-bullhorn fa-2x" id="icon-shadow"></i> <?= $query2->newsClassName;?></h1>
  <? if($this->session->userdata('news_token')) { ?>
	<button class="btn btn-info pull-right" onclick="location.href='<?= base_url('news/add_news/'.$query2->newsClass)?>'"><span class="glyphicon glyphicon-plus"></span> 新增公告</button>    
  <? } ?>
	<!-- 分隔用 -->
	<div class="clearfix"><br><br><br></div> 
  <table class="table table-hover table-condensed table-striped">
    <tr class="warning">
      <td class="col-xs-2">日期</td>
      <td>公告標題</td>
      <td class="col-xs-2">分類</td>
      <? if($this->session->userdata('news_token')) { ?>
      <td class="col-xs-1">刪除</td>
      <? } ?>
    </tr>
    <? foreach ($query as $key => $value) { ?>
    <tr class="wow slideInRight">
      <td><h4 class="text-info"><?= $value->newsDate?></h4></td>
      <td><h4><a href="<?= base_url('news/view/'.$value->newsId)?>" class="text-danger" style="text-decoration:none;"><?= $value->newsTitle?></a></h4></td>
      <td><h4><?= $value->newsClassName;?></h4></td>
      <? if($this->session->userdata('news_token')) { ?>
      <td><button class="btn btn-danger pull-right" onclick="if(confirm('確定刪除這篇公告？')){location.href='<?= base_url('news/delete_news/'.$value->newsClass.'/'.$value->newsId)?>'}"><span class="glyphicon glyphicon-remove"></span></button></td>
      <? } ?>
    </tr>
    <? } ?>
  </table>
  <h5 class="text-center"><ul class="pagination"><?php echo $this->pagination->create_links(); ?></ul></h5>

</article>

<? @require_once('templates/_footer.php');?>


