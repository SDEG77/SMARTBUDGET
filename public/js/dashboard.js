const sum = (...numbers) => {
  return numbers.reduce((accumulator, currentValue) => accumulator + currentValue, 0);
};

let expense_data = [];
let expense_data_category = [];

let expense_totals = document.querySelectorAll('#expenseTotal');
let expense_cats = document.querySelectorAll('#expenseCategory');

expense_totals.forEach(exp => {
    expense_data.push(exp.innerHTML.replace(/,/g, '')) //regex remove comma
});

expense_cats.forEach(exp => {
    expense_data_category.push(exp.innerHTML.replace(/,/g, '')) //regex remove comma
});

///////////////////////////////////////////////////////////////

let income_data = [];
let income_data_category = [];

let income_totals = document.querySelectorAll('#incomeTotal');
let income_cats = document.querySelectorAll('#incomeCategory');

income_totals.forEach(exp => {
    income_data.push(exp.innerHTML.replace(/,/g, '')) //regex remove comma
});

income_cats.forEach(exp => {
    income_data_category.push(exp.innerHTML.replace(/,/g, '')) //regex remove comma
});

//////////////////////////////////////////////////////
let track_expense_arr = [];
let track_income_arr = [];

const track_expense = document.querySelectorAll('#track_expense');
const track_income = document.querySelectorAll('#track_income');

track_expense.forEach(val => {
  track_expense_arr.push(val.innerHTML)
});

track_income.forEach(val => {
  track_income_arr.push(val.innerHTML)
});

let check = track_expense_arr.length > track_income_arr.length ? track_expense_arr.length : track_income_arr.length;
let genrerateLabel = [];

while(check) {
  genrerateLabel.push('WIP')
  check -= 1;
}

var ctxLine = document.getElementById('lineChart').getContext('2d');
var lineChart = new Chart(ctxLine, {
type: 'line',
data: {
    labels: genrerateLabel,
    datasets: [
        {
            label: ['Expenses'],
            data: [...track_expense_arr],
            backgroundColor: 'rgba(126, 217, 87, 0.5)', // Light coral orange
            fill: true
        },
        {
            label: ['Income'],
            data: [...track_income_arr],
            backgroundColor: 'rgba(69, 168, 52, 0.5)', // Light coral orange
            fill: true
        },
        // {
        //     label: ['Balance'],
        //     data: [14, 34, 22, 5, 20, 30, 15],
        //     backgroundColor: 'rgba(33, 104, 80, 0.5)', // Light coral orange
        //     fill: true
        // }
    ],
},
options: {
    responsive: true,
    plugins: {
        legend: {
            display: true,
            position: 'top'
        },
        tooltip: {
            callbacks: {
                label: function(tooltipItem) {
                    return tooltipItem.label + ': ' + tooltipItem.raw;
                }
            }
        }
    },
    scales: {
        x: {
            beginAtZero: true
        },
        y: {
            beginAtZero: true
        }
    }
}
});


var ctxBudget = document.getElementById('budgetChart').getContext('2d');
var budgetChart = new Chart(ctxBudget, {
    type: 'doughnut',
    data: {
        labels: expense_data_category,
        datasets: [{
            label: 'expenses',
            data: expense_data,
            backgroundColor: [
            '#4C6F4C', '#3E5E3E', '#2F4E2F', '#1F3D1F', '#1A341A',
'#1E5A1E', '#2B6F2B', '#275B27', '#1E4A1E'

            ]
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false,
                position: 'top'
            },
            tooltip: {
                callbacks: {
                    label: function(tooltipItem) {
                        return tooltipItem.label + ': ' + tooltipItem.raw;
                    }
                }
            }
        }
    }
});

var ctxIncome = document.getElementById('incomeChart').getContext('2d');
var incomeChart = new Chart(ctxIncome, {
    type: 'doughnut',
    data: {
        labels: income_data_category,
        datasets: [{
            label: 'Income',
            data: income_data,
            backgroundColor: [
                '#1D8B1D', '#1A7A1A', '#166C16', '#145C14', '#0F4A0F'
            ]
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false,
                position: 'top'
            },
            tooltip: {
                callbacks: {
                    label: function(tooltipItem) {
                        return tooltipItem.label + ': ' + tooltipItem.raw;
                    }
                }
            }
        }
    }
});