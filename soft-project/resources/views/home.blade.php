<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Template</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://use.typekit.net/amw7ext.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <nav>
        <div class="logo-title">
            <img id="logo" src="{{ asset('images/DKG-logo.png') }}" alt=":DKG logo">
        </div>
        <div>
            <img src="{{ asset('images/open-menu.png') }}" alt="" width="50px" id="menu-icon">
        </div>
    </nav>
    <div class="nav-links">
        <a href="">Home</a>
        <hr class="nav-spacer">
        <a href="">Register</a>
        <hr class="nav-spacer">
        <a href="">Courses</a>
        <hr class="nav-spacer">
        <a href="">Majors</a>
    </div>

    <main>
    <h3 style="text-align:center">Make the Intelligent Decision. Use our Smart Human Resources Services!</h3>
    <div class="home_section">
        <div class="home_section_half">
            <img src="{{asset('images/big_brain.jpg')}}" width=400px alt="Transcendant Levels of Intelligence">
        </div>
        <div class="home_section_half">
            <p>Our Smart HR System provides a simple, yet effective method for managing companies! Add, edit, and fire employees with ease! Approve requests for time off, check your company's employee-related statistics, and raise your employees' wages, all with a few simple clicks. Allow your employees to clock in and out in but a moment with our intuitive design.</p>
        </div>
    </div>
    <h3 style="text-align:center">Easy Company Management</h3>
    <div class="home_section">
    <div class="home_section_half"><p>Our website's intuitive home management system allows for simple management of your employees! View the statistics of your company's employees with the greatest of ease! Update salaries and roles in no time! Approve or decline requests of leave in an instant!</p></div>
    <div class="home_section_half" style="background-image:url({{asset('images/tech-effect_home_2.png')}})"><img src="{{asset('images/business_man_on_computer.jpg')}}" height=300px width=250px alt="A Business Man on a Computer"></div>
    </div>
    <h3 style="text-align:center">Employee Empowerment</h3>
    <div class="home_section">
    <div class="home_section_half" style="background-image:url({{asset('images/tech-effect_home_1.png')}})">
    <img src="{{asset('images/employees.jpg')}}" width=300px height=200px>
    </div>
    <div class="home_section_half">
    <p>With our simple system for employees, they will be able to spend less time logging and more time working! Clock in and out in no time! Check out your salary and locate other basic details easily!</p>
    </div>
    </div>
    <h3 style="text-align:center">Our Satisfied Customers!</h3>
    <div class="review_section">
    <div class="review" style="background-image:linear-gradient(rgba(0,0,0,0.3),rgba(0,0,0,0.3)),url({{asset('images/saxton_hale_profile.png')}})">
    <div class="review_comment"><p>"Smart-HR's management system's great, mate! Thanks to it, I can always appropriately assign my workers, giving me more time for what I really enjoy: punching endangered animals into extinction!"</p></div>
    Saxton Hale<br>CEO of Mann Co
    </div>
    <div class="review" style="background-image:linear-gradient(rgba(0,0,0,0.3),rgba(0,0,0,0.3)),url({{asset('images/victor_veloci_profile.png')}})">
    <div class="review_comment"><p>"Smart-HR is the perfect system for my large-scale business. Thanks to it, I can direct my employees in my plans to create a Second Mesozoic Era and capture those PERFECT DINOSA... uhhh, I mean, release my highly healthy bio-engineered chicken feed and donate money to orphanages!"</p></div>
    Victor Veloci<br>CEO of Raptordyne
    </div>
    <div class="review" style="background-image:linear-gradient(rgba(0,0,0,0.3),rgba(0,0,0,0.3)),url({{asset('images/nute_gunray_profile.png')}})">
    <div class="review_comment"><p>"Smart-HR is a lifesaver! With it, I can find exactly how to underpay my employees, providing me with more time to guide my droids and plot revenge against the Jedi and Senator Amidala! Thank you, Smart-HR, you are truly a manager's best friend!"</p></div>
    Nute Gunray<br>Viceroy of the Trade Federation
    </div>
    </div>  
    </main>

    <footer>
        <section class="social-contacts">
            <img src="{{ asset('images/DKG-logo.png') }}" alt="" width="200px">
            <div class="socials">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                    <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z"/>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
              <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.01 2.01 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.01 2.01 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31 31 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.01 2.01 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A100 100 0 0 1 7.858 2zM6.4 5.209v4.818l4.157-2.408z"/>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
              <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
              <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
              <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/>
            </svg>
            </div>
        </section>
        <section>
        </section>
    </footer>
{{-- @vite('resources/js/app.js') --}}
<script>
    function showMenu() {
    document.getElementById("menu-icon").addEventListener('click',function(){
        document.querySelector('.nav-links').classList.toggle('visible');
    });
}

showMenu();</script>
</body>
</html>