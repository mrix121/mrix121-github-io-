<?php 
require "db.php";
$data = $_POST;

if (isset($data['do_signup'])) {
  $error = array();
  if (trim($data['firstname']) == ''){
    $error[] = 'Enter firstname';
  }
  if (trim($data['lastname']) == ''){
    $error[] = 'Enter lastname';
  }
  if (trim($data['login']) == ''){
    $error[] = 'Enter login';
  }
  if (trim($data['password']) == ''){
    $error[] = 'Enter password';
  }
  if (trim($data['password_2']) == ''){
    $error[] = 'Confirm password';
  }
  if (R::count('users', 'login = ?', array($data['login'])) > 0) {
    $error[] = 'Данный пользователь зарегестрирован'; 
  }
  if (trim($data['password']) != trim($data['password_2'])){
    $error[] = 'Неверный пароль';
  }

  if(empty($error)){
    //sign up error
    $user = R::dispense('users');
    $user->firsname = $data['firstname'];
    $user->lastname = $data['lastname'];
    $user->login = $data['login'];
    $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
    $user->ip = $_SERVER['REMOTE_ADDR'];
    $user->d_date_reg = date("d");
    $user->m_date_reg = date("m");
    $user->y_date_reg = date("y");
    $user->h_time_reg = date("h");
    $user->m_time_reg = date("i");
    R::store($user);

  }
  else{
    //show errors
    echo "<div>". array_shift($error)."</div>";
  }

}

if(isset($data['signin'])){
  $user = R::findOne('users', 'login = ?', array($data['login'])); 

  if($user){
    if(password_verify($data['password'], $user->password)){
      $_SESSION['logged_user'] = $user;
    }
  }
}


?>



<!DOCTYPE html>
<html style="font-size: 16px;" lang="ru"><head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>Регистрация и авторизация</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
<link rel="stylesheet" href="Страница-1.css" media="screen">
    <script class="u-script" type="text/javascript" src="jquery-1.9.1.min.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 5.0.10, nicepage.com">
    <meta name="referrer" content="origin">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
    
    
    <script type="application/ld+json">{
		"@context": "http://schema.org",
		"@type": "Organization",
		"name": "WebSite3305343",
		"logo": "images/dental-clipart-dental-logo-16.png"
}</script>
    <meta name="theme-color" content="#ff724a">
    <meta property="og:title" content="Страница 1">
    <meta property="og:description" content="">
    <meta property="og:type" content="website">
  </head>
  <body class="u-body u-xl-mode" data-lang="ru"><header class="u-clearfix u-grey-15 u-header u-sticky u-sticky-0620 u-header" id="sec-6b2a"><div class="u-clearfix u-sheet u-sheet-1">
        <a href="Главная.html" class="u-image u-logo u-image-1" data-image-width="1250" data-image-height="1080" title="Главная">
          <img src="images/dental-clipart-dental-logo-16.png" class="u-logo-image u-logo-image-1">
        </a>
        <nav class="u-menu u-menu-one-level u-offcanvas u-menu-1" data-responsive-from="MD">
          <div class="menu-collapse" style="font-size: 1rem; letter-spacing: 0px;">
            <a class="u-button-style u-custom-left-right-menu-spacing u-custom-padding-bottom u-custom-top-bottom-menu-spacing u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="#">
              <svg class="u-svg-link" viewBox="0 0 24 24"><use xlink:href="#menu-hamburger"></use></svg>
              <svg class="u-svg-content" version="1.1" id="menu-hamburger" viewBox="0 0 16 16" x="0px" y="0px" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg"><g><rect y="1" width="16" height="2"></rect><rect y="7" width="16" height="2"></rect><rect y="13" width="16" height="2"></rect>
</g></svg>
            </a>
          </div>
          <div class="u-custom-menu u-nav-container">
            <ul class="u-nav u-spacing-30 u-unstyled u-nav-1"><li class="u-nav-item"><a class="u-border-2 u-border-active-grey-90 u-border-hover-grey-50 u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-grey-90 u-text-grey-90 u-text-hover-grey-90" href="Главная.html" style="padding: 10px 0px;">Главная</a>
