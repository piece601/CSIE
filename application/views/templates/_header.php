<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="描述">
  <meta name="keywords"content="關鍵字,關鍵字">
  <meta name="author" content="趙承瑋 Piece">
  <title>National Formosa University Computer Science Information Technology</title>
  <link rel="stylesheet" type="text/css" href="<?=base_url('asset/css/flatly.bootstrap.min.css')?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('asset/css/font-awesome.min.css')?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('asset/css/menu.css')?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('asset/css/animate.css')?>">
  <!-- <link rel="stylesheet" type="text/css" href="<?=base_url('asset/css/hover.min.css')?>"> -->
  <link rel="stylesheet" type="text/css" href="<?=base_url('asset/css/piece.css')?>">
  
  <style type="text/css">
/*    body {
      font-size: 18px;
    }*/
  </style>
</head>
<body>
<div class="container">
<!-- 後台選單 -->
<? if($this->session->userdata('account')){ ?>
<nav class="menu" id="theMenu">
  <div class="menu-wrap">
    <h1 class="logo close-menu"><a href="#">後台管理模組</a></h1>
    <i class="icon-remove menu-close">X</i>  
    <?php if ($this->session->userdata('news_token')): ?>
      <a href="<?= base_url('news')?>" class="smoothScroll">公告管理</a>  
    <?php endif ?>

    <?php if ($this->session->userdata('group_token')): ?>
      <a href="<?= base_url('group')?>" class="smoothScroll">群組管理</a>  
    <?php endif ?>
    
    <?php if ($this->session->userdata('member_token')): ?>
      <a href="<?= base_url('member')?>" class="smoothScroll">成員管理</a>  
    <?php endif ?>

    <?php if ($this->session->userdata('file_token')): ?>
      <a href="<?= base_url('file')?>" class="smoothScroll">檔案管理</a>  
    <?php endif ?>

    <?php if ($this->session->userdata('page_token')): ?>
      <a href="<?= base_url('page')?>" class="smoothScroll">頁面管理</a>  
    <?php endif ?>

    <?php if ($this->session->userdata('ad_token')): ?>
      <a href="<?= base_url('advertisment')?>" class="smoothScroll">廣告管理</a>
    <?php endif ?>
  </div>
  <div id="menuToggle"><span class="glyphicon glyphicon-th"></span></div>
</nav>
<? } ?>
<!-- END後台選單 -->

<header class="row" style="margin: 0 0 50px 0;">
  <!-- <div id="box"> -->
  <nav class="navbar navbar-default navbar-inverse" role="navigation" id="nav" style="z-index:1;">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?= base_url('')?>">資訊工程系</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <!-- <li><a href="#" class="glow">選單</a></li> -->

        <ul class="hidden"><li>
        <?php $delay = 0;?>
        <?php $temp = -1?>
        <?php $animate_string = array('bounce', 'flash', 'pulse', 'bounceIn')?>
        <?php $animate_string = $animate_string[array_rand($animate_string)]?> 
        <?php foreach ($headerQuery as $key => $value): ?>
          <?php if ($value->pageClass != $temp): ?>
            </ul></li>
            <li class="dropdown wow <?= $animate_string?>" data-wow-delay="<?=$delay+=0.1?>s">
            <a href="#" class="dropdown-toggle btn-hover-success" data-toggle="dropdown"><?= $value->pageClassName?></a>
            <ul class="dropdown-menu wow flipInX">
          <?php endif ?>
          <li><a href="<?=base_url('page/view/'.$value->pageId)?>"><?=$value->pageName?></a></li>
          <?php $temp = $value->pageClass; ?>
        <?php endforeach ?>
      </ul></li></ul>

      <?php if ( ! $this->session->userdata('account')): ?>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#"  data-toggle="modal" data-target="#login_btn">登入</a></li>
        </ul> 
      <?php else: ?>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="<?= base_url('user/logout')?>" >您好~ <?= $this->session->userdata('name')?> 登出</a></li>
        </ul>
      <?php endif ?>
    </div>
  </nav>
