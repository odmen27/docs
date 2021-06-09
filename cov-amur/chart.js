/*  Экспериментировал с графиками. В более поздних версиях подключил MySQL,
    а в самом сервисе добавил форму для добавления новых данных в БД. */

var today = 0;
var recovered = 6;

var home = 45;
var hospital = 71;
var reanimation = 0;
var contact = 27;

var total = home + hospital;
var pneumonia = 177;


document.getElementById('total').innerHTML = total;
document.getElementById('contact').innerHTML = contact;

if(today == 0) {
  document.getElementById('today').innerHTML = 'ни одного';
} else {
  document.getElementById('today').innerHTML = today;
}

var conditionCount = [home,(hospital - reanimation),reanimation];

var main = document.getElementById('month').getContext('2d');
var chart = new Chart(main, {
  // The type of chart we want to create
  type: 'line',
  data: {
      labels: [ /* даты из БД */ ],
      datasets: [{
          label: 'COVID-19',
          backgroundColor: 'rgba(245, 67, 53, 0.2)',
          borderColor: 'rgb(245, 67, 53)',
          data: [42,
                 39,39,37,38,35,33,43,43,
                 43,42,39,40,40,40,40,40,
                 38,28,28,28,64,64,60,58,
                 90,97,104,104,104,110,112,116,
                 126,123,116]
      },{
          label: 'Пневмония',
          backgroundColor: 'rgba(53, 108, 245, 0.2)',
          borderColor: 'rgb(53, 108, 245)',
          data: [36,
                 36,38,40,43,42,39,43,43,
                 43,53,60,60,59,61,61,61,
                 77,96,96,96,101,101,102,111,
                 111,121,121,121,121,141,160,175,
                 172,180,177]
      }]
  },
  options: {}
});



var ctx = document.getElementById('condition').getContext('2d');
var myPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    datasets: [{
        data: conditionCount,
        backgroundColor: [
          'rgb(133, 222, 32)',
          'rgb(255, 186, 2)',
          'rgb(245, 67, 53)'
        ]
    }],

    labels: ['Амбулаторное леч.','Госпитализированы', 'В реанимации']
  },
  options: {
    legend: {
      position: "right"
    }
  }
});

var yold = document.getElementById('yold').getContext('2d');
var myBarChart = new Chart(yold, {
  type: 'horizontalBar',
  data: {
    datasets: [{
      data: [3,45.6,23.4,28],
      backgroundColor: [
        'rgba(53, 108, 245, 0.75)',
        'rgba(133, 222, 32, 0.75)',
        'rgba(255, 186, 2, 0.75)',
        'rgba(245, 67, 53, 0.75)'
      ]
    }],
    labels: ['18-25 лет','30-49 лет','50-55 лет','старше 65']
  },
  options: {
    legend: {
      display: false
    }
  }
});
