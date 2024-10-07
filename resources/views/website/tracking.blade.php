@php
    use Carbon\Carbon;
    Carbon::setLocale('en'); 
@endphp


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/tracker.css') }}">
    <title>Tracker</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
<div class="sidebar">
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
                <li class="{{ Request::is('SmartBudget/trackings') ? 'active' : '' }}">
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
                    <img src=" {{$user->profile_pic ? asset('' . $user->profile_pic) : asset('images/user.png')}} " alt="Profile Picture" class="profile-sidebar-img">
                    <span class="label">Profile</span>
                </li>
            </a>
        </div>
    </div>
</div>


    <div class="main-content">         
            <div class="header">TRACKER</div>

        <div class="tracker-container">
    <div class="tracker-overview">
        <div class="tracker-summaries">
            <div class="tracker-summary">
                <h2>₱{{number_format($total_expense)}}</h2>
                <p>Total Expenses</p>
            </div>
            <div class="tracker-summary">
                <h2>₱{{number_format($total_income)}}</h2>
                <p>Total Income</p>
            </div>
            <div class="tracker-summary">
                <h2> {{($total_income - $total_expense) < 0 ? '-' : null}}₱{{number_format(abs($total_income - $total_expense))}}</h2>
                <p>Remaining Funds</p>
            </div>
        </div>

        <!-- Chart Container -->
        <div style="background-color: transparent" class="tracker-chart-container">
            <canvas id="lineChart" ></canvas>
        </div>
    </div>
</div>


<div class="tracker-tabs">
    <div>        
        <form action="{{route('tracking')}}" method="POST">
            @method('GET')
            @csrf
            <button class="{{Request::is('SmartBudget/trackings') ? 'active' : 'inactive'}}">All Transactions</button>
        </form>
        <form action="{{route('tracking.expenses')}}" method="POST">
            @method('GET')
            @csrf
            <button class="{{Request::is('SmartBudget/trackings/expenses') ? 'active' : 'inactive'}}">Expenses</button>
        </form>
        <form action="{{route('tracking.incomes')}}" method="POST">
            @method('GET')
            @csrf
            <button class="{{Request::is('SmartBudget/trackings/incomes') ? 'active' : 'inactive'}}">Income</button>
        </form>
    </div>
    <div class="action-buttons">
        <form action="{{ route('tracker.pdf') }}">
            @csrf
            @method('GET')
            
            <button class="export" type="submit" >Export</button>
        </form>

        <button class="add" onclick="openModal(event)">Add Record</button>
    </div>
</div>


