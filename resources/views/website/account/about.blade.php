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
            <a href="{{ url('dashboard') }}">
                <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-house"></i>
                    <span class="label">Home</span>
                </li>
            </a>
            <a href="{{ url('tracking') }}">
                <li class="{{ Request::is('tracking') ? 'active' : '' }}">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    <span class="label">Tracker</span>
                </li>
            </a>
            <a href="{{ url('ledger') }}">
                <li class="{{ Request::is('ledger') ? 'active' : '' }}">
                    <i class="fa-regular fa-star"></i>
                    <span class="label">Ledger</span>
                </li>
            </a>
            <a href="{{ url('planner') }}">
                <li class="{{ Request::is('planner') ? 'active' : '' }}">
                    <i class="fa-solid fa-calendar-days"></i>
                    <span class="label">Planner</span>
                </li>
            </a>
            <a href="{{ url('about') }}">
                <li class="{{ Request::is('about') ? 'active' : '' }}">
                    <i class="fa-solid fa-circle-info"></i>
                    <span class="label">About</span>
                </li>
            </a>
        </ul>
        <div class="down-sidebar">
            <a href="{{ url('welcome') }}">
                <li class="{{ Request::is('welcome') ? 'active' : '' }}">
                    <i class="fa-solid fa-right-from-bracket"></i>
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
                    <img src="{{ asset('images/ferry.jpg') }}" alt="John Ferry">
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
                    <img src="{{ asset('images/moreno.jpg') }}" alt="Daniel Moreno">
                </div>
                <h3>Daniel Mreno<br>
                QA</h3>
                
                <p>Bachelor of Science in Information Technology<br>
BSIT3-S3 | System Development<br>
jnsantiago.au@phinmaed.com<br>
www.facebook.com/johnniebre<br>
0929-619-9578</p>
            </div>
            <div class="team-member">
                <div class="image-container">
                    <img src="{{ asset('images/jaira.jpg') }}" alt="Jaira Braza">
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
                    <img src="{{ asset('images/sg.jpg') }}" alt="Sigrae Gabriele">
                </div>
                <h3>Sigare Gabriele<br>
                Backend</h3>
                
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
