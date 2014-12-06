var myChartIndex = 0;
var randomScalingFactor = function(){ return Math.round(Math.random()*100)};

function getUsername() {
    var userName = location.search.split('username=')[1];
    return userName;
}

function getChartLabels() {
    return ["Poniedziałek", "Wtorek", "Środa", "Czwartek", "Piątek", "Sobota", "Niedziela"];
}

function getChartValues(userName) {
    var parameters = {"userName" : userName};
    var chartValues;
    $.ajax({
        type: "POST",
        data: parameters,
        url: "chartDataProvider.php",
        async: false,
        success: function(result) {
            chartValues = JSON.parse(result);
            if (chartValues.length == 0) {
                chartValues = [50,50,50,50,50,50,50];
            }
        }
    });
    return chartValues;
}

function getChartData() {
    var companionNames = getCompanionNames();
    var dataSets = [];

    for (var i = 0; i < companionNames.length; i++) {
        var name = companionNames[i];

        if (name == getUsername())
            myChartIndex = i;

        dataSets.push({
            label: name,
            fillColor : "rgba(220,220,220,0.2)",
            strokeColor : "rgba(220,0,220,1)",
            pointColor : "rgba(220,220,220,1)",
            pointStrokeColor : "#fff",
            pointHighlightFill : "#fff",
            pointHighlightStroke : "rgba(220,220,220,1)",
            data : getChartValues(name)
        })
    }

    return {
        labels: getChartLabels(),
        datasets: dataSets
    }
}

function getCompanionNames() {
    var companionNames;
    $.ajax({
        type: "POST",
        url: "companionNamesProvider.php",
        async: false,
        success: function(result) {
            companionNames = JSON.parse(result);
        }
    });
    return companionNames;
}

/* click events */

function didClickOnCanvas(canvas, event) {
    var calculatedPoint = chartPointForCanvasClickEvent(canvas, event);
    var pointIndex = Math.floor(calculatedPoint.x);
    window.myLine.datasets[myChartIndex].points[pointIndex].value = calculatedPoint.y;
    window.myLine.update();
    var points = [];
    for (var i = 0; i < window.myLine.datasets[myChartIndex].points.length; i++) {
        points.push(window.myLine.datasets[myChartIndex].points[i].value);
    }
    saveToDatabase(points)
}

function chartPointForCanvasClickEvent(canvas, event) {
    var chartX = event.clientX - canvas.offsetLeft;
    chartX = chartX / canvas.width;
    chartX = chartX * 7;

    var chartY = canvas.height - (event.clientY - canvas.offsetTop);
    chartY = chartY / canvas.height;
    chartY = chartY * getChartYMax();
    return new Point(chartX, chartY);
}

function getChartYMax() {
    return 100;
}

function saveToDatabase(points) {
    $.ajax({
        url: 'chartDataInserter.php',
        data: {points: points, userName: getUsername()},
        type: 'POST'
    });
}

function updateResults() {
    
}

/* point class */

function Point(x, y) {
    this.x = x;
    this.y = y;
}
