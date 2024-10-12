<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
    <title>About Us</title>
</head> 
    <body>
    <div class="sidebar">
        <div class="menu-sidebar">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
            <ul>
                <h4>Menu</h4>
                <a href="{{ route('dashboard') }}">
                    <li class="{{ Request::is('SmartBudget/dashboard') ? 'active' : '' }}">
                        <i class="fa-solid fa-house"></i>
                        <span class="label">Home</span>
                    </li>
                </a>
                <a href="{{ route('tracking') }}">
                    <li class="{{ Request::is('SmartBudget/tracking') ? 'active' : '' }}">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                        <span class="label">Tracker</span>
                    </li>
                </a>
                <a href="{{ route('ledger') }}">
                    <li class="{{ Request::is('SmartBudget/ledger') ? 'active' : '' }}">
                        <i class="fa-regular fa-star"></i>
                        <span class="label">Ledger</span>
                    </li>
                </a>
                <a href="{{ route('planner') }}">
                    <li class="{{ Request::is('SmartBudget/planner') ? 'active' : '' }}">
                        <i class="fa-solid fa-calendar-days"></i>
                        <span class="label">Planner</span>
                    </li>
                </a>
                <a href="{{ route('about') }}">
                    <li class="{{ Request::is('SmartBudget/about') ? 'active' : '' }}">
                        <i class="fa-solid fa-circle-info"></i>
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

    <div class="main-content">
        <!-- Creators Section -->
        <div class="header">ABOUT US</div>
        <div class="text"> 
            Welcome to the "About Us" page! Here, you'll get to know the story behind our mission, 
            values, and the team that makes it all happen. We're passionate about providing you with tools and 
            resources to manage your finances seamlessly and effectively.
        </div>

        <section class="team">
            <div class="team-members">
                <div class="team-member">
                    <div class="image-container">
                        <img src="{{ asset('images/ferry.png') }}" alt="John Ferry">
                    </div>
                    <h3>John Ferry<br>
                    Project Manager</h3>
                    
                    <p>Bachelor of Science in Information Technology<br>
    BSIT3-S3 | System Development<br>
    jnsantiago.au@phinmaed.com<br>
    www.facebook.com/johnniebre<br>
    0929-619-9578</p>
                
                </div>
                <div class="team-member">
                    <div class="image-container">
                        <img src="{{ asset('images/daniel.png') }}" alt="Daniel Moreno">
                    </div>
                    <h3>Daniel Moreno<br>
                    QA</h3>
                    
                    <p>Bachelor of Science in Information Technology<br>
    BSIT3-S3 | System Development<br>
    jnsantiago.au@phinmaed.com<br>
    www.facebook.com/johnniebre<br>
    0929-619-9578</p>
                </div>
                <div class="team-member">
                    <div class="image-container">
                        <img src="{{ asset('images/jaira.png') }}" alt="Jaira Braza">
                    </div>
                    <h3>Jaira Braza<br>
                    Front End</h3>
                    
                    <p>Bachelor of Science in Information Technology<br>
    BSIT3-S1 | System Development<br>
    jaar.braza.au@phinmaed.com<br>
    facebook.com/kim.jaira.37<br>
    0953-175-2164</p>
                </div>
                <div class="team-member">
                    <div class="image-container">
                        <img src="{{ asset('images/sigrae.png') }}" alt="Sigrae Gabriele">
                    </div>
                    <h3>Sigrae Derf Gabriel<br>Backend</h3>
                    
                    <p>Bachelor of Science in Information Technology<br>
    BSIT3-S1 | System Development<br>
    jnsantiago.au@phinmaed.com<br>
    www.facebook.com/johnniebre<br>
    0929-619-9578</p>
                </div>
            </div>
        </section>
        <div class="quote">“Who We Are and What Drives Us”</div>
    </div>
</body>
</html>
