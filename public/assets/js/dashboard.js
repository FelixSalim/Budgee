var Data = {
    labels: ['Food', 'Groceries', 'Education'],
    datasets: [{
        data: [650000, 455000, 195000],
        backgroundColor: [
            '#AA9900',
            '#AA007D',
            '#4F00AA'
        ],
    }]
}

var Options = {
    plugins: {
        legend: {
            display: false
        },
        tooltip: {
            enabled: true,
            callbacks: {
                label: function(tooltipItem) {
                    return tooltipItem.label + ': Rp' + tooltipItem.raw.toLocaleString();
                }
            }
        }
    },
    cutout: '70%',
    responsive: true,
    maintainAspectRatio: false,
}

// And for a doughnut chart
var chart = document.getElementById("chart").getContext("2d");
// draw pie chart
new Chart(chart, {
    type: 'doughnut',
    data: Data,
    options: Options
});