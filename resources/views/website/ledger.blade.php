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
                <button class="active">TO PAY</button>
                <button>TO BUY</button>
            </div>
            <div class="action-buttons">
                <button id="multi-delete-btn" onclick="cancel()" style="display: {{$ledgers->count() > 0 ? 'inline-block' : 'hidden'}}">Delete Selected</button>

                <button class="export"> EXPORT FILE</button>
                <button class="add" onclick="openModal()">ADD RECORD</button>
            </div>
        </div>

            @if ($ledgers->count() > 0)
                @foreach ($ledgers as $ledger)
                    <div id="transactionContainer">
                        <div style="pointer-events: all" class="transaction-item highlight border-radius {{$ledger->checked === 0 ? null : 'faded'}}">
                            
                            <form id="form-{{$ledger->id}}" class="multi-check-form"  action="{{ route('ledger.check', $ledger->id) }}" method="post">
                                @csrf
                                @method('PUT')

                                <input onchange="document.getElementById('form-{{$ledger->id}}').submit()" {{$ledger->checked ? 'checked' : null}} type="checkbox" class="transactionCheckbox">
                                <input type="hidden" name="ninja_check" value="{{$ledger->checked}}">
                                <input type="hidden" name="ninja" value="{{$ledger->id}}">
                            </form>
                            <div>{{$ledger->what}}</div>
                            <div>{{$ledger->where}}</div>
                            <div>{{$ledger->amount}}</div>
                            <div>{{$ledger->when}}</div>

                        
                            <button type="button" class="edit-btn" onclick="openEditModal('{{$ledger->id}}'); "><i class="fa-solid fa-pen-to-square"></i></button>
                            <button type="button" class="delete-btn" onclick="openDeleteModal('{{$ledger->id}}'); "><i class="fa fa-trash"></i></button>      
                        </div>
                    </div>

                    <form action="{{ route('ledger.delete', $ledger->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        
                        <!-- Delete Confirmation Modal -->
                        <div id="deleteModal-{{$ledger->id}}" class="modal delete-modal">
                            <div class="modal-content">
                                <i class="fa-solid fa-triangle-exclamation"></i>
                                <div class="modal-header">
                                    <h2>Oh no! {{$ledger->what}}</h2>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this item?</p>
                                    <div class="modal-footer">
                                        <button class="clear-btn" type="submit" onclick="alert('Record deleted successfully!');">Yes</button>
                                        <button class="save-btn" onclick="event.preventDefault(); closeDeleteModal('{{$ledger->id}}')">No</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <form action="{{ route('ledger.update', $ledger->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        
                        <!-- Edit Confirmation Modal -->
                        <div id="editModal-{{$ledger->id}}" style="display: none" class="modal delete-modal">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h2>Edit Record</h2>
                            </div>
                            <div class="modal-body" style="display: flex; flex-direction:column">
                                <select name="type" required>
                                    <option value="{{$ledger->type}}" disabled selected>Choose Type (previous: {{$ledger->type}})</option>
                                    <option value="pay">To Pay</option>
                                    <option value="buy">To Buy</option>
                                </select>

                                <label for="what">What:</label>        
                                <input required type="text" name="what" value="{{$ledger->what}}" placeholder="What">
                                
                                <label for="where">Where:</label>        
                                <input required type="text" name="where" value="{{$ledger->where}}" placeholder="Where">
                                
                                <label for="when">When:</label>        
                                <input required type="date" name="when" value="{{$ledger->when}}" placeholder="When">
                                
                                <label for="amount">Amount:</label>        
                                <input required type="number" name="amount" value="{{$ledger->amount}}" placeholder="Amount">
                                
                                <div class="modal-footer">
                                    <button class="clear-btn" type="submit" onclick="alert('Record updated successfully!');">Save Changes</button>
                                    <button type="button" class="save-btn" onclick="event.preventDefault(); closeEditModal('{{$ledger->id}}')">Close</button>
                                </div>
                            </div>
                            </div>
                        </div>
                    </form>
                @endforeach
            @endif
        </div>        
    </div>

    </div>

    </div>

    </div>

    <!-- Add Record Modal -->
    <div id="recordModal" class="modal record-modal">
        <form action="{{route('ledger.store')}}" method="POST">
            @csrf
            
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Add</h2>
                    <span class="close" onclick="closeModal()">&times;</span>
                </div>
                <div class="modal-body">
                    <select required name="type" id="recordType">
                        <option value="unset" selected hidden disabled>Type</option>
                        <option value="pay">Pay</option>
                        <option value="buy">Buy</option>
                    </select>
                    <input type="text" id="itemName" required name="what" placeholder="What">
                    <input type="text" id="where" required name="where" placeholder="Where">
                    <input type="date" id="when" required name="when" placeholder="When">
                    <input type="number" id="amount" required name="amount" placeholder="Amount">
                </div>
                <div class="modal-footer">
                    <button class="clear-btn" type="reset">Clear</button>
                    <button class="save-btn" onclick="e.preventDefault(); this.closest('form').submit()" type="submit">Save</button>
                </div>
            </div>
        </form>
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

    function openDeleteModal(id) {
        let dynamo = `deleteModal-${id}`;

        document.getElementById(dynamo).style.display = 'flex';
    }

    function closeDeleteModal(id) {
        let dynamo = `deleteModal-${id}`;

        document.getElementById(dynamo).style.display = 'none';
    }

    function openEditModal(id) {
        let dynamo = `editModal-${id}`;

        document.getElementById(dynamo).style.display = 'flex';
    }

    function closeEditModal(id) {
        let dynamo = `editModal-${id}`;

        document.getElementById(dynamo).style.display = 'none';
    }



// Toggle row highlight on checkbox click
function toggleHighlight(checkbox) {
    const row = checkbox.closest('.transaction-item'); // Get the closest row (div with class transaction-item)

    if (checkbox.checked) {
        row.classList.add('faded'); // Add faded class when checked
    } 
    if (!checkbox.checked) {
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
</script>