
  var myChart;
  
  
  $(function() {
    fetchData('daily');
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
    res = fetch('http://localhost:8000/api/stats/monthly/jk')
  .then(response => response.json())
  .then(data => showMonthlyChart(data));
  }
  else if(period == 'weekly')
  {
    weekly_button.classList.add("active");
    monthly_button.classList.remove("active");
    daily_button.classList.remove("active");

    res = fetch('http://localhost:8000/api/stats/weekly/jk')
  .then(response => response.json())
  .then(data => showWeeklyChart(data));
  }
  else
  {
    daily_button.classList.add("active");
    weekly_button.classList.remove("active");
    monthly_button.classList.remove("active");
    res = fetch('http://localhost:8000/api/stats/daily/jk')
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
    dates.push(element['date']);
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
    plugins: {
        title: {
            display: true,
            text: 'Daily Covid Cases of JK',
            font: {
                size: 18
            }
        },
        
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
    dates.push(element['week']);
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
    plugins: {
        title: {
            display: true,
            text: 'Weekly Covid Cases of JK',
            font: {
                size: 18
            }
        },
        
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
    plugins: {
        title: {
            display: true,
            text: 'Monthly Covid Cases of JK',
            font: {
                size: 18
            }
        },
        
    }
}
});
}
