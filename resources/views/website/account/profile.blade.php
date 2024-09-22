<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <title>Expandable Dashboard with Profile</title>
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
            <div class="profile-sidebar">
                <div class="profile-picture-wrapper">
                    <img src="{{ asset('images/user.png') }}" id="profilePic" class="profile-picture">
                    <input type="file" id="profilePicInput" class="hidden" accept="image/*">
                    <span class="icon-overlay"><i class="fas fa-camera"></i></span>
                </div>

                <div class="profile-main">
                    <!-- Update Information Section -->
                    <div class="profile-info">
                    <div class="section">
                        <h2>UPDATE INFORMATION</h2>
                        <div class="form-group">
                            <input type="text" id="complete-name" placeholder="Complete Name">
                            <input type="email" id="email-address" placeholder="Email Address">
                        </div>
                        <div class="form-group">
                            <input type="text" id="school-name" placeholder="School Name">
                            <select id="course">
                                <option>Bachelor of Science in Information Technology</option>
                                <!-- Add more options here -->
                            </select>
                        </div>
                        <div class="form-buttons">
                            <button class="clear-btn">CLEAR</button>
                            <button class="update-btn">UPDATE</button>
                        </div>
                    </div>

                    <!-- Change Password Section -->
                    <div class="section">
                        <h2>CHANGE PASSWORD</h2>
                        <div class="form-group">
                            <input type="password" id="current-password" placeholder="Current Password">
                            <input type="password" id="new-password" placeholder="Enter New Password">
                            <input type="password" id="confirm-password" placeholder="Confirm Password">
                        </div>
                        <div class="form-buttons">
                            <button class="clear-btn">CLEAR</button>
                            <button class="save-btn">SAVE</button>
                        </div>
                    </div>

                    <!-- Delete Account Section -->
                    <div class="section">
                        <h2>DELETE ACCOUNT</h2>
                        <div class="form-buttons">
                            <button class="delete-btn">DELETE ACCOUNT</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </div>
</body>
</html>

<script>
    // Handle profile picture change
    document.getElementById("profilePic").addEventListener("click", function () {
        document.getElementById("profilePicInput").click();
    });

    document.getElementById("profilePicInput").addEventListener("change", function (event) {
        const file = event.target.files[0]; // Get the selected file
        if (file) {
            const reader = new FileReader(); // Create a new FileReader object
            reader.onload = function (e) {
                // Update both the main profile and sidebar images with the new source
                document.getElementById("profilePic").src = e.target.result;
                document.getElementById("sidebarProfilePic").src = e.target.result;
            };
            reader.readAsDataURL(file); // Read the file as a data ROUTE
        }
    });
</script>