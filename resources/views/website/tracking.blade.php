<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/tracker.css') }}">
    <title>Tracker</title>
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
            <div class="header">TRACKER</div>

        <div class="tracker-container">
    <div class="tracker-overview">
        <div class="tracker-summaries">
            <div class="tracker-summary">
                <h2>P799,000.00</h2>
                <p>Total Expenses</p>
            </div>
            <div class="tracker-summary">
                <h2>P799,000.00</h2>
                <p>Total Income</p>
            </div>
            <div class="tracker-summary">
                <h2>P799,000.00</h2>
                <p>Total Balance</p>
            </div>
        </div>

        <!-- Chart Container -->
        <div class="tracker-chart-container">
            <img src="{{ asset('images/graph.png') }}" alt="Chart" class="tracker-chart">
        </div>
    </div>
</div>


<div class="tracker-tabs">
    <div>
        <button {{--onclick="filterTable('all')"--}} class="active">All Transactions</button>
        <button {{--onclick="filterTable('expenses')"--}}>Expenses</button>
        <button {{--onclick="filterTable('income')"--}}>Income</button>
    </div>
    <div class="action-buttons">
        <button class="export">Export</button>
        <button class="add" onclick="openModal()">Add Record</button>

    </div>
</div>


<table class="tracker-table" id="trackerTable">
    <tbody>
        <!-- Today's Transactions -->
        <tr>
            <td colspan="6"><strong>Today - Tuesday, September 10, 2024</strong></td>
        </tr>
        <tr data-type="expenses">
            <td>Outflow</td>
            <td>Food</td>
            <td>Coffee in Starbucks</td>
            <td>250.00</td>
            <td><button onclick="openDeleteModal()"><i class="fa-solid fa-trash"></i></button></td>
        </tr>
        <tr data-type="income">
            <td>Inflow</td>
            <td>Scholarship</td>
            <td>City Hall</td>
            <td>2,000.00</td>
            <td><button onclick="openDeleteModal()"><i class="fa-solid fa-trash"></i></button></td>
        </tr>
        <tr data-type="income">
            <td>Inflow</td>
            <td>Allowance</td>
            <td>From Parents</td>
            <td>250.00</td>
            <td><button onclick="openDeleteModal()"><i class="fa-solid fa-trash"></i></button></td>
        </tr>

        <!-- Yesterday's Transactions -->
        <tr>
            <td colspan="6"><strong>Yesterday - Monday, September 9, 2024</strong></td>
        </tr>
        <tr data-type="expenses">
            <td>Outflow</td>
            <td>Food</td>
            <td>Coffee in Starbucks</td>
            <td>250.00</td>
            <td><button onclick="openDeleteModal()"><i class="fa-solid fa-trash"></i></button></td>
        </tr>
        <tr data-type="income">
            <td>Inflow</td>
            <td>Scholarship</td>
            <td>City Hall</td>
            <td>2,000.00</td>
            <td><button onclick="openDeleteModal()"><i class="fa-solid fa-trash"></i></button></td>
        </tr>

        <!-- Oldest Transactions -->
        <tr>
            <td colspan="6"><strong>Oldest Dates</strong></td>
        </tr>
        <tr data-type="expenses">
            <td>Outflow</td>
            <td>Transport</td>
            <td>Bus Ticket</td>
            <td>30.00</td>
            <td><button onclick="openDeleteModal()"><i class="fa fa-trash"></i></button></td>
        </tr>
        <tr data-type="income">
            <td>Inflow</td>
            <td>Part-time Job</td>
            <td>Company X</td>
            <td>500.00</td>
            <td><button onclick="openDeleteModal()"><i class="fa fa-trash"></i></button></td>
        </tr>
    </tbody>
</table>

    </div>
<!-- Add Record Modal -->
<div id="recordModal" class="modal record-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Add Record</h2>
            <span class="close" onclick="closeModal()">&times;</span>
        </div>
        <div class="modal-body">
            <label for="itemName">Description</label>
            <input type="text" id="itemName" placeholder="Type here">

            <div class="input-group">
                <div>
                    <label for="mode">Mode</label>
                    <select id="mode">
                        <option value="cash">outgoing</option>
                        <option value="credit">incoming</option>
                    </select>
                </div>
                <div>
                    <label for="category">Category</label>
                    <select id="category">
                        <option value="food">Food</option>
                        <option value="transport">Transport</option>
                        <!-- Add more categories as needed -->
                    </select>
                </div>
            </div>

            <div class="input-group">
                <div>
                    <label for="date">Date</label>
                    <input type="date" id="date">
                </div>
                <div>
                    <label for="amount">Amount</label>
                    <input type="number" id="amount" placeholder="Amount">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="clear-btn" >Clear</button>
            <button class="save-btn">Save</button>
        </div>
    </div>
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
                <button class="save-btn" onclick="closeGreatModal()">Go Back</button>
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
</body>
</html>

<script>    
    // Open the 'Add Record' Modal
    function openModal() {
        document.getElementById('recordModal').style.display = 'flex';
    }

    // Close the 'Add Record' Modal
    function closeModal() {
        document.getElementById('recordModal').style.display = 'none';
    }

    // Open the 'GREAT!' Modal
    function openGreatModal() {
        document.getElementById('greatModal').style.display = 'flex';
    }

    // Close the 'GREAT!' Modal
    function closeGreatModal() {
        document.getElementById('greatModal').style.display = 'none';
    }


    // Open the 'Delete Confirmation' Modal
    function openDeleteModal() {
        document.getElementById('deleteModal').style.display = 'flex';
    }

    // Close the 'Delete Confirmation' Modal
    function closeDeleteModal() {
        document.getElementById('deleteModal').style.display = 'none';
    }

    // Confirm the deletion of a record
    function confirmDelete() {
        deleteRecord();
        closeDeleteModal();
    }
</script>