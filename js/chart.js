var labels= [];
var ourdata = [];
var label = "";
var myLineChart = null;
var http;
function ajaxGiveVisitsData(x){ 
 if(window.XMLHttpRequest){
  http=new XMLHttpRequest();
 }else{
  http=new ActiveXObject("Microsoft.XMLHTTP");
 }
 http.open("GET","visit_api.php?visitPer="+x, true);
 http.send();
 http.onreadystatechange = initChart;
 label = x.charAt(0).toUpperCase() + x.slice(1);;
}

function initChart(){    
 if(http.readyState==4){
    JSON.parse(http.responseText, function(key,value){
        labels.push(key);
        ourdata.push(value);
    });
    labels.pop();
    ourdata.pop();
    ostalo();
 }
}


function ChartUpdate(x){
    
    labels = [];
    ourdata = [];
    //
    // moram rucno da ocistim iframe posto chart functions ne rade kako treba
    //
    var cc = document.getElementById('canvasParent');
    cc.innerHTML = '';
    cc.innerHTML = "<canvas id='myChart' width='800' height='600'></canvas>";

    ajaxGiveVisitsData(x.value);
}
//
//inicijalizacija
//
ajaxGiveVisitsData("week");//year,month,week,day

function ostalo(){
var ctx = document.getElementById("myChart").getContext("2d");
ctx.canvas.width = 800;
ctx.canvas.height = 600;

//
//ajaxom trazi ovo dvoje dole
//

//var label = "Year";
//var labels = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul","Avg","Sep","Oct","Nov","Dec"];
//var ourdata = [252, 592, 830, 814, 562, 555, 405];

var data = {
    labels: labels,
    datasets: [
        {
            label: label,
            fill: false,
            lineTension: 0.1,
            backgroundColor: "rgba(75,192,192,0.4)",
            borderColor: "rgba(75,192,192,1)",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "rgba(75,192,192,1)",
            pointBackgroundColor: "#fff",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(75,192,192,1)",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointHoverBorderWidth: 2,
            pointRadius: 1,
            pointHitRadius: 10,
            data: ourdata,
            spanGaps: false,
        }
    ]
};


myLineChart = new Chart(ctx, {
    type: 'line',
    data: data,
    options: {
        scales: {
            yAxes: [{
                stacked: true
            }]
        }
    }

});
}