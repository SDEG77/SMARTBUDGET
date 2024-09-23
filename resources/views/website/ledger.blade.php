<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/ledger.css') }}">
    <title>Ledger</title>
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
        <div class="content">
    <h1>LEDGER</h1>
    <p>Welcome to your central hub for managing all your financial commitments and desires. 
        Here, you'll find a comprehensive ledger that helps you keep track of what you need to buy and what you need to pay.</p>
        </div>

        <div class="filter-buttons">
            <div>
                <button onclick="filterTable('pay')" class="active">TO PAY</button>
                <button onclick="filterTable('buy')">TO BUY</button>
            </div>
            <div class="action-buttons">
                <button class="export"> EXPORT FILE</button>
                <button class="add" onclick="openModal()">ADD RECORD</button>
            </div>
        </div>

        <div id="transactionContainer">
        <div class="transaction-item highlight border-radius">
            <input type="checkbox" class="transactionCheckbox">
            <div>Aquaflask</div>
            <div>SM City Cabanatuan</div>
            <div>700.00</div>
            <div>Dec 25, 2024</div>
            <button class="delete-btn" onclick="openDeleteModal()"><i class="fa fa-trash"></i></button>
        </div>
        <div id="transactionContainer">
        <div class="transaction-item highlight border-radius">
            <input type="checkbox" class="transactionCheckbox">
            <div>Aquaflask</div>
            <div>SM City Cabanatuan</div>
            <div>700.00</div>
            <div>Dec 25, 2024</div>
            <button class="delete-btn" onclick="openDeleteModal()"><i class="fa fa-trash"></i></button>
        </div>
    <div id="transactionContainer">
        <div class="transaction-item highlight border-radius">
            <input type="checkbox" class="transactionCheckbox">
            <div>Aquaflask</div>
            <div>SM City Cabanatuan</div>
            <div>700.00</div>
            <div>Dec 25, 2024</div>
            <button class="delete-btn" onclick="openDeleteModal()"><i class="fa fa-trash"></i></button>
        </div>
        <!-- Repeat the .transaction-item div as needed -->
    </div>

    </div>

    </div>

    </div>

    <!-- Add/Edit Record Modal -->
    <div id="recordModal" class="modal record-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Add / Edit Record</h2>
                <span class="close" onclick="closeModal()">&times;</span>
            </div>
            <div class="modal-body">
                <select id="recordType">
                    <option value="unset" selected hidden disabled>Type</option>
                    <option value="pay">Pay</option>
                    <option value="buy">Buy</option>
                </select>
                <input type="text" id="itemName" placeholder="What">
                <input type="text" id="where" placeholder="Where">
                <input type="date" id="when" placeholder="When">
                <input type="number" id="amount" placeholder="Amount">
            </div>
            <div class="modal-footer">
                <button class="clear-btn" onclick="clearForm()">Clear</button>
                <button class="save-btn" onclick="saveRecord()">Save</button>
            </div>
        </div>
    </div>

    <!-- GREAT Confirmation Modal -->
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
    // Function to open and close modals
    function openModal() {
        document.getElementById('recordModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('recordModal').style.display = 'none';
    }

    function openGreatModal() {
        document.getElementById('greatModal').style.display = 'flex';
    }

    function closeGreatModal() {
        document.getElementById('greatModal').style.display = 'none';
    }

    function openDeleteModal() {
        document.getElementById('deleteModal').style.display = 'flex';
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').style.display = 'none';
    }


// Toggle row highlight on checkbox click
function toggleHighlight(checkbox) {
    const row = checkbox.closest('.transaction-item'); // Get the closest row (div with class transaction-item)
    if (checkbox.checked) {
        row.classList.add('faded'); // Add faded class when checked
    } else {
        row.classList.remove('faded'); // Remove faded class when unchecked
    }
}

// Add event listeners to checkboxes on page load
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.transactionCheckbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            toggleHighlight(this);
        });
    });
});


function saveRecord() {
    const recordType = document.getElementById('recordType').value;
    const itemName = document.getElementById('itemName').value;
    const where = document.getElementById('where').value;
    const when = document.getElementById('when').value;
    const amount = document.getElementById('amount').value;

    if (recordType && itemName && where && when && amount) {
        const container = document.getElementById('transactionContainer');
        const item = document.createElement('div');
        item.classList.add('transaction-item', 'highlight', 'border-radius');  // Ensure the same classes

        item.innerHTML = `
            <input type="checkbox" class="transactionCheckbox">
            <div>${itemName}</div>
            <div>${where}</div>
            <div>${amount}</div>
            <div>${when}</div>
            <button class="delete-btn" onclick="openDeleteModal()"><i class="fa fa-trash"></i></button>
        `;

        container.prepend(item);

        // Re-attach the event listener for the new checkbox
        const newCheckbox = item.querySelector('.transactionCheckbox');
        newCheckbox.addEventListener('change', function() {
            toggleHighlight(this);
        });

        // Clear the form and close the modal
        clearForm();
        closeModal();
        openGreatModal();
    } else {
        alert('Please fill out all fields.');
    }
}

function clearForm() {
    document.getElementById('recordType').value = '';
    document.getElementById('itemName').value = '';
    document.getElementById('where').value = '';
    document.getElementById('when').value = '';
    document.getElementById('amount').value = '';
}

    // Handle delete confirmation
    function confirmDelete() {
        const table = document.getElementById('transactionTable');
        const selectedRows = document.querySelectorAll('.transactionCheckbox:checked');
        selectedRows.forEach(checkbox => {
            const row = checkbox.closest('tr');
            table.removeChild(row);
        });
        closeDeleteModal();
        alert('Items deleted successfully!');
    }

    // Filter table by type
    function filterTable(type) {
        const rows = document.querySelectorAll('#transactionTable .transaction-row');
        rows.forEach(row => {
            if (type === 'all' || row.getAttribute('data-type') === type) {
                row.closest('tr').style.display = '';
            } else {
                row.closest('tr').style.display = 'none';
            }
        });

        // Update button active states
        document.querySelectorAll('.filter-buttons button').forEach(button => {
            button.classList.remove('active');
        });
        document.querySelector(`.filter-buttons button[onclick="filterTable('${type}')"]`).classList.add('active');

        // Save selected filter to localStorage
        localStorage.setItem('selectedFilter', type);
    }

    // Apply the saved filter after page reload
    document.addEventListener('DOMContentLoaded', function() {
        const savedFilter = localStorage.getItem('selectedFilter') || 'pay';
        filterTable(savedFilter);

        // Attach event listeners to existing checkboxes (if any)
        document.querySelectorAll('.transactionCheckbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                toggleHighlight(this);
            });
        });
    });
</script>