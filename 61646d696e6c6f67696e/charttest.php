<html>
   <head> 
      <title>Hide a data in Doughnut/Pie Datasets</title> 
      <meta name="viewport" content="width=device-width, initial-scale=1"> 
      <script type="text/javascript">
    window.onload=function(){/*from   w w w  .  j  a va2 s .c om*/
/** Watch carefully,
If you set one 'undefined' values on any of the dataset, it will result in the labels being crossed (or strikethrough). This means that if you only use one dataset, and you don't want the labels being shown in the chart and getting the labels crossed you want to set the values to 'undefined'.
Null values will get you same result *without* the labels being crossed.
So you want to use 'undefined' values if you would like to cross the label and hide the data, and you want to use 'null' values if you would like to just hide the data without getting the labels crossed.
Try to play around with it and use it as you like.
*/
var ctx = document.getElementById("myDoughnut").getContext("2d");
var myChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Red", "Green", "Blue"],
    datasets: [{
      label: '# of Votes',
      data: [0, 3, undefined],
      // Play around with null and undefined values and see the difference on how the Chart reacts.
      backgroundColor: [
        '#f87979',
        '#79f879',
        '#7979f8'
      ],
      borderWidth: 5
    }, {
      label: '# of Votes',
      data: [null, 19, undefined],
      // Play around with null and undefined values and see the difference on how the Chart reacts.
      backgroundColor: [
        '#f87979',
        '#79f879',
        '#7979f8'
      ]
    }]
  },
  options: {
    tooltips: {
      mode: null
    },
    plugins: {
      datalabels: {
        borderWidth: 5,
        borderColor: "white",
        borderRadius: 8,
        // color: 0,
        font: {
          weight: "bold"
        },
        backgroundColor: "lightgray"
      }
    }
  }
});
    }

      </script> 
   </head> 
   <body> 
      <div id="app"> 
         <div width="400"> 
            <canvas id="myDoughnut"></canvas> 
         </div> 
      </div> 
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script> 
      <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.4.0/dist/chartjs-plugin-datalabels.js"></script> 
      <!-- Made in 21 Nov 2018 --> 
      <!-- with ChartJS 2.7.3 -->  
   </body>
</html>
