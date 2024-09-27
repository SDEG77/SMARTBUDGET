<x-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <div class="container">
        <h2>SIGN UP</h2>
        <div>
            @if ($errors->any())
                @foreach ($errors->all() as $item)
                    <p>{{$item}}</p>
                @endforeach
            @endif
        </div>

        <form id="signup-form" action="{{route('register.store')}}" method="POST">
            @csrf
            <x-input-error :err="'full_name'"></x-input-error>
            <input type="text" name="full_name" placeholder="Complete Name" required style="{{$errors->has('full_name') ? 'border: solid 1px red' : ''}}" value="{{old('name')}}">

            <x-input-error :err="'email'"></x-input-error>
            <input type="email" name="email" placeholder="Email Address" required style="{{$errors->has('email') ? 'border: solid 1px red' : ''}}" value="{{old('email')}}">
            
            <x-input-error :err="'password'"></x-input-error>
            <input type="password" name="password" placeholder="Create Password" required style="{{$errors->has('password') ? 'border: solid 1px red' : ''}}">
            <input type="password" name="password_confirmation" placeholder="Confirm Password" required style="{{$errors->has('password') ? 'border: solid 1px red' : ''}}">
            <button type="submit">Submit</button>
        </form>


        <div class="login-link">
            <p>Already have an account? <a style="color: blue" href="{{ url('SmartBudget/login') }}">LOGIN</a></p>
        </div>
    </div>
</x-layout>