<table class="tracker-table" id="trackerTable">
    <tbody>
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
                        <td style="padding-left: 15px; font-weight: bold;" colspan="100" id="{{$track->mode}}">
                            {{$check_date->isToday() ? 'Today - ' : null}} 
                            {{$check_date->isYesterday() ?'Yesterday - ' : null}}
                            {{-- {{$check_date->isFuture() ?'Planned Ahead - ' : null}} --}}
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

                    <td>
                        <button id="false-{{ $track->id }}" type="button" onclick="setEditModal({{$track->id}})" >
                            Edit
                        </button>
                    </td>

                    <div class="editModal" id="editModal-{{ $track->id }}" style="display: none">
                        <div class="editBody">
                            <div class="exitEditBtn" onclick="setEditModal({{$track->id}})" >X</div>

                        <form action="{{ route('tracking.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <input type="hidden" name="id" value="{{ $track->id }}">
                            
                            <label for="mode">Mode: <x-input-error :err="'mode'" /> </label>
                            <select name="mode" id="modeEdit-{{ $track->id }}" onchange="changeEditOpts({{ $track->id }})" >
                                <option @selected($track->mode === 'outgoing') value="outgoing">Outgoing</option>
                                <option @selected($track->mode === 'ingoing') value="ingoing">Ingoing</option>
                            </select>

                            <label for="category">Category: <x-input-error :err="'category'" /> </label>
                            <select name="category" id="categoryEdit-{{ $track->id }}" >
                                <option @selected($track->category === 'food')  value="food">Food</option>
                                <option @selected($track->category === 'rent') value="rent">Rent</option>
                                <option @selected($track->category === 'transpo') value="transpo">Transportation</option>
                                <option @selected($track->category === 'loan') value="loan">Debt/Loan</option>
                                <option @selected($track->category === 'shopping') value="shopping">Shopping</option>
                                <option @selected($track->category === 'mobile') value="mobile">Mobile</option>
                                <option @selected($track->category === 'savings') value="savings">Savings</option>
                                <option @selected($track->category === 'school') value="school">School</option>
                                <option @selected($track->category === 'others') value="others">Others</option>
                            </select>
                            
                            <x-input-error :err="'description'" />
                            <label for="Description">Description:</label>
                            <input name="description" type="text" value="{{ $track->description }}" required >
                            
                            <x-input-error :err="'amount'" />
                            <label for="Amount">Amount:</label>
                            <input name="amount" type="number" step="0.01" value="{{ $track->amount }}" required >

                            <x-input-error :err="'date'" />
                            <label for="date">Date:</label>
                            <input name="date" type="date" value="{{ $track->date }}" required >

                            <button class="editBtn" type="submit">Edit Record</button>
                        </form>
                        </div>
                    </div>

                    <td>
                        <button type="button" onclick="setDeleteModal({{ $track->id }})" ><i class="fa-solid fa-trash"></i></button>

                        <div class="big-bright" id="big-bright-{{ $track->id }}" style="display: none">
                        <div class="deleteForm" >
                        <form action="{{route('tracking.delete', $track->id)}}" method="POST">
                            @csrf
                            @method('DELETE')

                            <div class="header">
                          <h2>Oh no!</h2>
                              </div>
                              <div class="body">
                          <p>Are you sure you want to delete this item?</p>

                            <button style="background-color: rgb(251, 104, 104); color: white;" type="submit" onclick="!confirm('Are you sure?') && event.preventDefault()" >
                                YES
                            </button>
                            <button style="background-color: green; color: white" type="button" onclick="setDeleteModal({{ $track->id }})">NO</button>
                        </form>
                        </div>
                        </div>
                    </td>
                </tr>

                @php
                    $rendered = $track->date;                    
                @endphp
            @endforeach
        @endif
    </tbody>
</table>
</div>

<!-- Add Record Modal -->
<div id="recordModal" class="modal record-modal">
    <form action="{{ route('tracking.store') }}" method="POST">
    @csrf
    <div class="modal-content">
        <div class="modal-header">
            <h2>Add Record</h2>
            <span class="close" onclick="closeModal(event)">&times;</span>
        </div>
        <div class="modal-body">
            <label for="itemName">Description</label>
            <div style="display: flex; flex-direction: column">
                <x-input-error  :err="'description'" />
                <input required type="text" name="description" id="itemName" placeholder="Type here">
            </div>
            <div class="input-group">
                <div>
                    <label for="mode">Mode</label>
                    <div style="display: flex; flex-direction: column">
                        <x-input-error  :err="'mode'" />
                    <select name="mode" id="mode" onchange="changeOpts()">
                        <option value="outgoing">outgoing</option>
                        <option value="ingoing">incoming</option>
                    </select>
                    </div>
                </div>
                <div>
                    <label for="category">Category</label>
                    <div style="display: flex; flex-direction: column">
                        <x-input-error  :err="'category'" />
                        <select required name="category" id="category">
                            <option value="food">Food</option>
                            <option value="rent">Rent</option>
                            <option value="transpo">Transportation</option>
                            <option value="loan">Debt/Loan</option>
                            <option value="shopping">Shopping</option>
                            <option value="mobile">Mobile</option>
                            <option value="savings">Savings</option>
                            <option value="school">School</option>
                            <option value="others">Others</option>
                            <!-- Add more categories as needed -->
                        </select>
                    </div>
                </div>
            </div>

            <div class="input-group">
                <div>
                    <label for="date">Date</label>
                    <div style="display: flex; flex-direction: column">
                        <x-input-error  :err="'date'" />
                        <input required name="date" type="date" id="date">
                    </div>
                </div>
                <div>
                    <label for="amount">Amount</label>
                    <div style="display: flex; flex-direction: column">
                        <x-input-error  :err="'amount'" />
                        <input required name="amount" type="number" id="amount" placeholder="Amount">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="reset">Clear</button>
            <button type="submit" class="save-btn">Save</button>
        </div>
    </div>
    </form>
