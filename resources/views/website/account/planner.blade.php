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
    <div class="planner-frame">
        <div class="header">Welcome to your Budget Planner</div>
        <div class="budget-stats">
            <div>
                <h3>350,000.00</h3>
                <p>Expected Income</p>
            </div>
            <div>
                <h3>500,000.00</h3>
                <p>Target Income</p>
            </div>
            <div>
                <h3>150,000.00</h3>
                <p>Budget Variance</p>
            </div>
        </div>

        
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
    <button id="update-button">Update Allocation</button>
    <table id="budget-table">
        
        <tbody>
            <tr>
                <td>Food</td>
                <td class="editable">80,000.00</td>              
            </tr>
            <tr>
                <td>Rent</td>
                <td class="editable">40,000.00</td>
            </tr>
            <tr>
                <td>Transportation</td>
                <td class="editable">40,000.00</td>
            </tr>
            <tr>
                <td>Debt/Loan</td>
                <td class="editable">0.00</td>
            </tr>
            <tr>
                <td>Shopping</td>
                <td class="editable">80,000.00</td>
            </tr>
            <tr>
                <td>Mobile</td>
                <td class="editable">40,000.00</td>
            </tr>
            <tr>
                <td>Savings</td>
                <td class="editable">100,000.00</td>
            </tr>
            <tr>
                <td>School</td>
                <td class="editable">100,000.00</td>

            </tr>
            <tr>
                <td>Others</td>
                <td class="editable">80,000.00</td>
            </tr>
        </tbody>
    </table>
    </div>
</div>
</div>

<div class="tables">
<div class="head">
<h3>Expected Income</h3>
</div> 
        
      <!-- Form for adding income -->
<form id="add-income-form">
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
                <tr>
                    <td>Aug 13, 2024</td>
                    <td>Provider</td>
                    <td>35,000.00</td>
                </tr>
                <tr>
                    <td>Aug 13, 2024</td>
                    <td>Provider</td>
                    <td>35,000.00</td>
                </tr>
                <tr>
                    <td>Aug 13, 2024</td>
                    <td>Grant</td>
                    <td>30,000.00</td>
                </tr>
                <tr>
                    <td>Aug 13, 2024</td>
                    <td>Provider</td>
                    <td>35,000.00</td>
                </tr>
            </tbody>
        </table>
    </div>

    </div>
    <div class="button-container">
    <div class="reset-button">
        <p>Want to start new? Click the reset button to clear all your entries & re-create new ones.</p>
    </div>
    <button type="button" class="btn-reset">Reset Planner</button>
</div>

    </div>
    <script>
 // Handle the form submission
 document.getElementById('add-income-form').addEventListener('submit', function(event) {
        event.preventDefault();
        
        // Get form data
        const date = document.getElementById('date').value;
        const source = document.getElementById('source').value;
        const amount = document.getElementById('amount').value;
        
        // Create a new row for the table
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>${date}</td>
            <td>${source}</td>
            <td>${parseFloat(amount).toLocaleString('en-US', { style: 'currency', currency: 'USD' })}</td>
        `;
        
        // Append the new row to the table body
        document.getElementById('income-table-body').appendChild(newRow);
        
        // Clear the form fields
        document.getElementById('add-income-form').reset();
    });


// Function to make table editable
function makeTableEditable() {
    // Get all editable cells
    const editableCells = document.querySelectorAll('#budget-table .editable');

    // Loop through each cell and replace text with input field
    editableCells.forEach(cell => {
        const currentValue = cell.textContent.trim(); // Get the current value in the cell
        if (!cell.querySelector('input')) {  // Avoid duplicating inputs
            cell.innerHTML = `<input type="text" value="${currentValue}" />`; // Replace with input field
        }
    });

    // Change the "Update" button to "Save"
    const updateButton = document.getElementById('update-button');
    updateButton.textContent = 'Save';
    updateButton.id = 'save-button';

    // Add event listener for saving the edited values
    document.getElementById('save-button').addEventListener('click', saveUpdatedValues);
}

// Function to save updated values
function saveUpdatedValues() {
    // Get all input fields
    const inputFields = document.querySelectorAll('#budget-table .editable input');

    // Loop through each input field and update the cell with the new value
    inputFields.forEach(input => {
        const updatedValue = input.value.trim(); // Get the value from the input field
        const parentCell = input.parentElement;
        parentCell.textContent = updatedValue; // Update the cell with the new value
    });

    // Change the "Save" button back to "Update"
    const saveButton = document.getElementById('save-button');
    saveButton.textContent = 'Update';
    saveButton.id = 'update-button';

    // Re-attach the event listener for updating
    document.getElementById('update-button').addEventListener('click', makeTableEditable);
}

// Attach initial event listener to "Update" button
document.getElementById('update-button').addEventListener('click', makeTableEditable);

</script>
</body>

</html>
