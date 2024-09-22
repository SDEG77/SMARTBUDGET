<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
</head>
<body>
    <div class="container">
        <div class="side-nav">
            <div class="menu-sidebar">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
                <ul>
                    <h4>Menu</h4>
                    <a href="{{ route('dashboard') }}">
                        <li class="{{ Request::is('SmartBudget/dashboard') ? 'active' : '' }}">
                        <i class="fa-solid fa-house" alt="Home Icon"></i>
                            <span class="label">Home</span>
                        </li>
                    </a>
                    <a href="{{ route('tracking') }}">
                        <li class="{{ Request::is('SmartBudget/tracking') ? 'active' : '' }}">
                        <i class="fa-solid fa-clock-rotate-left" alt="Track Icon"></i>
                            <span class="label">Tracker</span>
                        </li>
                    </a>
                    <a href="{{ route('ledger') }}">
                        <li class="{{ Request::is('SmartBudget/ledger') ? 'active' : '' }}">
                        <i class="fa-regular fa-star" alt="Ledger Icon"></i>
                            <span class="label">Ledger</span>
                        </li>
                    </a>
                    <a href="{{ route('planner') }}">
                        <li class="{{ Request::is('SmartBudget/planner') ? 'active' : '' }}">
                        <i class="fa-solid fa-calendar-days" alt="Planner Icon"></i>
                            <span class="label">Planner</span>
                        </li>
                    </a>
                    <a href="{{ route('about') }}">
                        <li class="{{ Request::is('SmartBudget/about') ? 'active' : '' }}">
                        <i class="fa-solid fa-circle-info" alt="About Icon"></i>
                            <span class="label">About</span>
                        </li>
                    </a>
                </ul>
                <div class="down-sidebar">
                    <form action="{{route('account.logout')}}" method="POST">
                        @csrf
                        <button type="submit" onclick="e.preventDefault(); this.closest('form').submit()">
                            <li class="{{ Request::is('SmartBudget/welcome') ? 'active' : '' }}">
                            <i class="fa-solid fa-right-from-bracket" alt="Logout Icon"></i>
                            <span class="label">Log out</span>
                            </li>
                        </button>
                    </form>
                    <a href="{{ route('account.profile') }}">
                        <li class="{{ Request::is('SmartBudget/account/profile') ? 'active' : '' }}">
                            <img src="{{asset('images/user.png')}}" alt="Profile Picture" class="profile-sidebar-img">
                            <span class="label">Profile</span>
                        </li>
                    </a>
                </div>
            </div>
        </div>


        <div class="main-frame">
            <p1>DASHBOARD</p1>
            <div class="analysis-frame">
                <div class="flow-frame">
                    <div class="result-frame">
                        <div class="result-item">
                            <p3>Total Expenses</p3><br>
                            <p4>30,000.00</p4>
                            <div class="box-container">
                            </div>
                        </div>
                        <div class="result-item">
                            <p3>Total Income</p3><br>
                            <p4>35,000.00</p4>
                            <div class="box-container">
                            </div>
                        </div>
                        <div class="result-item">
                            <p3>Total Balance</p3><br>
                            <p4>5,000.00</p4>
                            <div class="box-container">
                            </div>
                        </div>
                    </div>
                    <div class="graph-frame">
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
                <div class="info-frame">
                    <div class="user-frame">
                        <div class="profile">
                            <center>
                                <img src="{{asset('images/logo.png')}}" id="profilePic" class="profile-picture">
                                <ul>
                                    <li class="highlight">John Ferry Santiago</li>
                                    <li>jnsantiago.au@phinmaed.com</li>
                                    <li>0929-619-9578</li>
                                </ul>
                            </center>
                        </div>
                    </div>
                    <div class="control-frame">
                        <div class="control">
                        <center>
                            <p5>SORT DATA BY</p5>
                            <ul>
                                <li><button class="control-button" id="yearly-btn">WEEKLY</button></li>
                                <li><button class="control-button" id="monthly-btn">MONTHLY</button></li>
                                <li><button class="control-button" id="weekly-btn">YEARLY</button></li>
                                <li></li>
                            </ul>
                        </center>
                        </div>
                    </div>
                </div>
            </div>

            <div class="summary-frame">
                <div class="budget-frame">
                    <p2 class="summary-title">Expenses Summary</p2>
                    <div class="summary-section">
                        <ul>
                            <li><span>Food</span><span>80,000.00</span></li>
                            <li><span>Rent</span><span>40,000.00</span></li>
                            <li><span>Transpo</span><span>40,000.00</span></li>
                            <li><span>Debt/Loan</span><span>80,000.00</span></li>
                            <li><span>Shopping</span><span>40,000.00</span></li>
                            <li><span>Mobile</span><span>80,000.00</span></li>
                            <li><span>Savings</span><span>40,000.00</span></li>
                            <li><span>School</span><span>80,000.00</span></li>
                            <li><span>Others</span><span>80,000.00</span></li>
                        </ul>
                        <div class="chart-container">
                        <canvas id="budgetChart"></canvas>
                        </div>
                        
                    </div>
                </div>

                <div class="income-frame">
                    <p2 class="summary-title">Income Summary</p2>
                    <div class="summary-section">
                    <div class="chart-container">
                        <canvas id="incomeChart"></canvas>
                        </div>
                        <ul>
                            <li><span>Provider</span><span>80,000.00</span></li>
                            <li><span>Earnings</span><span>40,000.00</span></li>
                            <li><span>Grant</span><span>40,000.00</span></li>
                            <li><span>Loan</span><span>80,000.00</span></li>
                            <li><span>Others</span><span>70,753.00</span></li>
                        </ul>
                    </div>
                </div>

                <div class="recent-frame">
                    <p2 class="summary-title3"><span class="left">Recent Transactions</span>
                        <span class="right"><a href="{{ url('tracking') }}" class="see-more-link">See more > </a></span></p2>
                    <div class="summary-section">
                        <div class="recent-transactions">
                            <table class="tracker-table" id="trackerTable">
                                <tr>
                                    <td colspan="6"><strong>Today - Tuesday, September 10, 2024</strong></td>
                                </tr>
                                <tr data-type="expenses">
                                    <td>Outflow</td>
                                    <td><strong>Food</strong></td>
                                    <td>Coffee in Starbucks</td>
                                    <td>250.00</td>
                                </tr>
                                <tr data-type="expenses">
                                    <td>Outflow</td>
                                    <td><strong>Food</strong></td>
                                    <td>Coffee in Starbucks</td>
                                    <td>250.00</td>
                                </tr>
                                <tr data-type="income">
                                    <td>Inflow</td>
                                    <td><strong>Scholarship</strong></td>
                                    <td>City Hall</td>
                                    <td>2,000.00</td>
                                </tr>
                                <tr data-type="income">
                                    <td>Inflow</td>
                                    <td><strong>Scholarship</strong></td>
                                    <td>City Hall</td>
                                    <td>2,000.00</td>
                                </tr>
                                <tr data-type="income">
                                    <td>Inflow</td>
                                    <td><strong>Allowance</strong></td>
                                    <td>From Parents</td>
                                    <td>250.00</td>
                                </tr>
                                <tr>
                                    <td colspan="6"><strong>Yesterday - Monday, September 9, 2024</strong></td>
                                </tr>
                                <tr data-type="expenses">
                                    <td>Outflow</td>
                                    <td><strong>Food</strong></td>
                                    <td>Coffee in Starbucks</td>
                                    <td>250.00</td>
                                </tr>
                                <tr data-type="expenses">
                                    <td>Outflow</td>
                                    <td><strong>Food</strong></td>
                                    <td>Coffee in Starbucks</td>
                                    <td>250.00</td>
                                </tr>
                                <tr data-type="expenses">
                                    <td>Outflow</td>
                                    <td><strong>Food</strong></td>
                                    <td>Coffee in Starbucks</td>
                                    <td>250.00</td>
                                </tr>
                                <tr data-type="income">
                                    <td>Inflow</td>
                                    <td><strong>Scholarship</strong></td>
                                    <td>City Hall</td>
                                    <td>2,000.00</td>
                                </tr>
                                <td colspan="6"><strong> October 9, 2024</strong></td>
                                </tr>
                                <tr data-type="expenses">
                                    <td>Outflow</td>
                                    <td><strong>Food</strong></td>
                                    <td>Coffee in Starbucks</td>
                                    <td>250.00</td>
                                </tr>
                                <tr data-type="expenses">
                                    <td>Outflow</td>
                                    <td><strong>Food</strong></td>
                                    <td>Coffee in Starbucks</td>
                                    <td>250.00</td>
                                </tr>
                                <tr data-type="expenses">
                                    <td>Outflow</td>
                                    <td><strong>Food</strong></td>
                                    <td>Coffee in Starbucks</td>
                                    <td>250.00</td>
                                </tr>
                                <tr data-type="income">
                                    <td>Inflow</td>
                                    <td><strong>Scholarship</strong></td>
                                    <td>City Hall</td>
                                    <td>2,000.00</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script>
    var ctxLine = document.getElementById('lineChart').getContext('2d');
    var lineChart = new Chart(ctxLine, {
    type: 'line',
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [{
            label: 'My Dataset',
            data: [10, 20, 15, 25, 30, 40, 35],
            borderColor: '#FF6F61', // Coral orange color
            backgroundColor: 'rgba(255, 111, 97, 0.2)', // Light coral orange
            fill: true
        }]
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
                labels: ['Food', 'Rent', 'Transpo', 'Debt/Loan', 'Shopping', 'Mobile', 'Savings', 'School', 'Others'],
                datasets: [{
                    label: 'Expenses',
                    data: [80000, 40000, 40000, 80000, 40000, 80000, 40000, 80000, 80000],
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
                labels: ['Provider', 'Earnings', 'Grant', 'Loan', 'Others'],
                datasets: [{
                    label: 'Income',
                    data: [80000, 40000, 40000, 80000, 70753],
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
</script>