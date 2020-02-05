<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Поиск</title>
        <link href="/template/css/bootstrap.min.css" rel="stylesheet">
        <link href="/template/css/main.css" rel="stylesheet">
    </head><!--/head-->
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/">GreenIce Finder</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
          <?php if (User::isGuest()): ?>
                
          <?php else: ?>
          <form class="form-inline my-2 my-lg-0" action="/"method="post">
                <input class="form-control mr-sm-2" value="<?php echo $_SESSION['search'] ?? ''; ?>"name="search"type="search" placeholder="Введите имя" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Поиск</button>
            </form>
          <?php endif; ?>
      </li>
    </ul>
      <?php if (User::isGuest()): ?>                                        
        <a href="login">
            <button class="btn btn-outline-success my-2 my-sm-0 my-2 my-lg-0" >Войти</button>
        </a>
        <a href="register">
          <button class="btn btn-outline-success my-2 my-sm-0 my-2 my-lg-0" >Регистрация</button>
        </a>
     <?php else: ?>
      <a href="favorite">
            <button class="btn btn-outline-success my-2 my-sm-0 my-2 my-lg-0" >Избраные</button>
        </a>
        <a href="logout">
        <button class="btn btn-outline-danger my-2 my-sm-0 my-2 my-lg-0 " >Выйти</button>
      </a>
    <?php endif; ?>
  </div>
</nav>
    