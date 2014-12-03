var randomScalingFactor = function(){ return Math.round(Math.random()*100)};

function getChartLabels() {
    return ["Poniedziałek", "Wtorek", "Środa", "Czwartek", "Piątek", "Sobota", "Niedziela"];
}

function getChartValues() {
    return [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()];
}


function getChartData() {
    return {
        labels : getChartLabels(),
        datasets : [
            {
                label: "My First dataset",
                fillColor : "rgba(220,220,220,0.2)",
                strokeColor : "rgba(220,0,220,1)",
                pointColor : "rgba(220,220,220,1)",
                pointStrokeColor : "#fff",
                pointHighlightFill : "#fff",
                pointHighlightStroke : "rgba(220,220,220,1)",
                data : getChartValues()
            }
        ]
    }
}

function didClickOnCanvas(canvas, event) {
    var calculatedPoint = chartPointForCanvasClickEvent(canvas, event);
    var pointIndex = Math.floor(calculatedPoint.x);
    window.myLine.datasets[0].points[pointIndex].value = calculatedPoint.y;
    window.myLine.update();
    var points = [];
    for (var i = 0; i < window.myLine.datasets[0].points.length; i++) {
        points.push(window.myLine.datasets[0].points[i].value);
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
        data: {points: points},
        type: 'POST'
    });
}


function Point(x, y) {
    this.x = x;
    this.y = y;
}
