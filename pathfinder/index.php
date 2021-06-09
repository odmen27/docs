<!-- В прошлом месяце понадобилось узнать список друзей в закрытом профиле
     ВКонтакте. Накидал такую программку.

     Задаётся список ID сообществ, в которых может состоять человек.
     Среди участников ищутся те, у кого этот юзер в друзьях.
     Наткнулся на ограничения по количеству запросов, но это не проблема —
     необходимый список друзей юзера я получил. -->

<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <title>Pathfinder</title>
    <script src="https://vk.com/js/api/xd_connection.js?2"  type="text/javascript"></script>
  </head>


  <script type="text/javascript">
    VK.init(function() {
       // API initialization succeeded

       var pool = []; var search = [];
       var club = [184016872];
       var head = 374811416;
       var headFriend = [];
       var offset = 0;
       var count = [];

       VK.api("groups.getMembers", {"group_id": club[0], "v":"5.130"}, function (data) {
         count[0] = data.response.count;
         console.log("count: "+count[0]);
       });

       setTimeout(() => {
         console.log(count);
         i = 0;

         let timer = setInterval(() => {
           if (offset < count[i]) {
             console.log("club["+i+"] "+count[i]+" / "+offset);

             VK.api("groups.getMembers", {"group_id":club[i],"offset":offset, "v":"5.130"}, function (data2) {

               console.log("LOG: club["+i+"] / "+offset);

               for (var k = 0; k < data2.response.items.length; k++) {
                 pool.push(data2.response.items[k]);
                 document.getElementById('allUsers').innerHTML = pool.length;
               }

             });
             offset+=1000;
           } else if(i < club.length) {
             i++;
             offset=0;
           } else {
             clearInterval(timer);
             setTimeout(() => {
               console.log("Ready! ("+pool.length+")");
               console.log(pool);
               k = 0; i = 0;

               let friends = setInterval(() => {
                 if(k < pool.length) {
                   VK.api("friends.get", {"user_id":pool[k],"v":"5.130"}, function (data) {
                     console.log(data);
                     console.log("["+k+" / "+pool.length+"] "+data.response.count+" друзей");
                     for (i = 0; i < data.response.items.length; i++) {
                       if (data.response.items[i] == head) {
                         headFriend.push(pool[k-1]);
                         console.log("Друг найден! - vk.com/id"+pool[k-1]);
                         console.log(data);
                       }
                     }
                   });
                   k++;
                 } else {
                   clearInterval(friends);
                   console.log("Найдено "+headFriend.length+" друзей");
                   console.log(headFriend);
                   for (i = 0; i < headFriend.length; i++) {
                     var n = i+1;
                     console.log(n+". vk.com/id"+headFriend[i]);
                   }
                 }
               }, 500);
             }, 5000);
           }
         }, 350);
       }, 5000);

    }, function() {
       // API initialization failed
  }, '5.130');
  </script>


  <body>
    Всего проверено <span id="allUsers">0</span> пользователей
  </body>

</html>