</div>


<!-- GREAT! Modal -->
<div id="greatModal" class="modal great-modal">
    <div class="modal-content">
        <i class="fa-solid fa-circle-check"></i>
        <div class="modal-header">
            <h2>GREAT!</h2>
        </div>
        <div class="modal-body">
            <p>Your record has been saved successfully!</p>
            <div class="modal-footer">
                <button class="save-btn" onclick="closeGreatModal(event)">Go Back</button>
            </div>
        </div>
    </div>
</div>
<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="modal delete-modal">
    <div class="modal-content">
    <i class="fa-solid fa-triangle-exclamation"></i>
        <div class="modal-header">
            <h2>Oh no!</h2>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to delete this item?</p>
            <div class="modal-footer">
                <button class="clear-btn" onclick="confirmDelete()">Yes</button>
                <button class="save-btn" onclick="closeDeleteModal()">No</button>
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

<script src="{{ asset('js/tracking.js') }}" ></script>

<script>
    function setDeleteModal(id){
        if(document.getElementById(`big-bright-${id}`)) {
            document.getElementById(`big-bright-${id}`).style = 'display: flex';
            document.getElementById(`big-bright-${id}`).id = `big-dark-${id}`;
        }

        else if(document.getElementById(`big-dark-${id}`)) {
            document.getElementById(`big-dark-${id}`).style = 'display: none';
            document.getElementById(`big-dark-${id}`).id = `big-bright-${id}`;
        }
    }

    function setEditModal(id){
        if(document.getElementById(`false-${id}`)) {
            document.getElementById(`false-${id}`).id = `true-${id}`;
            document.getElementById(`editModal-${id}`).style = 'display: flex';
        }

        else if (document.getElementById(`true-${id}`)) {
            document.getElementById(`true-${id}`).id = `false-${id}`;
            document.getElementById(`editModal-${id}`).style = 'display: none';
        }
    } 

    function changeEditOpts(id){
        const selected = document.getElementById(`modeEdit-${id}`);
        const change = document.getElementById(`categoryEdit-${id}`);

        if(selected.value === "outgoing"){
            change.innerHTML = `
                <option  value="food">Food</option>
                <option value="rent">Rent</option>
                <option value="transpo">Transportation</option>
                <option value="loan">Debt/Loan</option>
                <option value="shopping">Shopping</option>
                <option value="mobile">Mobile</option>
                <option value="savings">Savings</option>
                <option value="school">School</option>
                <option value="others">Others</option>
            `;
        } else {
            change.innerHTML = `
                <option value="provider">Provider</option>
                <option value="earnings">Earnings</option>
                <option value="grant">Grant</option>
                <option value="loan">Loan</option>
                <option value="others">Others</option>
            `;
        }
    }

    function changeOpts(){
        const selected = document.getElementById('mode');
        const change = document.getElementById('category');

        if(selected.value === "outgoing"){
            change.innerHTML = `
                <option value="food">Food</option>
                <option value="rent">Rent</option>
                <option value="transpo">Transportation</option>
                <option value="loan">Debt/Loan</option>
                <option value="shopping">Shopping</option>
                <option value="mobile">Mobile</option>
                <option value="savings">Savings</option>
                <option value="school">School</option>
                <option value="others">Others</option>
            `;
        } else {
            change.innerHTML = `
                <option value="provider">Provider</option>
                <option value="earnings">Earnings</option>
                <option value="grant">Grant</option>
                <option value="loan">Loan</option>
                <option value="others">Others</option>
            `;
        }
    }

    // Open the 'Add Record' Modal
    function openModal(event) {
        event.preventDefault();
        document.getElementById('recordModal').style.display = 'flex';
    }

    // Close the 'Add Record' Modal
    function closeModal(event) {
        event.preventDefault();
        document.getElementById('recordModal').style.display = 'none';
    }

    // Open the 'GREAT!' Modal
    function openGreatModal(event) {
        event.preventDefault();
        document.getElementById('greatModal').style.display = 'flex';
    }

    // Close the 'GREAT!' Modal
    function closeGreatModal(event) {
        event.preventDefault();
        document.getElementById('greatModal').style.display = 'none';
    }
</script>