</li><li class="u-nav-item"><a class="u-border-2 u-border-active-grey-90 u-border-hover-grey-50 u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-grey-90 u-text-grey-90 u-text-hover-grey-90" href="Команда.html" style="padding: 10px 0px;">Команда</a>
</li><li class="u-nav-item"><a class="u-border-2 u-border-active-grey-90 u-border-hover-grey-50 u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-grey-90 u-text-grey-90 u-text-hover-grey-90" href="О-нас.html" style="padding: 10px 0px;">О нас</a>
</li><li class="u-nav-item"><a class="u-border-2 u-border-active-grey-90 u-border-hover-grey-50 u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-grey-90 u-text-grey-90 u-text-hover-grey-90" href="Контакты.html" style="padding: 10px 0px;">Контакты</a>
</li></ul>
          </div>
          <div class="u-custom-menu u-nav-container-collapse">
            <div class="u-black u-container-style u-inner-container-layout u-opacity u-opacity-95 u-sidenav">
              <div class="u-inner-container-layout u-sidenav-overflow">
                <div class="u-menu-close"></div>
                <ul class="u-align-center u-nav u-popupmenu-items u-unstyled u-nav-2"><li class="u-nav-item"><a class="u-button-style u-nav-link" href="Главная.html">Главная</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link" href="Команда.html">Команда</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link" href="О-нас.html">О нас</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link" href="Контакты.html">Контакты</a>
</li></ul>
              </div>
            </div>
            <div class="u-black u-menu-overlay u-opacity u-opacity-70"></div>
          </div>
        </nav>
        <a href="https://nicepage.com/joomla-page-builder" class="u-btn u-btn-round u-button-style u-radius-43 u-btn-1">Регистрация и вход</a>
      </div></header>
    <section class="u-clearfix u-section-1" id="sec-617d">
<main class="main">
      <div class="register">
        <div class="container">
          
          <div class="register__form">
            <h4 class="register__title">Регистрация</h4>
            <form class="form" action="#" method="POST">
              <input class="form__item" type="text" name="firstname" placeholder="Имя">
              <input class="form__item" type="text" name="lastname" placeholder="Фамилия">
              <input class="form__item" type="text" name="login" placeholder="Логин">
              <input class="form__item" type="password" name="password" placeholder="Пароль">
              <input class="form__item" type="password" name="password_2" placeholder="Подтвердите пароль">
              <button class="register__button" type="submit" name="do_signup">Зарегистрироваться</button>
            </form>
          </div>

        </div>
      </div>
    </main>
        <div class="u-container-style u-group u-palette-1-base u-radius-15 u-shape-round u-group-2">
          <div class="u-container-layout u-container-layout-2">
            <h3 class="u-text u-text-default u-text-2">Вход</h3>
            <div class="u-form u-form-2">
              <form action="https://forms.nicepagesrv.com/Form/Process" class="u-clearfix u-form-spacing-10 u-form-vertical u-inner-form" source="email" name="form" style="padding: 10px;">
                <div class="u-form-group u-form-group-7">
                  <label for="text-3c84" class="u-label">Логин </label>
                  <input type="text" placeholder="" id="text-3c84" name="text-1" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white">
                </div>
                <div class="u-form-group u-form-group-8">
                  <label for="text-b305" class="u-label">Пароль</label>
                  <input type="text" id="text-b305" name="text-2" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white">
                </div>
                <div class="u-align-center u-form-group u-form-submit">
                  <a href="#" class="u-btn u-btn-round u-btn-submit u-button-style u-radius-9">Войти</a>
                  <input type="submit" value="submit" class="u-form-control-hidden">
                </div>
                <div class="u-form-send-message u-form-send-success"> Спасибо! Ваше сообщение отправлено. </div>
                <div class="u-form-send-error u-form-send-message"> Отправка не удалась. Пожалуйста, исправьте ошибки и попробуйте еще раз. </div>
                <input type="hidden" value="" name="recaptchaResponse">
                <input type="hidden" name="formServices" value="b351de91e04d35d1e549bcf88614421e">
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    
    <footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-b583"><div class="u-clearfix u-sheet u-sheet-1">
        <p class="u-small-text u-text u-text-variant u-text-1" data-lang-en="Sample text. Sample text. Click to select the text box. Click again or double click to start editing the text.">© Denta-LUX 2022</p>
      </div></footer>
  
</body></html>