<!-- </div> -->
  <!-- LOGO -->
  <!-- <blockquote> -->

  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
      <li data-target="#carousel-example-generic" data-slide-to="1"></li>
      <li data-target="#carousel-example-generic" data-slide-to="2"></li>
      <li data-target="#carousel-example-generic" data-slide-to="3"></li>
      <li data-target="#carousel-example-generic" data-slide-to="4"></li>
      <li data-target="#carousel-example-generic" data-slide-to="5"></li>
      <li data-target="#carousel-example-generic" data-slide-to="6"></li>
      <li data-target="#carousel-example-generic" data-slide-to="7"></li>
      <li data-target="#carousel-example-generic" data-slide-to="8"></li>
      <li data-target="#carousel-example-generic" data-slide-to="9"></li>
      <li data-target="#carousel-example-generic" data-slide-to="10"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox" style="height: 300px;">
      <div class="item active">
        <img src="<?=base_url('asset/img/banner/1.jpg')?>" class="img-rounded" alt="..." style="width:100%; height: 100%;">
        <div class="carousel-caption">資訊工程系XD</div>
      </div>
      <div class="item">
        <img src="<?=base_url('asset/img/banner/2.jpg')?>" class="img-rounded" alt="...">
        <div class="carousel-caption"></div>
      </div>
      <div class="item">
        <img src="<?=base_url('asset/img/banner/3.jpg')?>" class="img-rounded" alt="...">
        <div class="carousel-caption"></div>
      </div>
      <div class="item">
        <img src="<?=base_url('asset/img/banner/4.jpg')?>" class="img-rounded" alt="...">
        <div class="carousel-caption"></div>
      </div>
      <div class="item">
        <img src="<?=base_url('asset/img/banner/5.jpg')?>" class="img-rounded" alt="...">
        <div class="carousel-caption"></div>
      </div>
      <div class="item">
        <img src="<?=base_url('asset/img/banner/6.jpg')?>" class="img-rounded" alt="...">
        <div class="carousel-caption"></div>
      </div>
      <div class="item">
        <img src="<?=base_url('asset/img/banner/7.jpg')?>" class="img-rounded" alt="...">
        <div class="carousel-caption"></div>
      </div>
      <div class="item">
        <img src="<?=base_url('asset/img/banner/8.jpg')?>" class="img-rounded" alt="...">
        <div class="carousel-caption"></div>
      </div>
      <div class="item">
        <img src="<?=base_url('asset/img/banner/9.jpg')?>" class="img-rounded" alt="...">
        <div class="carousel-caption"></div>
      </div>
      <div class="item">
        <img src="<?=base_url('asset/img/banner/10.jpg')?>" class="img-rounded" alt="...">
        <div class="carousel-caption"></div>
      </div>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

  <!-- <img src="<?= base_url('asset/img/logo.png')?>" class="img-responsive"> -->
    <!-- <a href="<?=base_url();?>"><h1 class="text-danger">資訊工程系</h1></a> -->
  <!-- </blockquote> -->
</header>


<!-- 登入下滑選單模組 -->
<div class="modal fade" id="login_btn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- 模組表頭 -->
      <div class="modal-header"> 
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h1 class="modal-title text-info" id="myModalLabel"><span class="glyphicon glyphicon-plus-sign"></span> 成員登入</h1>
      </div>
      <!-- 模組內文 -->
      <div class="modal-body">

    <form class="form-horizontal" role="form" method="post" action="<?= base_url('user/login')?>" enctype="multipart/form-data">
      <div class="form-group">
        <label class="col-sm-2 control-label">帳號</label>
        <div class="col-sm-9">
          <input type="text" name="account" class="form-control">
        </div>  
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">密碼</label>
        <div class="col-sm-9">
          <input type="password" name="password" class="form-control">
        </div>  
      </div>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-primary btn-lg">登入</button>
          <a href="<?= base_url('user/forget')?>">忘記密碼</a>
        </div>
      </div>
    </form>

      </div>
      <!-- 模組底部 -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END模組 -->

<aside class="col-xs-12 col-sm-3 col-md-3">
  <ul class="nav nav-pills nav-stacked hidden-xs" >
    <?php $delay = 0;?>
    <?php foreach ($asideQuery as $key => $value): ?>
      <li class="wow slideInLeft" data-wow-delay="<?=$delay+=0.1?>s" data-wow-offset="-999" style="border: 1px solid #fff; border-radius:3px; border-left-color: #d9534f; border-left-width: 5px;">
        <a href="<?= base_url($value->asideValue)?>"><?= $value->asideName;?></a>
      </li>
      <hr>
    <?php endforeach ?>
  </ul>
  <ul class="list-inline visible-xs">
    <?php $delay = 0;?>
    <?php foreach ($asideQuery as $key => $value): ?>
      <li class="wow slideInLeft" data-wow-delay="<?=$delay+=0.1?>s" data-wow-offset="-999" style="border: 1px solid #fff; border-radius:3px; border-left-color: #d9534f; border-left-width: 5px;">
        <a href="<?= base_url($value->asideValue)?>"><h4><?= $value->asideName;?></h4></a>
      </li>      
    <?php endforeach ?>
  </ul>
</aside>
<div class="col-xs-12 col-sm-9 col-md-9">