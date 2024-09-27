let labels_arr = [];
let input_displays_arr = [];

const cats = document.querySelectorAll('#category');
const input_displays = document.querySelectorAll('.editable');

cats.forEach(val => {
  labels_arr.push(val.innerHTML);
});

input_displays.forEach(val => {
  input_displays_arr.push(val.innerHTML);
});


var ctxBudget = document.getElementById('allocationDonut').getContext('2d');
var budgetChart = new Chart(ctxBudget, {
    type: 'doughnut',
    data: {
        labels: labels_arr,
        datasets: [{
            label: 'allocation',
            data: input_displays_arr,
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