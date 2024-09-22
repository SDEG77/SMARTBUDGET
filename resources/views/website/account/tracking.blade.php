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
            <a href="{{ url('dashboard') }}">
                <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-house" alt="Home Icon"></i>
                    <span class="label">Home</span>
                </li>
            </a>
            <a href="{{ url('tracking') }}">
                <li class="{{ Request::is('tracking') ? 'active' : '' }}">
                <i class="fa-solid fa-clock-rotate-left" alt="Track Icon"></i>
                    <span class="label">Tracker</span>
                </li>
            </a>
            <a href="{{ url('ledger') }}">
                <li class="{{ Request::is('ledger') ? 'active' : '' }}">
                <i class="fa-regular fa-star" alt="Ledger Icon"></i>
                    <span class="label">Ledger</span>
                </li>
            </a>
            <a href="{{ url('planner') }}">
                <li class="{{ Request::is('planner') ? 'active' : '' }}">
                <i class="fa-solid fa-calendar-days" alt="Planner Icon"></i>
                    <span class="label">Planner</span>
                </li>
            </a>
            <a href="{{ url('about') }}">
                <li class="{{ Request::is('about') ? 'active' : '' }}">
                <i class="fa-solid fa-circle-info" alt="About Icon"></i>
                    <span class="label">About</span>
                </li>
            </a>
        </ul>
        <div class="down-sidebar">
            <a href="{{ url('welcome') }}">
                <li class="{{ Request::is('welcome') ? 'active' : '' }}">
                <i class="fa-solid fa-right-from-bracket" alt="Logout Icon"></i>
                    <span class="label">Log out</span>
                </li>
            </a>
            <a href="{{ url('profile') }}">
                <li class="{{ Request::is('profile') ? 'active' : '' }}">
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
        <button onclick="filterTable('all')" class="active">All Transactions</button>
        <button onclick="filterTable('expenses')">Expenses</button>
        <button onclick="filterTable('income')">Income</button>
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
            <button class="clear-btn" onclick="clearForm()">Clear</button>
            <button class="save-btn" onclick="saveRecord()">Save</button>
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

<script>
 // Save the record (either expense or income)
 function saveRecord() {
    const itemName = document.getElementById('itemName').value;
    const mode = document.getElementById('mode').value;
    const category = document.getElementById('category').value;
    const date = document.getElementById('date').value;
    const amount = document.getElementById('amount').value;

    if (!itemName || !mode || !category || !date || !amount) {
        alert('Please fill in all fields.');
        return;
    }

    // Add the new record to the transactions array
    transactions.push({ type: mode, category, itemName, date, amount });

    // Refresh the table with the new data
    refreshTable();

    // Close the modal and show the 'GREAT!' modal
    closeModal();
    openGreatModal();
}


function openModal() {
    document.getElementById('recordModal').style.display = 'flex';  // Make sure it's displayed as a flex container
}

function closeModal() {
    document.getElementById('recordModal').style.display = 'none';  // Hide the modal
}

// Refresh the table with all transactions
function refreshTable() {
    const tbody = document.querySelector('#trackerTable tbody');
    tbody.innerHTML = ''; // Clear the existing rows

    // Add 'Today', 'Yesterday', 'Oldest Dates' group headers if necessary
    let todayAdded = false, yesterdayAdded = false, oldestAdded = false;

    // Sort transactions by date (from newest to oldest)
    transactions.sort((a, b) => new Date(b.date) - new Date(a.date));

    transactions.forEach(transaction => {
        const row = document.createElement('tr');
        row.setAttribute('data-type', transaction.type);

        // Add section headers based on the date of the transaction
        if (isToday(transaction.date) && !todayAdded) {
            const todayRow = document.createElement('tr');
            todayRow.innerHTML = `<td colspan="6"><strong>Today - ${new Date().toLocaleDateString()}</strong></td>`;
            tbody.appendChild(todayRow);
            todayAdded = true;
        }

        if (isYesterday(transaction.date) && !yesterdayAdded) {
            const yesterdayRow = document.createElement('tr');
            yesterdayRow.innerHTML = `<td colspan="6"><strong>Yesterday - ${new Date(new Date().setDate(new Date().getDate() - 1)).toLocaleDateString()}</strong></td>`;
            tbody.appendChild(yesterdayRow);
            yesterdayAdded = true;
        }

        if (!isToday(transaction.date) && !isYesterday(transaction.date) && !oldestAdded) {
            const oldestRow = document.createElement('tr');
            oldestRow.innerHTML = `<td colspan="6"><strong>Oldest Dates</strong></td>`;
            tbody.appendChild(oldestRow);
            oldestAdded = true;
        }

        // Append transaction rows
        row.innerHTML = `
            <td>${transaction.type === 'cash' ? 'Outflow' : 'Inflow'}</td>
            <td>${transaction.category}</td>
            <td>${transaction.itemName}</td>
            <td>${transaction.amount}</td>
            <td><button onclick="openDeleteModal()"><i class="fa fa-trash"></i></button></td>
        `;

        tbody.appendChild(row);
    });

    // Update the table based on the current filter
    const activeFilter = document.querySelector('.tracker-tabs button.active').textContent.toLowerCase();
    filterTable(activeFilter);
}

// Filter table for all, expenses, or income
function filterTable(type) {
    const rows = document.querySelectorAll('#trackerTable tbody tr');

    rows.forEach(row => {
        const rowType = row.getAttribute('data-type');
        if (type === 'all' || rowType === type) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });

    // Update active button state
    const buttons = document.querySelectorAll('.tracker-tabs button');
    buttons.forEach(button => button.classList.remove('active'));
    document.querySelector(`.tracker-tabs button[onclick="filterTable('${type}')"]`).classList.add('active');
}
let transactions = []; // Array to hold the transaction records
    let deleteIndex = null; // Index of the record to be deleted

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

    // Clear the 'Add Record' Form
    function clearForm() {
        document.getElementById('itemName').value = '';
        document.getElementById('mode').value = 'cash';
        document.getElementById('category').value = 'food';
        document.getElementById('date').value = '';
        document.getElementById('amount').value = '';
    }

    // Save the record and update the table
    function saveRecord() {
        let itemName = document.getElementById('itemName').value;
        let mode = document.getElementById('mode').value;
        let category = document.getElementById('category').value;
        let date = document.getElementById('date').value;
        let amount = document.getElementById('amount').value;

        if (itemName && date && amount) {
            transactions.push({ itemName, mode, category, date, amount });
            refreshTable();
            closeModal();
            openGreatModal();
        } else {
            alert('Please fill out all fields.');
        }
    }

    // Refresh the transactions table
    function refreshTable() {
        let table = document.getElementById('trackerTable').getElementsByTagName('tbody')[0];
        table.innerHTML = '';

        transactions.forEach((transaction, index) => {
            let row = table.insertRow();
            row.insertCell().innerText = transaction.date;
            row.insertCell().innerText = transaction.itemName;
            row.insertCell().innerText = transaction.category;
            row.insertCell().innerText = transaction.amount;
            row.insertCell().innerText = transaction.mode;
            let deleteCell = row.insertCell();
            deleteCell.innerHTML = `<button onclick="setDeleteIndex(${index})">Delete</button>`;
        });
    }

    // Set the index of the record to be deleted
    function setDeleteIndex(index) {
        deleteIndex = index;
        openDeleteModal();
    }

    // Delete a record from the transactions array
    function deleteRecord() {
        if (deleteIndex !== null) {
            transactions.splice(deleteIndex, 1);
            refreshTable();
            closeDeleteModal();
        }
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
</body>

</html>
