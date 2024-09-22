<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('css/planner.css') }}">
    <title>Planner</title>
    
</head>

<body>
    <div class="container">
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
                        <img src="{{ asset('images/user.png') }}" alt="Profile Picture" class="profile-sidebar-img">
                        <span class="label">Profile</span>
                    </li>
                </a>
            </div>
        </div>
    </div>


    <div class="main-content">
    <div class="planner-frame">
        <div class="header">Welcome to your Budget Planner</div>
        <div class="budget-stats">
            <div>
                <h3>₱{{$total_expected}}</h3>
                <p>Expected Income</p>
            </div>
            <div>
                <h3>
                    ₱{{$target_income}} OR {{$allocation ? (
                        $allocation->food
                        +
                        $allocation->rent
                        +
                        $allocation->transportation
                        +
                        $allocation->loan
                        +
                        $allocation->shopping
                        +
                        $allocation->mobile
                        +
                        $allocation->savings
                        +
                        $allocation->school
                        +
                        $allocation->others
                    ) : 'none'}} 
                </h3>
                <p>Target Income</p>
            </div>
            <div>
                <h3>₱{{($target_income - $total_expected) < 0 ? 0 : ($target_income - $total_expected)}}</h3>
                <p>Budget Variance</p>
            </div>
        </div>

    <form action="{{ route('planner.allocate') }}" method="POST" id="update-form">
    @csrf
    @method('POST')
    <div class="budget-allocation">
        <div class="chart-container">
            <p2 class="chart-title">Budget Allocation</p2>
            <div class="chart">
                <!-- Pie chart goes here -->
                <img src="{{ asset('images/chart2.png') }}" alt="chart">
            </div>
        </div>
        <div class="allocation-container">
            <!-- Update Button -->
            <button onclick="makeTableEditable(event)" type="button" id="update-button">Update Allocation</button>
            <table id="budget-table">
                <tbody>
                    @if ($allocation)                    
                    <tr>
                        <td>Food</td>
                        <td class="editable">{{$allocation->food}}</td>              
                    </tr>
                    <tr>
                        <td>Rent</td>
                        <td class="editable">{{$allocation->rent}}</td>
                    </tr>
                    <tr>
                        <td>Transportation</td>
                        <td class="editable">{{$allocation->transportation}}</td>
                    </tr>
                    <tr>
                        <td>Debt/Loan</td>
                        <td class="editable">{{$allocation->loan}}</td>
                    </tr>
                    <tr>
                        <td>Shopping</td>
                        <td class="editable">{{$allocation->shopping}}</td>
                    </tr>
                    <tr>
                        <td>Mobile</td>
                        <td class="editable">{{$allocation->mobile}}</td>
                    </tr>
                    <tr>
                        <td>Savings</td>
                        <td class="editable">{{$allocation->savings}}</td>
                    </tr>
                    <tr>
                        <td>School</td>
                        <td class="editable">{{$allocation->school}}</td>

                    </tr>
                    <tr>
                        <td>Others</td>
                        <td class="editable">{{$allocation->others}}</td>
                    </tr>

                    @else
                        <x-planner-placeholder />
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    </form>
</div>

<div class="tables">
<div class="head">
<h3>Expected Income</h3>
</div> 
        
<form action="{{route('planner.expected')}}" method="POST" id="add-income-form">
    @csrf
    
    <div class="form-group">
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>
    </div>
    <div class="form-group">
        <label for="source">Source:</label>
        <select id="source" name="source" required>
            <option value="Allowance">Allowance</option>
            <option value="Scholarship">Scholarship</option>
        </select>
    </div>
    <div class="form-group">
        <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount" step="0.01" required>
    </div>
    <button type="submit">Add Income</button>
</form>
<div class="table">
        <!-- Expected Income Table -->
        <table>
            </thead>
            <tbody id="income-table-body">
                @if ($expecteds->count() > 0)
                    @foreach ($expecteds as $expected)
                        <tr>
                            <td>{{$expected->date}}</td>
                            <td>{{$expected->source}}</td>
                            <td>₱{{$expected->amount}}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    </div>
    <div class="button-container">
    <div class="reset-button">
        <p>Want to start new? Click the reset button to clear all your entries & re-create new ones.</p>
    </div>
    <form action="{{ route('planner.reset') }}" method="POST" >
        @csrf
        @method('GET')
        <button type="submit" class="btn-reset" onclick="confirm('Are You Sure??') ?  null : event.preventDefault()">Reset Planner</button>
    </form>
</div>

    </div>
</body>
</html>

<script>
    
// Function to make table editable
function makeTableEditable(event) {
    event.preventDefault();
    // Get all editable cells
    const editableCells = document.querySelectorAll('#budget-table .editable');
    const categories = ['food' ,'rent', 'transportation', 'loan', 'shopping', 'mobile', 'savings', 'school', 'others'];
    let count = 0;
    
    // Loop through each cell and replace text with input field
    editableCells.forEach(cell => {
        const currentValue = cell.textContent.trim(); // Get the current value in the cell
        if (!cell.querySelector('input')) {  // Avoid duplicating inputs
            cell.innerHTML = `<input type="number" name="${categories[count]}"  value="${currentValue}" />`; // Replace with input field
        }

        count += 1
    });

    // Change the "Update" button to "Save"
    const updateButton = document.getElementById('update-button');
    updateButton.textContent = 'Save';
    updateButton.id = 'save-button';
    updateButton.setAttribute('type', 'submit');

    // Add event listener for saving the edited values
    document.getElementById('save-button').addEventListener('click', () => {
        document.getElementById('update-form').submit();
    });
}
</script>
