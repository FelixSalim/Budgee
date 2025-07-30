// And for a doughnut chart
var ctx = document.getElementById("chart").getContext("2d");
// draw pie chart
var chart = new Chart(ctx, {
    type: 'doughnut',
    data: expenseData,
    options: Options
});

// Switch between expenses and incomes
document.querySelector('.income-expense-selector a[href="#"]').addEventListener('click', function (e) {
    e.preventDefault();
});

document.querySelectorAll('.income-expense-selector a').forEach(function(el) {
    el.addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelectorAll('.income-expense-selector a').forEach(a => a.classList.remove('active-selector'));
        this.classList.add('active-selector');

        if (this.textContent.trim() === 'Expenses') {
            chart.data = expenseData;
            renderLegends(expenseData.labels, expenseData.datasets[0].data, expenseData.datasets[0].backgroundColor);
            updateCenterText(expenseData.datasets[0].data.reduce((a, b) => a + b, 0), 'Total Expense');
        } else {
            chart.data = incomeData;
            renderLegends(incomeData.labels, incomeData.datasets[0].data, incomeData.datasets[0].backgroundColor);
            updateCenterText(incomeData.datasets[0].data.reduce((a, b) => a + b, 0), 'Total Income');
        }
        chart.update();
    });
});