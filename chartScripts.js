var randomScalingFactor = function(){ return Math.round(Math.random()*100)};

function getChartLabels() {
    return ["Poniedziałek", "Wtorek", "Środa", "Czwartek", "Piątek", "Sobota", "Niedziela"];
}

function getChartValues() {
    return [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()];
}


function getChartData() {
    var lineChartData = {
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
    return lineChartData;
}