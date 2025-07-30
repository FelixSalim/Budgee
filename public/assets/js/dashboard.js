// And for a doughnut chart
var ctx = document.getElementById("chart").getContext("2d");
// draw pie chart
var chart = new Chart(ctx, {
    type: 'doughnut',
    data: expenseChartData,
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
            chart.data = expenseChartData;
            renderLegends(expenseData);
            updateCenterText(expenseData.reduce((a, b) => a + b.total, 0), 'Total Expense');
        } else {
            chart.data = incomeChartData;
            renderLegends(incomeData);
            updateCenterText(incomeData.reduce((a, b) => a + b.total, 0), 'Total Income');
        }
        chart.update();
    });
});