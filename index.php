<?php
session_start();
require __DIR__ . '/adminlogin/vendor/autoload.php';
require __DIR__ . '/adminlogin/dotenv-loader.php';
use Auth0\SDK\Auth0;

$domain        = getenv('AUTH0_DOMAIN');
$client_id     = getenv('AUTH0_CLIENT_ID');
$client_secret = getenv('AUTH0_CLIENT_SECRET');
$redirect_uri  = getenv('AUTH0_CALLBACK_URL');
$audience      = getenv('AUTH0_AUDIENCE');

if($audience == ''){
    $audience = 'https://' . $domain . '/userinfo';
}

$auth0 = new Auth0([
    'domain' => $domain,
    'client_id' => $client_id,
    'client_secret' => $client_secret,
    'redirect_uri' => $redirect_uri,
    'audience' => $audience,
    'scope' => 'openid profile',
    'persist_id_token' => true,
    'persist_access_token' => true,
    'persist_refresh_token' => true,
]);

$userInfo = $auth0->getUser();

if($userInfo["name"]) {
  if (!isset($_SESSION["justSent"]) || !isset($_SESSION["sectionSelector"])) {
    $_SESSION["justSent"] = [];
    $_SESSION["sectionSelector"] = 1;
  }
}
?>
<?php if(!$userInfo): ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="utf-8">
      <meta name="author" content="Cworld">
      <meta name="viewport" content="width=device-width,initial-scale=1">
      <title>Cineworld23 Management</title>
      <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="css/my-login.css">
  </head>
  <body class="my-login-page">
  <section class="h-100">
      <div class="container h-100">
          <div class="row justify-content-md-center h-100">
              <div class="card-wrapper">
                  <div class="brand">
                      <img src="img/logo.jpg" alt="logo">
                  </div>
                  <div class="card fat">
                      <div class="card-body">
                          <form method="POST" action="adminlogin/login.php" class="my-login-validation" novalidate="">
                              <div class="form-group m-0">
                                  <button type="submit" name="login" class="btn btn-primary btn-block">
                                      Giriş
                                  </button>
                              </div>
                          </form>
                      </div>
                  </div>
                  <div class="footer">
                      Copyright &copy; 2019 &mdash; Cineworld23
                  </div>
              </div>
          </div>
      </div>
  </section>
  <script src="js/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
  </html>
<?php else: ?>
  <!DOCTYPE html>
  <html>
  <head>
      <link rel="stylesheet" href="css/style.css"/>
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
            integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <script>
          function openPage(pageName, elmnt, color) {
              if (pageName === "cw") {
                  window.location.hash = "1";
                  document.getElementById("cwtab").style.fontSize = "1.6em";
                  document.getElementById("srtab").style.fontSize = "";
              }
              if (pageName === "sr") {
                  window.location.hash = "2";
                  document.getElementById("srtab").style.fontSize = "1.6em";
                  document.getElementById("cwtab").style.fontSize = "";
              }
              var i, tabcontent, tablinks;
              tabcontent = document.getElementsByClassName("tabcontent");
              for (i = 0; i < tabcontent.length; i++) {
                  tabcontent[i].style.display = "none";
              }
              tablinks = document.getElementsByClassName("tablink");
              for (i = 0; i < tablinks.length; i++) {
                  tablinks[i].style.backgroundColor = "";
                  tablinks[i].style.color = "";
              }
              document.getElementById(pageName).style.display = "block";
              elmnt.style.backgroundColor = color;
              elmnt.style.color = '#ffbc00';
          }
      </script>
  </head>
