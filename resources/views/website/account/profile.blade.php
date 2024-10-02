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
                        <img src=" {{$user->profile_pic ? asset('' . $user->profile_pic) : asset('images/user.png')}} " alt="Profile Picture" class="profile-sidebar-img">
                        <span class="label">Profile</span>
                    </li>
                </a>
            </div>
        </div>
    </div>

    <div class="main-content">
            <div class="profile-sidebar">
                <form id="profile-pic" action="{{ route('account.pic.update', $user->id) }}" method="post" enctype="multipart/form-data" >
                @csrf
                @method('PUT')
                    <div class="profile-picture-wrapper">
                        <img src=" {{$user->profile_pic ? asset('' . $user->profile_pic) : asset('images/user.png')}}  " id="profilePic" class="profile-picture">

                        <x-input-error :err="'image'" />
                        <input name="profile_pic" onchange="document.getElementById('profile-pic').submit()"  type="file" id="profilePicInput" accept=".png, .jpg, .jpeg" required>
                        <span class="icon-overlay"><i class="fas fa-camera"></i></span>
                    </div>
                    <button type="submit" id="profile-pic-btn" style="display: none">Change Photo</button>
                </form>

                <div class="profile-main">
                    <!-- Update Information Section -->
                    <div class="profile-info">
                    <div class="section">
                        <form action="{{ route('account.profile.update', $user->id) }}" method="post">
                            @csrf
                            @method('PUT')

                            <h2>UPDATE INFORMATION</h2>
                            <div class="form-group">
                                <div style="display:flex;flex-direction:column">
                                    <x-input-error :err="'name'" />
                                    <input value="{{ $user->name }}" required type="text" name="name" id="complete-name" placeholder="Complete Name"
                                    style="{{ $errors->has('name') ? 'border: solid 1px red' : '' }}">
                                </div>

                                <div style="display:flex;flex-direction:column">
                                    <x-input-error :err="'email'" />
                                    <input value="{{ $user->email }}" required type="email" name="email" id="email-address" placeholder="Email Address"
                                    style="{{ $errors->has('email') ? 'border: solid 1px red' : '' }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div style="display:flex;flex-direction:column">
                                    <x-input-error :err="'school_name'" />
                                    <input value="{{ $user->school_name }}" required type="text" name="school_name" id="school-name" placeholder="School Name"
                                    style="{{ $errors->has('school_name') ? 'border: solid 1px red' : '' }}">
                                </div>

                                <div style="display:flex;flex-direction:column">
                                <x-input-error :err="'course'" />
                                    <select required name="course" id="course"
                                    style="{{ $errors->has('course') ? 'border: solid 1px red' : '' }}"
                                    >
                                        @foreach ($courses as $course)
                                            <option @selected($user->course === $course->course ? true : false) value="{{ $course->course }}">
                                                {{$course->course}}
                                            </option>
                                        @endforeach

                                        <!-- Bachelor's Degrees -->
                                        {{-- <option @selected($user->course === 'BAA' ? true : false) value="BAA">BA in Advertising</option> --}}
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="form-buttons">
                                <button class="clear-btn" type="button" onclick="clearForm()">CLEAR</button>
                                <button class="update-btn" type="submit">UPDATE</button>
                            </div>
                        </form>
                    </div>

                    <!-- Change Password Section -->
                    <div class="section">
                        <form action="{{ route('account.password.update', $user->id) }}" method="post">
                            @csrf
                            @method('PUT')

                            <h2>CHANGE PASSWORD</h2>
                            <div class="form-group">
                                <div style="display: flex; flex-direction:column">
                                    <x-input-error :err="'current_password'" />
                                    <input type="password" name="current_password" id="current-password" placeholder="Current Password"
                                    style="{{ $errors->has('current_password') ? 'border: solid 1px red' : '' }}">
                                </div>

                                <div style="display: flex; flex-direction:column">
                                    <x-input-error :err="'new_password'" />
                                    <input type="password" name="new_password" id="new-password" placeholder="Enter New Password"
                                    style="{{ $errors->has('new_password') ? 'border: solid 1px red' : '' }}">
                                </div>

                                <div style="display: flex; flex-direction:column">
                                    <x-input-error :err="'new_password_confirmation'" />
                                    <input type="password" name="new_password_confirmation" id="confirm-password" placeholder="Confirm Password"
                                    style="{{ $errors->has('new_password_confirmation') ? 'border: solid 1px red' : '' }}">
                                </div>
                            </div>
                            <div class="form-buttons">
                                <button class="clear-btn">CLEAR</button>
                                <button class="save-btn">SAVE</button>
                            </div>
                        </form>
                    </div>

                    @if (!$user->is_admin)
                    <!-- Delete Account Section -->
                    <div class="section">
                        <h2>DELETE ACCOUNT</h2>
                        <div class="form-buttons">
                            <button type="button" class="delete-btn" style="width: fit-content" onclick="setDeleteModal()">DELETE ACCOUNT</button>

                            <div class="big-dark" style="display: none" id="big-bright">
                            <div class="deleteModal">
                                <form action="{{ route('account.suicide') }}" method="post">
                                    @csrf
                                    @method('GET')

                                    <h1>ARE YOUR SURE??</h1>
    
                                    <button type="submit" class="delete-btn" onclick="!confirm('ARE YOU SURE?') && event.preventDefault()">YES DELETE ACCOUNT</button>

                                    <button style="background-color: green;margin-top: 30px" type="button" class="delete-btn" onclick="setDeleteModal()">NO, GO BACK</button>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>

                    @else
                    <div class="section">
                        <h2>Go Back to Admin Side</h2>
                        <a href="{{ route('admin.index') }}">RETURN BACK</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        </div>
        </div>
    </div>
</body>
</html>

<script>
    function setDeleteModal(){
        if(document.getElementById('big-bright')){
            document.getElementById('big-bright').style = 'display: flex';
            document.getElementById('big-bright').id = 'big-dark';
        }
        else if(document.getElementById('big-dark')){
            document.getElementById('big-dark').style = 'display: none';
            document.getElementById('big-dark').id = 'big-bright';
        }
    }

    function clearForm(){ 
        document.getElementById('complete-name').value = '';
        document.getElementById('email-address').value = '';
        document.getElementById('school-name').value = '';
        document.getElementById('course').selectedIndex = 0;
    }
</script>