
  var myChart;
  
  
  $(function() {
    fetchData('monthly');
  });
  
  $("#button-daily").click(function() {
    fetchData('daily');
  });
  $("#button-weekly").click(function() {
    fetchData('weekly');
  });
  $("#button-monthly").click(function() {
    fetchData('monthly');
  });

  function reFormatDate(date)
  {
   if(date.length == 10)
   {
    date = new Date(date);
    var month = ("0" + (date.getMonth() + 1)).slice(-2);
    var day = ("0" + date.getDate()).slice(-2);
    var year = ("0" + date.getFullYear()).slice(-2);
    return `${day}/${month}/${year}`;
   }
   if(date.length > 20)
   {
     date1= date.split(":")[0];
     date2 = date.split(":")[1];
     
    date1 = new Date(date1);
    date2 = new Date(date2);
  
    var month1 = ("0" + (date1.getMonth() + 1)).slice(-2);
    var day1 = ("0" + date1.getDate()).slice(-2);
    var year1 = ("0" + date1.getFullYear()).slice(-2);
  
    var month2 = ("0" + (date2.getMonth() + 1)).slice(-2);
    var day2 = ("0" + date2.getDate()).slice(-2);
    var year2 = ("0" + date2.getFullYear()).slice(-2);
    return `${day1}/${month1}/${year1}:${day2}/${month2}/${year2}`;
   }
   return date;
  }

function fetchData(period)
{   
    $("#spinner").show();

  if(myChart)
  {
    myChart.destroy();
  }
  
  daily_button = document.getElementById("button-daily");
  weekly_button = document.getElementById("button-weekly");
  monthly_button = document.getElementById("button-monthly");

  if(period == 'monthly')
  {
    monthly_button.classList.add("active");
    daily_button.classList.remove("active");
    weekly_button.classList.remove("active");
    res = fetch('/api/stats/monthly/jk')
  .then(response => response.json())
  .then(data => showMonthlyChart(data));
  }
  else if(period == 'weekly')
  {
    weekly_button.classList.add("active");
    monthly_button.classList.remove("active");
    daily_button.classList.remove("active");

    res = fetch('/api/stats/weekly/jk')
  .then(response => response.json())
  .then(data => showWeeklyChart(data));
  }
  else
  {
    daily_button.classList.add("active");
    weekly_button.classList.remove("active");
    monthly_button.classList.remove("active");
    res = fetch('/api/stats/daily/jk')
  .then(response => response.json())
  .then(data => showDailyChart(data));
  }

}

function showDailyChart(data)
{
    $("#spinner").hide();
  recovered = [];
  deaths =[];
  postives = [];
  dates = [];

  data['data'].forEach(element => {
    date = reFormatDate(element['date']);
    dates.push(date);
    postives.push(element['postive']);
    recovered.push(element['recovered']);
    deaths.push(element['deaths']);
  });

  myChart = new Chart(document.getElementById("line-chart"), {
  type: 'line',
  data: {
    labels: dates,
    datasets: [{ 
        data: recovered,
        label: "Recovered",
        borderColor: "green",
        fill: false
      }, { 
        data: deaths,
        label: "Deaths",
        borderColor: "red",
        fill: false
      }, { 
        data: postives,
        label: "Postives",
        borderColor: "blue",
        fill: false
      }
    ]
  },
  options: {
    responsive: true,
    maintainAspectRatio:false,
    interaction:
     {
       mode: 'index'
      },
    plugins: {
        title: {
            display: true,
            text: 'Daily Covid Cases of JK',
            font: {
                size: 12
            }
        },
        tooltips: 
          {
          mode: 'index',
          intersect: false,
          },
          hover: 
          {
          mode: 'nearest',
          intersect: true
          }
        
    }
}
});
}

function showWeeklyChart(data)
{
    $("#spinner").hide();
  recovered = [];
  deaths =[];
  postives = [];
  dates = [];

  data['data'].forEach(element => {
    week = element['week'];
    week = reFormatDate(week);
    dates.push(week);
    postives.push(element['postive']);
    recovered.push(element['recovered']);
    deaths.push(element['deaths']);
  });

 myChart = new Chart(document.getElementById("line-chart"), {
  type: 'line',

  data: {
    labels: dates,
    datasets: [{ 
        data: recovered,
        label: "Recovered",
        borderColor: "green",
        fill: false
      }, { 
        data: deaths,
        label: "Deaths",
        borderColor: "red",
        fill: false
      }, { 
        data: postives,
        label: "Postives",
        borderColor: "blue",
        fill: false
      }
    ]
  },
  options: {
    responsive: true,
    maintainAspectRatio:false,
    interaction:
     {
       mode: 'index'
      },
   
    plugins: {
        title: {
            display: true,
            text: 'Weekly Covid Cases of JK',
            font: {
                size: 12
            }
        },
        tooltips: 
          {
          mode: 'index',
          intersect: false,
          },
          hover: 
          {
          mode: 'nearest',
          intersect: true
          }
        
    }
}
});
}


function showMonthlyChart(data)
{
    $("#spinner").hide();
  recovered = [];
  deaths =[];
  postives = [];
  dates = [];

  data['data'].forEach(element => {
    dates.push(element['month']);
    postives.push(element['postive']);
    recovered.push(element['recovered']);
    deaths.push(element['deaths']);
  });

 myChart=  new Chart(document.getElementById("line-chart"), {
  type: 'line',
  data: {
    labels: dates,
    datasets: [{ 
        data: recovered,
        label: "Recovered",
        borderColor: "green",
        fill: false
      }, { 
        data: deaths,
        label: "Deaths",
        borderColor: "red",
        fill: false
      }, { 
        data: postives,
        label: "Postives",
        borderColor: "blue",
        fill: false
      }
    ]
  },
  options: {
    responsive: true,
    maintainAspectRatio:false,
    interaction:
     {
       mode: 'index'
      },
    plugins: {
        title: {
            display: true,
            text: 'Monthly Covid Cases of JK',
            font: {
                size: 12
            }
        },
        tooltips: 
          {
          mode: 'index',
          intersect: false,
          },
          hover: 
          {
          mode: 'nearest',
          intersect: true
          }
        
    }
}
});
}
