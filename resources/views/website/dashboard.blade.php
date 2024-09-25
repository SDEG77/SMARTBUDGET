@php
    use Carbon\Carbon;
    Carbon::setLocale('en');
@endphp

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
                            <img src="{{$user->profile_pic ? asset('' . $user->profile_pic) : asset('images/user.png')}}" alt="Profile Picture" class="profile-sidebar-img">
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
                            <i class="fa-solid fa-money-bill-wave"></i>
                            <p4>{{number_format($total_expense)}}</p4>
                            <p3>Total Expenses</p3>
                        </div>
                        <div class="result-item">
                            <i class="fa-solid fa-money-bill-wave"></i>
                            <p4>{{number_format($total_income)}}</p4>
                            <p3>Total Income</p3>
                        </div>
                        <div class="result-item">
                            <i class="fa-solid fa-money-bill-wave"></i>
                            <p4>{{number_format(abs($total_income - $total_expense))}}</p4>
                            <p3>Total Balance</p3>
                        </div>
                    </div>
                    <div class="graph-frame">
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
                <div class="info-frame">
                    <div class="user-frame">
                        <div class="profile" style="background-color: white">
                            <center>
                                <img src="{{$user->profile_pic ? asset('' . $user->profile_pic) : asset('images/user.png')}}" style="margin-bottom: 5px" id="profilePic" class="profile-picture">
                                <ul style="color:black; display: flex; flex-direction:column">
                                    <li class="highlight" style="text-transform:uppercase;
                                    font-weight:bold;
                                    font-size: 14px;
                                    ">{{$user->full_name}}</li>
                                    <li style="font-size:10px">{{$user->school_name}}</li>
                                    <li style="font-size:10px">{{$user->course}}</li>
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
                        <div class="chart-container" style="margin-bottom: 20px">
                            <canvas id="budgetChart"></canvas>
                        </div>

                        <ul>
                            @foreach ($expenses as $sum)
                                <li>
                                    <span id="expenseCategory" >{{$sum->category}}</span>
                                    <span id="expenseTotal">{{number_format($sum->total)}}</span>
                                </li>
                            @endforeach


                            {{-- <li><span>Food</span><span>80,000.00</span></li>
                            <li><span>Rent</span><span>40,000.00</span></li>
                            <li><span>Transpo</span><span>40,000.00</span></li>
                            <li><span>Debt/Loan</span><span>80,000.00</span></li>
                            <li><span>Shopping</span><span>40,000.00</span></li>
                            <li><span>Mobile</span><span>80,000.00</span></li>
                            <li><span>Savings</span><span>40,000.00</span></li>
                            <li><span>School</span><span>80,000.00</span></li>
                            <li><span>Others</span><span>80,000.00</span></li> --}}
                        </ul>                        
                    </div>
                </div>

                <div class="income-frame">
                    <p2 class="summary-title">Income Summary</p2>
                    <div class="summary-section">
                    <div class="chart-container">
                        <canvas id="incomeChart"></canvas>
                        </div>
                        <ul>
                            @foreach ($incomes as $sum)
                                <li>
                                    <span id="incomeCategory" >{{$sum->category}}</span>
                                    <span id="incomeTotal">{{number_format($sum->total)}}</span>
                                </li>
                            @endforeach

                            {{-- <li><span>Provider</span><span>80,000.00</span></li>
                            <li><span>Earnings</span><span>40,000.00</span></li>
                            <li><span>Grant</span><span>40,000.00</span></li>
                            <li><span>Loan</span><span>80,000.00</span></li>
                            <li><span>Others</span><span>70,753.00</span></li> --}}
                        </ul>
                    </div>
                </div>

                <div class="recent-frame">
                    <p2 class="summary-title3"><span class="left">Recent Transactions</span>
                        <span class="right"><a href="{{ route('tracking') }}" class="see-more-link">See more > </a></span></p2>
                    <div class="summary-section">
                        <div class="recent-transactions">
                            <table class="tracker-table" id="trackerTable">
                                @if ($tracks->count() > 0)
                                    @php
                                        $rendered = 'nope :)';
                                    @endphp
                        
                                    @foreach ($tracks as $track)
                                        @php
                                            $date;
                                            $date = Carbon::createFromFormat('Y-m-d', $track->date);
                                            $check_date = Carbon::parse($track->date);
                                        @endphp
                        
                                        <tr>
                                            @if ($rendered === $track->date && $rendered !== 'nope :)')
                                                
                                            @else()
                                                <td style="font-weight: bold" colspan="100" id="{{$track->mode}}">
                                                    {{$check_date->isToday() ? 'Today - ' : null}} 
                                                    {{$check_date->isYesterday() ?'Yesterday - ' : null}}
                                                    {{$check_date->isFuture() ?'Planned Ahead - ' : null}}
                                                    {{$date->translatedFormat('l, F j, Y')}}
                                                </td>
                                            @endif
                                        </tr>
                        
                                        <tr id="{{$track->mode}}">
                                            <td>{{$track->mode}}</td>
                                            <td>{{$track->category}}</td>
                                            <td>{{$track->description}}</td>
                                            <td style="font-weight: bold; color: {{$track->mode === 'outgoing' ? 'red' : 'green'}}">
                                                {{$track->mode === 'outgoing' ? '-' : '+'}}₱{{number_format($track->amount)}}
                                            </td>
                                        </tr>
                        
                                        @php
                                            $rendered = $track->date;                    
                                        @endphp
                                    @endforeach
                                @endif

                                {{-- <tr>
                                    <td colspan="6"><strong>Today - Tuesday, September 10, 2024</strong></td>
                                </tr>
                                <tr data-type="expenses">
                                    <td>Outflow</td>
                                    <td><strong>Food</strong></td>
                                    <td>Coffee in Starbucks</td>
                                    <td>250.00</td>
                                </tr> --}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="display: none">
        @foreach ($track_all_expenses as $expense)
            <p id="track_expense" style="display: none">
                {{$expense->amount}}
            </p>
        @endforeach
        
        @foreach ($track_all_incomes as $income)
            <p id="track_income" style="display: none">
                {{$income->amount}}
            </p>
        @endforeach
    </div>

</body>
</html>

<script src="{{asset('js/dashboard.js')}}"></script>