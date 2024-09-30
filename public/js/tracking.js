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