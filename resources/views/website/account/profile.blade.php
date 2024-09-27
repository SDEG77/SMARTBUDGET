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
                                    <x-input-error :err="'full_name'" />
                                    <input value="{{ $user->full_name }}" required type="text" name="full_name" id="complete-name" placeholder="Complete Name"
                                    style="{{ $errors->has('full_name') ? 'border: solid 1px red' : '' }}">
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
                                        <!-- Bachelor's Degrees -->
                                        <option @selected($user->course === 'BAA' ? true : false) value="BAA">BA in Advertising</option>
                                        <option @selected($user->course === 'BAC' ? true : false) value="BAC">BA in Communication</option>
                                        <option @selected($user->course === 'BAE' ? true : false) value="BAE">BA in English</option>
                                        <option @selected($user->course === 'BAIS' ? true : false) value="BAIS">BA in International Studies</option>
                                        <option @selected($user->course === 'BAPS' ? true : false) value="BAPS">BA in Political Science</option>
                                        <option @selected($user->course === 'BAP' ? true : false) value="BAP">BA in Psychology</option>
                                        <option @selected($user->course === 'BAS' ? true : false) value="BAS">BA in Sociology</option>
                                        <option @selected($user->course === 'BEEd' ? true : false) value="BEEd">BEEd in Elementary Education</option>
                                        <option @selected($user->course === 'BSEdE' ? true : false) value="BSEdE">BSEd in English</option>
                                        <option @selected($user->course === 'BSEdF' ? true : false) value="BSEdF">BSEd in Filipino</option>
                                        <option @selected($user->course === 'BSEdM' ? true : false) value="BSEdM">BSEd in Mathematics</option>
                                        <option @selected($user->course === 'BSEdS' ? true : false) value="BSEdS">BSEd in Science</option>
                                        <option @selected($user->course === 'BSA' ? true : false) value="BSA">BS in Accountancy</option>
                                        <option @selected($user->course === 'BSAgr' ? true : false) value="BSAgr">BS in Agriculture</option>
                                        <option @selected($user->course === 'BArch' ? true : false) value="BArch">BS in Architecture</option>
                                        <option @selected($user->course === 'BSAvi' ? true : false) value="BSAvi">BS in Aviation</option>
                                        <option @selected($user->course === 'BSBio' ? true : false) value="BSBio">BS in Biology</option>
                                        <option @selected($user->course === 'BSChE' ? true : false) value="BSChE">BS in Chemical Engineering</option>
                                        <option @selected($user->course === 'BSChem' ? true : false) value="BSChem">BS in Chemistry</option>
                                        <option @selected($user->course === 'BSCivE' ? true : false) value="BSCivE">BS in Civil Engineering</option>
                                        <option @selected($user->course === 'BSCompE' ? true : false) value="BSCompE">BS in Computer Engineering</option>
                                        <option @selected($user->course === 'BSCS' ? true : false) value="BSCS">BS in Computer Science</option>
                                        <option @selected($user->course === 'BSCrim' ? true : false) value="BSCrim">BS in Criminology</option>
                                        <option @selected($user->course === 'BSEE' ? true : false) value="BSEE">BS in Electrical Engineering</option>
                                        <option @selected($user->course === 'BSECE' ? true : false) value="BSECE">BS in Electronics and Communications Engineering</option>
                                        <option @selected($user->course === 'BSES' ? true : false) value="BSES">BS in Environmental Science</option>
                                        <option @selected($user->course === 'BSHM' ? true : false) value="BSHM">BS in Hospitality Management</option>
                                        <option @selected($user->course === 'BSIE' ? true : false) value="BSIE">BS in Industrial Engineering</option>
                                        <option @selected($user->course === 'BSIT' ? true : false) value="BSIT">BS in Information Technology</option>
                                        <option @selected($user->course === 'BSME' ? true : false) value="BSME">BS in Marine Engineering</option>
                                        <option @selected($user->course === 'BSMT' ? true : false) value="BSMT">BS in Maritime Transportation</option>
                                        <option @selected($user->course === 'BSN' ? true : false) value="BSN">BS in Nursing</option>
                                        <option @selected($user->course === 'BSND' ? true : false) value="BSND">BS in Nutrition and Dietetics</option>
                                        <option @selected($user->course === 'BSP' ? true : false) value="BSP">BS in Pharmacy</option>
                                        <option @selected($user->course === 'BSPT' ? true : false) value="BSPT">BS in Physical Therapy</option>
                                        <option @selected($user->course === 'BSPsy' ? true : false) value="BSPsy">BS in Psychology</option>
                                        <option @selected($user->course === 'BSREM' ? true : false) value="BSREM">BS in Real Estate Management</option>
                                        <option @selected($user->course === 'BSTM' ? true : false) value="BSTM">BS in Tourism Management</option>
                                        <option @selected($user->course === 'BSBABM' ? true : false) value="BSBABM">BSBA in Banking & Microfinance</option>
                                        <option @selected($user->course === 'BSBAFM' ? true : false) value="BSBAFM">BSBA in Financial Management</option>
                                        <option @selected($user->course === 'BSBAHR' ? true : false) value="BSBAHR">BSBA in Human Resource Management</option>
                                        <option @selected($user->course === 'BSBAMM' ? true : false) value="BSBAMM">BSBA in Marketing Management</option>
                                        <option @selected($user->course === 'BSNE' ? true : false) value="BSNE">BSNE in Special Needs Education</option>
                                        <option @selected($user->course === 'CulArt' ? true : false) value="CulArt">Culinary Arts</option>
                                        <option @selected($user->course === 'DataSci' ? true : false) value="DataSci">Data Science</option>
                                        <option @selected($user->course === 'DigMark' ? true : false) value="DigMark">Digital Marketing</option>
                                        <option @selected($user->course === 'FashDes' ? true : false) value="FashDes">Fashion Design</option>
                                        <option @selected($user->course === 'FineArt' ? true : false) value="FineArt">Fine Arts</option>
                                        <option @selected($user->course === 'GraphDes' ? true : false) value="GraphDes">Graphic Design</option>
                                        <option @selected($user->course === 'InfoSys' ? true : false) value="InfoSys">Information Systems</option>
                                        <option @selected($user->course === 'IntDes' ? true : false) value="IntDes">Interior Design</option>
                                        <option @selected($user->course === 'MultArts' ? true : false) value="MultArts">Multimedia Arts</option>
                                        <option @selected($user->course === 'TESOL' ? true : false) value="TESOL">TESOL</option>
                                        <option @selected($user->course === 'WebDev' ? true : false) value="WebDev">Web Development</option>

                                        <!-- Master's Degrees -->
                                        <option @selected($user->course === 'MAEd' ? true : false) value="MAEd">MA in Education</option>
                                        <option @selected($user->course === 'MBA' ? true : false) value="MBA">MBA</option>
                                        <option @selected($user->course === 'MPA' ? true : false) value="MPA">Master of Public Administration</option>
                                        <option @selected($user->course === 'MSIT' ? true : false) value="MSIT">MS in Information Technology</option>
                                        <option @selected($user->course === 'MSN' ? true : false) value="MSN">MS in Nursing</option>
                                        <option @selected($user->course === 'PM' ? true : false) value="PM">Project Management</option>

                                        <!-- Doctoral Degrees -->
                                        <option @selected($user->course === 'DBA' ? true : false) value="DBA">DBA</option>
                                        <option @selected($user->course === 'JD' ? true : false) value="JD">Doctor of Jurisprudence (Law)</option>
                                        <option @selected($user->course === 'MD' ? true : false) value="MD">MD</option>
                                        <option @selected($user->course === 'PhDEd' ? true : false) value="PhDEd">PhD in Education</option>
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

                    <!-- Delete Account Section -->
                    <div class="section">
                        <h2>DELETE ACCOUNT</h2>
                        <div class="form-buttons">
                            <form action="{{ route('account.suicide') }}" method="post">
                                @csrf
                                @method('GET')

                                <button type="submit" class="delete-btn" onclick="!confirm('ARE YOU SURE?') && event.preventDefault()">DELETE ACCOUNT</button>
                            </form>
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
    function clearForm(){ 
        document.getElementById('complete-name').value = '';
        document.getElementById('email-address').value = '';
        document.getElementById('school-name').value = '';
        document.getElementById('course').selectedIndex = 0;
    }
</script>