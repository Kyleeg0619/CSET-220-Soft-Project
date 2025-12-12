@extends('layout.layout')

<style>
    .showCheck {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        margin-top: 10px;
        width: fit-content;
    }
</style>

@section('template-content')

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
            <input type="password" name="password" id="passwordInput">
            <div class="showCheck"><input type="checkbox" onclick="myFunction()"><p>Show Password</p></div>
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

<script>
    function myFunction() {
  var x = document.getElementById("passwordInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>