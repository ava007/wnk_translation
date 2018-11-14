<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
echo '<meta name="description" content="';
if (isset($metadescription))
    echo $metadescription;
else 
    echo __('Translation');
echo '">';
?>
<meta name="author" content="">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="robots" content="noindex, nofollow" />

<title>CakePHP 3 Translation Plugin</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-custom">
<div id="preloader"><div id="load"></div></div>

<nav class="navbar navbar-light navbar-fixed-top bg-light" role="navigation">
    <a class="navbar-brand" href="/"><?= env('HTTP_HOST') ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/wnk-translation/translations">TranslationList <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/wnk-translation/translations/cockpit">Cockpit</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/wnk-translation/translations/about">About</a>
      </li>

    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
    
<div class="container-fluid">
<div class="row" style="padding-top: 60px">
   <div class="col-sm-12 col-md-9">
   <?= $this->Flash->render() ?>
   <?= $this->fetch('content') ?>
   </div>
</div>
</div><!-- end of container -->

<footer><div class="container">
<div class="row"><div class="col-md-12 col-lg-12">
<p>©Copyright 2019 - wanaka GmbH. All rights reserved.</p>
</div></div>

<div class="row"><div class="col-md-12 col-lg-12">
<a href="/wnk-translation/translations/index">Translations</a>
<small><?= $this->request->env('HTTP_ACCEPT_LANGUAGE') ?></small>
</div></div>

<div class="row"><div class="col-md-12 col-lg-12">
<a href="/wnk-translation/translations/about">About</a>
</div></div>

<div class="row"><div class="col-md-12 col-lg-12">
<a href="/wnk-translation/translations/cockpit">Cockpit</a>
</div></div>


</div></footer>

</body></html>
