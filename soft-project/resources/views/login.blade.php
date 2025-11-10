@extends('layout.layout')
@section('content')

    <section>
            <div class="form-section">
        <form action="/verifyLogin" method="post" class="register-form">
            @csrf
            <h1>Login</h1>
            <p>Welcome Back</p>
            <hr>
            <select name="role">
                <option value="employee" selected>Employee</option>
                <option value="admin">Admin</option>
            </select>
            <label for="email">Email: </label>
            <input type="text" name="email">
            <label for="">Password: </label>
            <input type="text" name="password">
            @if(session('warning'))
            <p class="warning">{{ session('warning') }}</p>
            @endif
            <button type="submit" class="form-submit">Login</button>
        </form>
        <div class="form-img">
            <img src="{{ asset('images/tech-effect.png') }}" alt="" id="tech-effect">
        </div>
    </div>
    </section>

@endsection