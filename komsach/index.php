<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <script type="text/javascript">
      let timerId = setInterval(() => {
        if ((document.getElementById('siteName').innerHTML == "КОМSАЧ | Главная") || (document.getElementById('siteName').innerHTML == "КОМSАЧ | Юность")) {
          document.getElementById('siteName').innerHTML = "КОМSАЧ | Мемы";
        } else if (document.getElementById('siteName').innerHTML == "КОМSАЧ | Мемы") {
          document.getElementById('siteName').innerHTML = "КОМSАЧ | Комса";
        } else if (document.getElementById('siteName').innerHTML == "КОМSАЧ | Комса") {
          document.getElementById('siteName').innerHTML = "КОМSАЧ | Юность";
        }
      }, 1000);
    </script>

    <title id="siteName">КОМSАЧ | Главная</title>
  </head>


  <?php
   $token = 'appTokenHere';

   $request_params = array(
     'group_id' => '68473974',
     'fields' => 'members_count',
     'access_token' => $token,
     'v' => '5.130'
   );

   $get_params = http_build_query($request_params);
   $members = json_decode(file_get_contents('https://api.vk.com/method/groups.getById?'. $get_params))->response[0]->members_count;

   $text = substr_replace($members, ' ',2,0);
  ?>


  <body>

    <div class="content">

      <div class="title">КОМSАЧ</div>

      <div class="flex">

        <div>
          <div class="header" id="header-first">Мемы. Комса. Юность.</div>
          <div class="desc">
            Эти слова тебе о чём-то говорят?<br>
            Скорей подписывайся на наше<br>
            сообщество — не пожалеешь!
          </div>
          <a href="https://vk.com/failkms"><div class="button-blue">Подписаться ВКонтакте</div></a>
        </div>

        <div>
          <div class="flex-img subs">
            <div class="img-center">
              <img src="/img/1.jpg" class="flex-jpg">
              <img src="/img/4.jpg" class="flex-jpg">
            </div>
            <div>
              <img src="/img/2.jpg" class="flex-jpg">
              <img src="/img/5.jpg" class="flex-jpg" title="">
              <img src="/img/7.jpg" class="flex-jpg">
            </div>
            <div class="img-center">
              <img src="/img/3.jpg" class="flex-jpg">
              <img src="/img/6.jpg" class="flex-jpg">
            </div>
          </div>
          <div class="trigger">
            Нас уже&#8194;<span class="counter"><?php echo($text) ?></span>&#8194;человек
          </div>
        </div>

      </div>

    </div>

    <!-- <img src="/img/wave.jpg" class="wave"> -->

  </body>



</html>
