// PROCESS 1: SORT INTO THE SPECIFIED FILTER
let labels = [];

let track_expense_arr = [];
let track_expense_cats = [];

let track_income_arr = [];
let track_income_cats = [];

const track_expense = document.querySelectorAll('#expense-line');

const track_income = document.querySelectorAll('#income-line');

if (window.location.pathname === "/SmartBudget/dashboard" ||
    window.location.pathname === "/SmartBudget/dashboard/yearly"){
    labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December',];

    track_expense.forEach(val => {
        track_expense_arr.push([`${val.className}`, `${val.innerHTML}`])
        track_expense_cats.push(val.className)
    });
    
    track_income.forEach(val => {
        track_income_arr.push([`${val.className}`, `${val.innerHTML}`])
        track_income_cats.push(val.className)
    });
    
    console.log(track_expense_arr);
}
else if (window.location.pathname === "/SmartBudget/dashboard/weekly"){
    labels = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday',];

    track_expense.forEach(val => {
        track_expense_arr.push([`${val.className}`, `${val.innerHTML}`])
        track_expense_cats.push(val.className)
        console.log([val.className, val.innerHTML]);
    });
    
    track_income.forEach(val => {
        track_income_arr.push([`${val.className}`, `${val.innerHTML}`])
        track_income_cats.push(val.className)
    });
    
}
else if (window.location.pathname === "/SmartBudget/dashboard/monthly"){
    let count= 1;
    while (count <= 31) { 
        labels.push(count);
        count++;
    }

    track_expense.forEach(val => {
        track_expense_arr.push([`${val.className}`, `${val.innerHTML}`])
        track_expense_cats.push(val.className)
        console.log([val.className, val.innerHTML]);
    });
    
    track_income.forEach(val => {
        track_income_arr.push([`${val.className}`, `${val.innerHTML}`])
        track_income_cats.push(val.className)
    });
}

// PROCESS 2: RETRIEVE THE DATA FROM THE HIDDEN HTML TAGS AND PROCESS THEM


// STEP 3: DISPLAY THE CREATED INFORMATION
var ctxLine = document.getElementById('lineChart').getContext('2d');
var lineChart = new Chart(ctxLine, {
type: 'line',
data: {
    labels: labels,
    datasets: [
        {
            label: ['Expense'],
            data: track_expense_arr,
            backgroundColor: 'rgba(126, 217, 87, 0.5)', 
            fill: true
        },
        {
            label: ['Income'],
            data: track_income_arr,
            backgroundColor: 'rgba(57, 139, 43, 0.5)', 
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

// Expense Donut Chart
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

if(document.getElementById('budgetChart')) {
    var ctxBudget = document.getElementById('budgetChart').getContext('2d') || null;    

    var budgetChart = new Chart(ctxBudget, {
        type: 'doughnut',
        data: {
            labels: expense_data_category,
            datasets: [{
                label: 'expenses',
                data: expense_data,
                backgroundColor: [
                'green', // rent
                'red', // debt/loan
                'indigo', // mobile
                'gray', // others
                'blue', // rent
                'yellow', // savings
                'orange', // school
                'purple', // shopping
                'darkorange' // transportation
    
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
}

// Income Donut Chart

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

if(document.getElementById('incomeChart')) {
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
}