<body>
<div>
    <button class="tablink" onclick="openPage('cw', this, '#444343')" id="cwtab">Cineworld23</button>
    <button class="tablink" onclick="openPage('sr', this, '#51535B')" id="srtab">Saray</button>
    <div class="tablinkcikis" onclick='window.location.href= "adminlogin/logout.php"'></div>
    <!-- Cineworld Section-->
    <div id="cw" class="tabcontent">
        <div class="sliderNavi">
            <a href="#slide-1">SALON1</a>
            <a href="#slide-2">SALON2</a>
            <a href="#slide-3">SALON3</a>
            <a href="#slide-4">SALON4</a>
            <a href="#slide-5">SALON5</a>
            <a href="#slide-6">JOKER1</a>
            <a href="#slide-7">JOKER2</a>
        </div>
        <div class="container">
            <div class="diagonal"><span>Vizyon</span></div>
            <div class="slider">
                <div class="slides">
                    <div class="main" id="slide-1">
                        <form action="sendMovie.php" method="post">
                            <h2>Salon 1</h2>
                            <input name="sentDivID" type="text" value="slide-1" style="display: none;">
                            <input name="sid" type="text" value="car1" style="display: none;">
                            <input name="fid" type="text" value="1" style="display: none;">
                            <input name="name" placeholder="Film adı..." type="text" required>
                            <input name="tur" placeholder="Tür..." type="text" required>
                            <input name="boyut" placeholder="Boyut..." type="text" required>
                            <input name="dil" placeholder="Dil..." type="text" required>
                            <input name="afis" placeholder="Afiş..." type="text" required>
                            <input name="fragman" placeholder="Fragman..." type="text" required>
                            <input name="konu" placeholder="Konu..." type="text" required>
                            <input name="salon" placeholder="Salon..." value="1" type="text" required>
                            <input name="seans" placeholder="Seanslar..." type="text" required>
                            <input type="reset" value="Temizle"/>
                            <input type="submit" name="cwS1submit" value="Güncelle"/>
                        </form>
                    </div>
                    <div class="main" id="slide-2">
                        <form action="sendMovie.php" method="post">
                            <h2>Salon 2</h2>
                            <input name="sentDivID" type="text" value="slide-2" style="display: none;">
                            <input name="sid" type="text" value="car2" style="display: none;">
                            <input name="fid" type="text" value="2" style="display: none;">
                            <input name="name" placeholder="Film adı..." type="text" required>
                            <input name="tur" placeholder="Tür..." type="text" required>
                            <input name="boyut" placeholder="Boyut..." type="text" required>
                            <input name="dil" placeholder="Dil..." type="text" required>
                            <input name="afis" placeholder="Afiş..." type="text" required>
                            <input name="fragman" placeholder="Fragman..." type="text" required>
                            <input name="konu" placeholder="Konu..." type="text" required>
                            <input name="salon" placeholder="Salon..." value="2" type="text" required>
                            <input name="seans" placeholder="Seanslar..." type="text" required>
                            <input type="reset" value="Temizle"/>
                            <input type="submit" name="cwS2submit" value="Güncelle"/>
                        </form>
                    </div>
                    <div class="main" id="slide-3">
                        <form action="sendMovie.php" method="post">
                            <h2>Salon 3</h2>
                            <input name="sentDivID" type="text" value="slide-3" style="display: none;">
                            <input name="sid" type="text" value="car3" style="display: none;">
                            <input name="fid" type="text" value="3" style="display: none;">
                            <input name="name" placeholder="Film adı..." type="text" required>
                            <input name="tur" placeholder="Tür..." type="text" required>
                            <input name="boyut" placeholder="Boyut..." type="text" required>
                            <input name="dil" placeholder="Dil..." type="text" required>
                            <input name="afis" placeholder="Afiş..." type="text" required>
                            <input name="fragman" placeholder="Fragman..." type="text" required>
                            <input name="konu" placeholder="Konu..." type="text" required>
                            <input name="salon" placeholder="Salon..." value="3" type="text" required>
                            <input name="seans" placeholder="Seanslar..." type="text" required>
                            <input type="reset" value="Temizle"/>
                            <input type="submit" name="cwS3submit" value="Güncelle"/>
                        </form>
                    </div>
                    <div class="main" id="slide-4">
                        <form action="sendMovie.php" method="post">
                            <h2>Salon 4</h2>
                            <input name="sentDivID" type="text" value="slide-4" style="display: none;">
                            <input name="sid" type="text" value="car4" style="display: none;">
                            <input name="fid" type="text" value="4" style="display: none;">
                            <input name="name" placeholder="Film adı..." type="text" required>
                            <input name="tur" placeholder="Tür..." type="text" required>
                            <input name="boyut" placeholder="Boyut..." type="text" required>
                            <input name="dil" placeholder="Dil..." type="text" required>
                            <input name="afis" placeholder="Afiş..." type="text" required>
                            <input name="fragman" placeholder="Fragman..." type="text" required>
                            <input name="konu" placeholder="Konu..." type="text" required>
                            <input name="salon" placeholder="Salon..." value="4" type="text" required>
                            <input name="seans" placeholder="Seanslar..." type="text" required>
                            <input type="reset" value="Temizle"/>
                            <input type="submit" name="cwS4submit" value="Güncelle"/>
                        </form>
                    </div>
                    <div class="main" id="slide-5">
                        <form action="sendMovie.php" method="post">
                            <h2>Salon 5</h2>
                            <input name="sentDivID" type="text" value="slide-5" style="display: none;">
                            <input name="sid" type="text" value="car5" style="display: none;">
                            <input name="fid" type="text" value="5" style="display: none;">
                            <input name="name" placeholder="Film adı..." type="text" required>
                            <input name="tur" placeholder="Tür..." type="text" required>
                            <input name="boyut" placeholder="Boyut..." type="text" required>
                            <input name="dil" placeholder="Dil..." type="text" required>
                            <input name="afis" placeholder="Afiş..." type="text" required>
                            <input name="fragman" placeholder="Fragman..." type="text" required>
                            <input name="konu" placeholder="Konu..." type="text" required>
                            <input name="salon" placeholder="Salon..." value="5" type="text" required>
                            <input name="seans" placeholder="Seanslar..." type="text" required>
                            <input type="reset" value="Temizle"/>
                            <input type="submit" name="cwS5submit" value="Güncelle"/>
                        </form>
                    </div>
                    <div class="mainJ" id="slide-6">
                        <form action="sendMovie.php" method="post">
                            <h2 style="color: darkred;">JOKER1</h2>
                            <input name="sentDivID" type="text" value="slide-6" style="display: none;">
                            <input name="sid" type="text" value="car6" style="display: none;">
                            <input name="fid" type="text" value="6" style="display: none;">
                            <input name="name" placeholder="Film adı..." type="text" required>
                            <input name="tur" placeholder="Tür..." type="text" required>
                            <input name="boyut" placeholder="Boyut..." type="text" required>
                            <input name="dil" placeholder="Dil..." type="text" required>
                            <input name="afis" placeholder="Afiş..." type="text" required>
                            <input name="fragman" placeholder="Fragman..." type="text" required>
                            <input name="konu" placeholder="Konu..." type="text" required>
                            <input name="salon" placeholder="Salon..." type="text" required>
                            <input name="seans" placeholder="Seanslar..." type="text" required>
                            <input type="reset" value="Temizle"/>
                            <input type="submit" name="cwS6submit" value="Güncelle"/>
                        </form>
                    </div>
                    <div class="mainJ" id="slide-7">
                        <form action="sendMovie.php" method="post">
                            <h2 style="color: darkred;">JOKER2</h2>
                            <input name="sentDivID" type="text" value="slide-7" style="display: none;">
                            <input name="sid" type="text" value="car7" style="display: none;">
                            <input name="fid" type="text" value="7" style="display: none;">
                            <input name="name" placeholder="Film adı..." type="text" required>
                            <input name="tur" placeholder="Tür..." type="text" required>
                            <input name="boyut" placeholder="Boyut..." type="text" required>
                            <input name="dil" placeholder="Dil..." type="text" required>
                            <input name="afis" placeholder="Afiş..." type="text" required>
                            <input name="fragman" placeholder="Fragman..." type="text" required>
                            <input name="konu" placeholder="Konu..." type="text" required>
                            <input name="salon" placeholder="Salon..." type="text" required>
                            <input name="seans" placeholder="Seanslar..." type="text" required>
                            <input type="reset" value="Temizle"/>
                            <input type="submit" name="cwS7submit" value="Güncelle"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="diagonal"><span>Gelecek Filmler</span></div>
            <div class="slider">
                <div class="slides">
                    <div class="mainCsoon" id="slide-8">
                        <form action="sendMovie.php" method="post">
                            <h2>1</h2>
                            <input name="sentDivID" type="text" value="slide-8" style="display: none;">
                            <input name="sid" type="text" value="car1" style="display: none;">
                            <input name="fid" type="text" value="1" style="display: none;">
                            <input name="tur" placeholder="Tür..." type="text" required>
                            <input name="boyut" placeholder="Boyut..." type="text" required>
                            <input name="dil" placeholder="Dil..." type="text" required>
                            <input name="afis" placeholder="Afiş..." type="text" required>
                            <input type="reset" value="Temizle"/>
                            <input type="submit" name="cwC1submit" value="Güncelle"/>
                        </form>
                    </div>
                    <div class="mainCsoon" id="slide-9">
                        <form action="sendMovie.php" method="post">
                            <h2>2</h2>
                            <input name="sentDivID" type="text" value="slide-9" style="display: none;">
                            <input name="sid" type="text" value="car2" style="display: none;">
                            <input name="fid" type="text" value="2" style="display: none;">
                            <input name="tur" placeholder="Tür..." type="text" required>
                            <input name="boyut" placeholder="Boyut..." type="text" required>
                            <input name="dil" placeholder="Dil..." type="text" required>
                            <input name="afis" placeholder="Afiş..." type="text" required>
                            <input type="reset" value="Temizle"/>
                            <input type="submit" name="cwC2submit" value="Güncelle"/>
                        </form>
                    </div>
                    <div class="mainCsoon" id="slide-10">
                        <form action="sendMovie.php" method="post">
                            <h2>3</h2>
                            <input name="sentDivID" type="text" value="slide-10" style="display: none;">
                            <input name="sid" type="text" value="car3" style="display: none;">
                            <input name="fid" type="text" value="3" style="display: none;">
                            <input name="tur" placeholder="Tür..." type="text" required>
                            <input name="boyut" placeholder="Boyut..." type="text" required>
                            <input name="dil" placeholder="Dil..." type="text" required>
                            <input name="afis" placeholder="Afiş..." type="text" required>
                            <input type="reset" value="Temizle"/>
                            <input type="submit" name="cwC3submit" value="Güncelle"/>
                        </form>
                    </div>
                    <div class="mainCsoon" id="slide-11">
                        <form action="sendMovie.php" method="post">
                            <h2>4</h2>
                            <input name="sentDivID" type="text" value="slide-11" style="display: none;">
                            <input name="sid" type="text" value="car4" style="display: none;">
                            <input name="fid" type="text" value="4" style="display: none;">
                            <input name="tur" placeholder="Tür..." type="text" required>
                            <input name="boyut" placeholder="Boyut..." type="text" required>
                            <input name="dil" placeholder="Dil..." type="text" required>
                            <input name="afis" placeholder="Afiş..." type="text" required>
                            <input type="reset" value="Temizle"/>
                            <input type="submit" name="cwC4submit" value="Güncelle"/>
                        </form>
                    </div>
                    <div class="mainCsoon" id="slide-12">
                        <form action="sendMovie.php" method="post">
                            <h2>5</h2>
                            <input name="sentDivID" type="text" value="slide-12" style="display: none;">
                            <input name="sid" type="text" value="car5" style="display: none;">
                            <input name="fid" type="text" value="5" style="display: none;">
                            <input name="tur" placeholder="Tür..." type="text" required>
                            <input name="boyut" placeholder="Boyut..." type="text" required>
                            <input name="dil" placeholder="Dil..." type="text" required>
                            <input name="afis" placeholder="Afiş..." type="text" required>
                            <input type="reset" value="Temizle"/>
                            <input type="submit" name="cwC5submit" value="Güncelle"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Saray Section-->
    <div id="sr" class="tabcontent">
        <div class="sliderNavi">
            <a href="#slide-20">SALON1</a>
            <a href="#slide-21">SALON2</a>
            <a href="#slide-22">SALON3</a>
            <a href="#slide-23">SALON4</a>
            <a href="#slide-24">JOKER1</a>
            <a href="#slide-25">JOKER2</a>
        </div>
        <div style="background-color: #6d6f78" class="container">
            <div class="diagonal"><span>Vizyon</span></div>
            <div style="background-color: #797c86" class="slider">
                <div class="slides">
                    <div class="main" id="slide-20">
                        <form action="sendMovie.php" method="post">
                            <h2>Salon 1</h2>
                            <input name="sentDivID" type="text" value="slide-20" style="display: none;">
                            <input name="sid" type="text" value="car1" style="display: none;">
                            <input name="fid" type="text" value="1" style="display: none;">
                            <input name="name" placeholder="Film adı..." type="text" required>
                            <input name="tur" placeholder="Tür..." type="text" required>
                            <input name="boyut" placeholder="Boyut..." type="text" required>
                            <input name="dil" placeholder="Dil..." type="text" required>
                            <input name="afis" placeholder="Afiş..." type="text" required>
                            <input name="fragman" placeholder="Fragman..." type="text" required>
                            <input name="konu" placeholder="Konu..." type="text" required>
                            <input name="salon" placeholder="Salon..." value="1" type="text" required>
                            <input name="seans" placeholder="Seanslar..." type="text" required>
                            <input type="reset" value="Temizle"/>
                            <input type="submit" name="srS1submit" value="Güncelle"/>
                        </form>
                    </div>
                    <div class="main" id="slide-21">
                        <form action="sendMovie.php" method="post">
                            <h2>Salon 2</h2>
                            <input name="sentDivID" type="text" value="slide-21" style="display: none;">
                            <input name="sid" type="text" value="car2" style="display: none;">
                            <input name="fid" type="text" value="2" style="display: none;">
                            <input name="name" placeholder="Film adı..." type="text" required>
                            <input name="tur" placeholder="Tür..." type="text" required>
                            <input name="boyut" placeholder="Boyut..." type="text" required>
                            <input name="dil" placeholder="Dil..." type="text" required>
                            <input name="afis" placeholder="Afiş..." type="text" required>
                            <input name="fragman" placeholder="Fragman..." type="text" required>
                            <input name="konu" placeholder="Konu..." type="text" required>
                            <input name="salon" placeholder="Salon..." value="2" type="text" required>
                            <input name="seans" placeholder="Seanslar..." type="text" required>
                            <input type="reset" value="Temizle"/>
                            <input type="submit" name="srS2submit" value="Güncelle"/>
                        </form>
                    </div>
                    <div class="main" id="slide-22">
                        <form action="sendMovie.php" method="post">
                            <h2>Salon 3</h2>
                            <input name="sentDivID" type="text" value="slide-22" style="display: none;"
                            <input name="sid" type="text" value="car3" style="display: none;">
                            <input name="fid" type="text" value="3" style="display: none;">
                            <input name="name" placeholder="Film adı..." type="text" required>
                            <input name="tur" placeholder="Tür..." type="text" required>
                            <input name="boyut" placeholder="Boyut..." type="text" required>
                            <input name="dil" placeholder="Dil..." type="text" required>
                            <input name="afis" placeholder="Afiş..." type="text" required>
                            <input name="fragman" placeholder="Fragman..." type="text" required>
                            <input name="konu" placeholder="Konu..." type="text" required>
                            <input name="salon" placeholder="Salon..." value="3" type="text" required>
                            <input name="seans" placeholder="Seanslar..." type="text" required>
                            <input type="reset" value="Temizle"/>
                            <input type="submit" name="srS3submit" value="Güncelle"/>
                        </form>
                    </div>
                    <div class="main" id="slide-23">
                        <form action="sendMovie.php" method="post">
                            <h2>Salon 4</h2>
                            <input name="sentDivID" type="text" value="slide-23" style="display: none;">
                            <input name="sid" type="text" value="car4" style="display: none;">
                            <input name="fid" type="text" value="4" style="display: none;">
                            <input name="name" placeholder="Film adı..." type="text" required>
                            <input name="tur" placeholder="Tür..." type="text" required>
                            <input name="boyut" placeholder="Boyut..." type="text" required>
                            <input name="dil" placeholder="Dil..." type="text" required>
                            <input name="afis" placeholder="Afiş..." type="text" required>
                            <input name="fragman" placeholder="Fragman..." type="text" required>
                            <input name="konu" placeholder="Konu..." type="text" required>
                            <input name="salon" placeholder="Salon..." value="4" type="text" required>
                            <input name="seans" placeholder="Seanslar..." type="text" required>
                            <input type="reset" value="Temizle"/>
                            <input type="submit" name="srS4submit" value="Güncelle"/>
                        </form>
                    </div>
                    <div class="mainJ" id="slide-24">
                        <form action="sendMovie.php" method="post">
                            <h2 style="color: darkred;">JOKER1</h2>
                            <input name="sentDivID" type="text" value="slide-24" style="display: none;">
                            <input name="sid" type="text" value="car5" style="display: none;">
                            <input name="fid" type="text" value="5" style="display: none;">
                            <input name="name" placeholder="Film adı..." type="text" required>
                            <input name="tur" placeholder="Tür..." type="text" required>
                            <input name="boyut" placeholder="Boyut..." type="text" required>
                            <input name="dil" placeholder="Dil..." type="text" required>
                            <input name="afis" placeholder="Afiş..." type="text" required>
                            <input name="fragman" placeholder="Fragman..." type="text" required>
                            <input name="konu" placeholder="Konu..." type="text" required>
                            <input name="salon" placeholder="Salon..." type="text" required>
                            <input name="seans" placeholder="Seanslar..." type="text" required>
                            <input type="reset" value="Temizle"/>
                            <input type="submit" name="srS5submit" value="Güncelle"/>
                        </form>
                    </div>
                    <div class="mainJ" id="slide-25">
                        <form action="sendMovie.php" method="post">
                            <h2 style="color: darkred;">JOKER2</h2>
                            <input name="sentDivID" type="text" value="slide-25" style="display: none;">
                            <input name="sid" type="text" value="car6" style="display: none;">
                            <input name="fid" type="text" value="6" style="display: none;">
                            <input name="name" placeholder="Film adı..." type="text" required>
                            <input name="tur" placeholder="Tür..." type="text" required>
                            <input name="boyut" placeholder="Boyut..." type="text" required>
                            <input name="dil" placeholder="Dil..." type="text" required>
                            <input name="afis" placeholder="Afiş..." type="text" required>
                            <input name="fragman" placeholder="Fragman..." type="text" required>
                            <input name="konu" placeholder="Konu..." type="text" required>
                            <input name="salon" placeholder="Salon..." type="text" required>
                            <input name="seans" placeholder="Seanslar..." type="text" required>
                            <input type="reset" value="Temizle"/>
                            <input type="submit" name="srS6submit" value="Güncelle"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div style="background-color: #6d6f78" class="container">
            <div class="diagonal"><span>Gelecek Filmler</span></div>
            <div style="background-color: #797c86" class="slider">
                <div class="slides">
                    <div class="mainCsoon" id="slide-26">
                        <form action="sendMovie.php" method="post">
                            <h2>1</h2>
                            <input name="sentDivID" type="text" value="slide-26" style="display: none;">
                            <input name="sid" type="text" value="car1" style="display: none;">
                            <input name="fid" type="text" value="1" style="display: none;">
                            <input name="tur" placeholder="Tür..." type="text" required>
                            <input name="boyut" placeholder="Boyut..." type="text" required>
                            <input name="dil" placeholder="Dil..." type="text" required>
                            <input name="afis" placeholder="Afiş..." type="text" required>
                            <input type="reset" value="Temizle"/>
                            <input type="submit" name="srC1submit" value="Güncelle"/>
                        </form>
                    </div>
                    <div class="mainCsoon" id="slide-27">
                        <form action="sendMovie.php" method="post">
                            <h2>2</h2>
                            <input name="sentDivID" type="text" value="slide-27" style="display: none;">
                            <input name="sid" type="text" value="car2" style="display: none;">
                            <input name="fid" type="text" value="2" style="display: none;">
                            <input name="tur" placeholder="Tür..." type="text" required>
                            <input name="boyut" placeholder="Boyut..." type="text" required>
                            <input name="dil" placeholder="Dil..." type="text" required>
                            <input name="afis" placeholder="Afiş..." type="text" required>
                            <input type="reset" value="Temizle"/>
                            <input type="submit" name="srC2submit" value="Güncelle"/>
                        </form>
                    </div>
                    <div class="mainCsoon" id="slide-28">
                        <form action="sendMovie.php" method="post">
                            <h2>3</h2>
                            <input name="sentDivID" type="text" value="slide-28" style="display: none;">
                            <input name="sid" type="text" value="car3" style="display: none;">
                            <input name="fid" type="text" value="3" style="display: none;">
                            <input name="tur" placeholder="Tür..." type="text" required>
                            <input name="boyut" placeholder="Boyut..." type="text" required>
                            <input name="dil" placeholder="Dil..." type="text" required>
                            <input name="afis" placeholder="Afiş..." type="text" required>
                            <input type="reset" value="Temizle"/>
                            <input type="submit" name="srC3submit" value="Güncelle"/>
                        </form>
                    </div>
                    <div class="mainCsoon" id="slide-29">
                        <form action="sendMovie.php" method="post">
                            <h2>4</h2>
                            <input name="sentDivID" type="text" value="slide-29" style="display: none;">
                            <input name="sid" type="text" value="car4" style="display: none;">
                            <input name="fid" type="text" value="4" style="display: none;">
                            <input name="tur" placeholder="Tür..." type="text" required>
                            <input name="boyut" placeholder="Boyut..." type="text" required>
                            <input name="dil" placeholder="Dil..." type="text" required>
                            <input name="afis" placeholder="Afiş..." type="text" required>
                            <input type="reset" value="Temizle"/>
                            <input type="submit" name="srC4submit" value="Güncelle"/>
                        </form>
                    </div>
                    <div class="mainCsoon" id="slide-30">
                        <form action="sendMovie.php" method="post">
                            <h2>5</h2>
                            <input name="sentDivID" type="text" value="slide-30" style="display: none;">
                            <input name="sid" type="text" value="car5" style="display: none;">
                            <input name="fid" type="text" value="5" style="display: none;">
                            <input name="tur" placeholder="Tür..." type="text" required>
                            <input name="boyut" placeholder="Boyut..." type="text" required>
                            <input name="dil" placeholder="Dil..." type="text" required>
                            <input name="afis" placeholder="Afiş..." type="text" required>
                            <input type="reset" value="Temizle"/>
                            <input type="submit" name="srC5submit" value="Güncelle"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if ($_SESSION["sectionSelector"] == 1) {
    echo '<script>document.getElementById("cwtab").click()</script>';
}
if ($_SESSION["sectionSelector"] == 2) {
    echo '<script>document.getElementById("srtab").click()</script>';
}
if(count($_SESSION["justSent"]) >= 1) {
    for($i=0;$i<count($_SESSION["justSent"]);$i++){
        echo '<script>document.getElementById("'.$_SESSION["justSent"][$i].'").style.backgroundColor = "#FFE6B0";</script>';
    }
}
?>
<?php endif ?>
</body>
</html>
