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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('css/planner.css') }}">
    <title>Planner</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                        <img src=" {{$user->profile_pic ? asset('' . $user->profile_pic) : asset('images/user.png')}} " alt="Profile Picture" class="profile-sidebar-img">
                        <span class="label">Profile</span>
                    </li>
                </a>
            </div>
        </div>
    </div>

    @php
    if($allocation){
        $sum = $allocation->food
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
        $allocation->others;
    } else {
        $sum = 0;
    }
    @endphp

    <div class="main-content">
    <div class="planner-frame">
        <div class="header">Budget Planner</div>
        <div class="budget-stats">
            <div>
                <h3>₱{{number_format($total_expected)}}</h3>
                <p>Expected Income</p>
            </div>
            <div>
                <h3>
                    ₱{{$allocation ? number_format((
                        $sum
                    )) : 0}} 
                </h3>
                <p>Target Income</p>
            </div>
            <div>
                <h3>₱{{($sum - $total_expected) < 0 ? 0 : number_format($sum - $total_expected)}}</h3>
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
                <canvas id="allocationDonut"></canvas>
            </div>
        </div>
        <div class="allocation-container">
            <!-- Update Button -->
            <button onclick="makeTableEditable(event)" type="button" id="update-button">Update Allocation</button>
            <table id="budget-table">
                <tbody>
                    @if ($allocation)                    
                    <tr>
                        <td id="category" >Food</td>
                        <td class="editable">{{$allocation->food}}</td>              
                    </tr>
                    <tr>
                        <td id="category" >Rent</td>
                        <td class="editable">{{$allocation->rent}}</td>
                    </tr>
                    <tr>
                        <td id="category" >Transportation</td>
                        <td class="editable">{{$allocation->transportation}}</td>
                    </tr>
                    <tr>
                        <td id="category" >Debt/Loan</td>
                        <td class="editable">{{$allocation->loan}}</td>
                    </tr>
                    <tr>
                        <td id="category" >Shopping</td>
                        <td class="editable">{{$allocation->shopping}}</td>
                    </tr>
                    <tr>
                        <td id="category" >Mobile</td>
                        <td class="editable">{{$allocation->mobile}}</td>
                    </tr>
                    <tr>
                        <td id="category" >Savings</td>
                        <td class="editable">{{$allocation->savings}}</td>
                    </tr>
                    <tr>
                        <td id="category" >School</td>
                        <td class="editable">{{$allocation->school}}</td>

                    </tr>
                    <tr>
                        <td id="category" >Others</td>
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
            <option value="provider">Provider</option>
            <option value="earnings">Earnings</option>
            <option value="grant">Grant</option>
            <option value="loan">Loan</option>
            <option value="others">Others</option>
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
                    @php
                        $date;
                        $date = Carbon::createFromFormat('Y-m-d', $expected->date);
                    @endphp

                        <tr>
                            <td>{{$date->translatedFormat('F j, Y')}}</td>
                            <td style="text-transform: capitalize" >{{$expected->source}}</td>
                            <td>₱{{number_format($expected->amount)}}</td>
                            <td>
                                <button type="button" onclick="setEditModal({{ $expected->id }})" >Edit</button>
                            </td>

                            <div style="display: none" class="big-dark" id="dark-{{ $expected->id }}">
                            <div class="editForm">
                                <div class="closeEditBtn" onclick="setEditModal({{ $expected->id }})" >X</div>

                                <form action="{{ route('planner.expected.update') }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" name="id" value="{{ $expected->id }}">

                                    <label for="date">Date: <x-input-error  :err="'date'" /></label>
                                    <input type="date" name="date" value="{{ $expected->date }}">
                                    
                                    <label for="source">Source: <x-input-error  :err="'source'" /></label>
                                    <select name="source">
                                        <option @selected($expected->source === 'provider') value="provider">Provider</option>
                                        <option @selected($expected->source === 'earnings') value="earnings">Earnings</option>
                                        <option @selected($expected->source === 'grant') value="grant">Grant</option>
                                        <option @selected($expected->source === 'loan') value="loan">Loan</option>
                                        <option @selected($expected->source === 'others') value="others">Others</option>
                                    </select>

                                    <label for="date">Date: <x-input-error  :err="'date'" /></label>
                                    <input type="number" name="amount" value="{{ $expected->amount }}">

                                    <button type="submit" class="editBtn">Edit</button>
                                </form>
                            </div>
                            </div>

                            <td>
                                <button onclick="setDeleteModal({{ $expected->id }})" >
                                    DELETE
                                </button>

                                <div class="deleteDark" id="sunrise-{{ $expected->id }}" style="display: none">
                                <div class="deleteForm" >
                                <form action="{{ route('planner.expected.delete') }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <input type="hidden" name="id" value="{{ $expected->id }}">

                                    <h1>Delete The Record?</h1>
                                    <button type="submit" onclick="!confirm('Are your sure?') && event.preventDefault()" >YES DELETE</button>
                                    <button type="button" onclick="setDeleteModal({{ $expected->id }})" >NO`GO BACK</button>
                                </form>
                                </div>
                                </div>
                            </td>
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

    <button onclick="setDeleteForm()" class="btn-reset">Reset Planner</button>

    <div class="sunrise" id="sunrise" style="display:none">
    <div class="resetForm">
    <form action="{{ route('planner.reset', auth()->user()->id) }}" method="POST" >
        @csrf
        @method('DELETE')

        <h1>RESET THE WHOLE PLANNER PAGE?</h1>

        <button type="submit" class="btn-reset" onclick="confirm('Are You Sure??') ?  null : event.preventDefault()">Reset Planner</button>
        <button type="button" onclick="setDeleteForm()" class="btn-reset">Go Back</button>

    </form>
    </div>
    </div>
</div>

    </div>

    <div>
    @foreach ($categories as $category)
        <p id="category" style="display: none">
            {{$category->category}}
        </p>
    @endforeach
    </div>
</body>
</html>

<script src="{{ asset('js/planner.js') }}" ></script>

<script>
function setDeleteForm(){
    if(document.getElementById('sunrise')){
        document.getElementById('sunrise').style = "display: flex";
        document.getElementById('sunrise').id = "eclipse";
    }
    
    else if(document.getElementById('eclipse')){
        document.getElementById('eclipse').style = "display: none";
        document.getElementById('eclipse').id = "sunrise";
    } 

}

function setDeleteModal(id) {
    if(document.getElementById(`sunrise-${id}`)){
        document.getElementById(`sunrise-${id}`).style = 'display: flex';
        document.getElementById(`sunrise-${id}`).id = `eclipse-${id}`;        
    }
    
    else if(document.getElementById(`eclipse-${id}`)){
        document.getElementById(`eclipse-${id}`).style = 'display: none';
        document.getElementById(`eclipse-${id}`).id = `sunrise-${id}`;
    }
}

function setEditModal(id) {
    if(document.getElementById(`dark-${id}`)){
        document.getElementById(`dark-${id}`).style = 'display: flex';
        document.getElementById(`dark-${id}`).id = `bright-${id}`;
    }

    else if(document.getElementById(`bright-${id}`)){
        document.getElementById(`bright-${id}`).style = 'display: none';
        document.getElementById(`bright-${id}`).id = `dark-${id}`;        
    }
}

    
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
            cell.innerHTML = `
                <x-input-error :err="'${categories[count]}'" />
                <input type="number" id="editable" name="${categories[count]}" required  value="${currentValue}" />
            `; // Replace with input field
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
