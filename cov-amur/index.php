<!--Экспериментировал с графиками. В более поздних версиях подключил MySQL,
    а в самом сервисе добавил форму для добавления новых данных в БД. -->

<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans+Narrow:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@700&display=swap" rel="stylesheet">

    <script src="https://unpkg.com/@vkontakte/vk-bridge@2.2.2/dist/browser.min.js"></script>
    <script type="text/javascript"> vkBridge.send("VKWebAppInit", {}); </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>COVID-на-Амуре</title>
  </head>

  <body>

    <div class="header">
      <div class="headerInside">
        <div class="title">COVID-на-Амуре</div>
      </div>
    </div>

    <div class="content">

      <div class="block">
        <h1>Статистика за июнь 2020 г.</h1>
        <p class="desc">Обновлено 19.06.2020 в 13:00</p>
        <canvas id="month"></canvas>
      </div>

      <div class="delimiter">

        <div class="block">
          <div class="activeCase">
            <span class="count" id="total">0</span>
            <div class="desc">
              пациентов с COVID-19,<br>
              из которых <b id="today">0</b> за последние сутки.
            </div>
          </div>
        </div>

        <div class="block">
          <h2>Состояние пациентов</h2>
          <canvas id="condition"></canvas>
        </div>

      </div>

      <div class="delimiter">
        <div class="block">
          <h2 id="hYold">Возрастные группы</h2>
          <p class="desc">% от числа заражённых</p>
          <canvas id="yold"></canvas>
        </div>

        <div class="block">
          <div class="activeCase">
            <span class="count" id="contact">0</span>
            <div class="desc">
              человек, контактных<br>
              или с подозрением на COVID-19
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>

  <script src="chart.js"></script>

</html>
