$(function(){
    var date_registration_per_day=[];
    var total_registration_per_day=[];
  
    var totalSmartphones;
  
    var date_earning_per_day=[];
    var total_earning_per_day=[];

    var smartphone_by_modal_names=[];
    var smartphone_by_modal_total=[];

    $.ajax({
        url:'/statistics',
        type:'GET',
        async:false,
        success: function(response){
          $.each(response.registrationPerDay, function(key,val){
              date_registration_per_day.push(val.date);
              total_registration_per_day.push(val.total);
          });
    
          totalSmartphones=response.totalSmartphones;
          
          $.each(response.totalEarningPerDay, function(key,val){
            date_earning_per_day.push(val.date);
            total_earning_per_day.push(val.total);
          });

          $.each(response.smartPhoneByModel, function(key,val){
            smartphone_by_modal_names.push(val.names);
            smartphone_by_modal_total.push(val.total);
          });

        },
        error: function(errors){
          console.log(errors);
        },
    });

    try {
        //WidgetChart 1
        var ctx = document.getElementById("widgetChart1");
        if (ctx) {
          ctx.height = 130;
          var myChart = new Chart(ctx, {
            type: 'line',
            data: {
              labels: date_registration_per_day,
              type: 'line',
              datasets: [{
                data: total_registration_per_day,
                label: 'Dataset',
                backgroundColor: 'rgba(255,255,255,.1)',
                borderColor: 'rgba(255,255,255,.55)',
              },]
            },
            options: {
              maintainAspectRatio: true,
              legend: {
                display: false
              },
              layout: {
                padding: {
                  left: 0,
                  right: 0,
                  top: 0,
                  bottom: 0
                }
              },
              responsive: true,
              scales: {
                xAxes: [{
                  gridLines: {
                    color: 'transparent',
                    zeroLineColor: 'transparent'
                  },
                  ticks: {
                    fontSize: 2,
                    fontColor: 'transparent'
                  }
                }],
                yAxes: [{
                  display: false,
                  ticks: {
                    display: false,
                  }
                }]
              },
              title: {
                display: false,
              },
              elements: {
                line: {
                  borderWidth: 0
                },
                point: {
                  radius: 0,
                  hitRadius: 10,
                  hoverRadius: 4
                }
              }
            }
          });
        }
    
    
        //WidgetChart 2
        var ctx = document.getElementById("widgetChart2");
        if (ctx) {
          ctx.height = 130;
          var myChart = new Chart(ctx, {
            type: 'line',
            data: {
              labels: ['January', 'February', 'March', 'April', 'May', 'June'],
              type: 'line',
              datasets: [{
                data: [1, 18, 9, 17, 34, 22],
                label: 'Dataset',
                backgroundColor: 'transparent',
                borderColor: 'rgba(255,255,255,.55)',
              },]
            },
            options: {
    
              maintainAspectRatio: false,
              legend: {
                display: false
              },
              responsive: true,
              tooltips: {
                mode: 'index',
                titleFontSize: 12,
                titleFontColor: '#000',
                bodyFontColor: '#000',
                backgroundColor: '#fff',
                titleFontFamily: 'Montserrat',
                bodyFontFamily: 'Montserrat',
                cornerRadius: 3,
                intersect: false,
              },
              scales: {
                xAxes: [{
                  gridLines: {
                    color: 'transparent',
                    zeroLineColor: 'transparent'
                  },
                  ticks: {
                    fontSize: 2,
                    fontColor: 'transparent'
                  }
                }],
                yAxes: [{
                  display: false,
                  ticks: {
                    display: false,
                  }
                }]
              },
              title: {
                display: false,
              },
              elements: {
                line: {
                  tension: 0.00001,
                  borderWidth: 1
                },
                point: {
                  radius: 4,
                  hitRadius: 10,
                  hoverRadius: 4
                }
              }
            }
          });
        }
    
    
        //WidgetChart 3
        var ctx = document.getElementById("widgetChart3");
        if (ctx) {
          ctx.height = 130;
          var myChart = new Chart(ctx, {
            type: 'line',
            data: {
              labels: date_registration_per_day,
              type: 'line',
              datasets: [{
                data: total_registration_per_day,
                label: 'Dataset',
                backgroundColor: 'transparent',
                borderColor: 'rgba(255,255,255,.55)',
              },]
            },
            options: {
    
              maintainAspectRatio: false,
              legend: {
                display: false
              },
              responsive: true,
              tooltips: {
                mode: 'index',
                titleFontSize: 12,
                titleFontColor: '#000',
                bodyFontColor: '#000',
                backgroundColor: '#fff',
                titleFontFamily: 'Montserrat',
                bodyFontFamily: 'Montserrat',
                cornerRadius: 3,
                intersect: false,
              },
              scales: {
                xAxes: [{
                  gridLines: {
                    color: 'transparent',
                    zeroLineColor: 'transparent'
                  },
                  ticks: {
                    fontSize: 2,
                    fontColor: 'transparent'
                  }
                }],
                yAxes: [{
                  display: false,
                  ticks: {
                    display: false,
                  }
                }]
              },
              title: {
                display: false,
              },
              elements: {
                line: {
                  borderWidth: 1
                },
                point: {
                  radius: 4,
                  hitRadius: 10,
                  hoverRadius: 4
                }
              }
            }
          });
        }
    
    
        //WidgetChart 4
        var ctx = document.getElementById("widgetChart4");
        if (ctx) {
          ctx.height = 115;
          var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
              labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
              datasets: [
                {
                  label: "My First dataset",
                  data: [78, 81, 80, 65, 58, 75, 60, 75, 65, 60, 60, 75],
                  borderColor: "transparent",
                  borderWidth: "0",
                  backgroundColor: "rgba(255,255,255,.3)"
                }
              ]
            },
            options: {
              maintainAspectRatio: true,
              legend: {
                display: false
              },
              scales: {
                xAxes: [{
                  display: false,
                  categoryPercentage: 1,
                  barPercentage: 0.65
                }],
                yAxes: [{
                  display: false
                }]
              }
            }
          });
        }
    
        // Recent Report
        const brandProduct = 'rgba(0,181,233,0.8)'
        const brandService = 'rgba(0,173,95,0.8)'
    
        var elements = 10
        var data1 = [52, 60, 55, 50, 65, 80, 57, 70, 105, 115]
        var data2 = [102, 70, 80, 100, 56, 53, 80, 75, 65, 90]
    
        var ctx = document.getElementById("recent-rep-chart");
        if (ctx) {
          ctx.height = 250;
          var myChart = new Chart(ctx, {
            type: 'line',
            data: {
              labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', ''],
              datasets: [
                {
                  label: 'My First dataset',
                  backgroundColor: brandService,
                  borderColor: 'transparent',
                  pointHoverBackgroundColor: '#fff',
                  borderWidth: 0,
                  data: data1
    
                },
                {
                  label: 'My Second dataset',
                  backgroundColor: brandProduct,
                  borderColor: 'transparent',
                  pointHoverBackgroundColor: '#fff',
                  borderWidth: 0,
                  data: data2
    
                }
              ]
            },
            options: {
              maintainAspectRatio: true,
              legend: {
                display: false
              },
              responsive: true,
              scales: {
                xAxes: [{
                  gridLines: {
                    drawOnChartArea: true,
                    color: '#f2f2f2'
                  },
                  ticks: {
                    fontFamily: "Poppins",
                    fontSize: 12
                  }
                }],
                yAxes: [{
                  ticks: {
                    beginAtZero: true,
                    maxTicksLimit: 5,
                    stepSize: 50,
                    max: 150,
                    fontFamily: "Poppins",
                    fontSize: 12
                  },
                  gridLines: {
                    display: true,
                    color: '#f2f2f2'
    
                  }
                }]
              },
              elements: {
                point: {
                  radius: 0,
                  hitRadius: 10,
                  hoverRadius: 4,
                  hoverBorderWidth: 3
                }
              }
    
    
            }
          });
        }
    
        // Percent Chart
        var ctx = document.getElementById("percent-chart");
        if (ctx) {
          ctx.height = 280;
          var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
              labels: smartphone_by_modal_names,
              datasets: [
                {
                  label: "My First dataset",
                  data: smartphone_by_modal_total,
                  backgroundColor: [
                    '#00b5e9',
                    '#fa4251',
                    '#ffe256'
                  ],
                  hoverBackgroundColor: [
                    '#00b5e9',
                    '#fa4251',
                    '#ffe256'
                  ],
                  borderWidth: [
                    0, 0
                  ],
                  hoverBorderColor: [
                    'transparent',
                    'transparent'
                  ]
                }
              ],
            },
            options: {
              maintainAspectRatio: false,
              responsive: true,
              cutoutPercentage: 55,
              animation: {
                animateScale: true,
                animateRotate: true
              },
              legend: {
                display: true,
                position:'right'
              },
              tooltips: {
                titleFontFamily: "Poppins",
                xPadding: 15,
                yPadding: 10,
                caretPadding: 0,
                bodyFontSize: 16
              }
            }
          });
        }
    
      } catch (error) {
        console.log(error);
      }
    
});