@extends('layout.layout')
@section('content')

    <section class="home">
    <h3 style="text-align:center;margin-top:25px;">Make the Intelligent Decision. Use our Smart Human Resources Services!</h3>
    <div class="home_section">
        <div class="home_section_half">
            <img src="{{asset('images/big_brain.jpg')}}" width=400px alt="Transcendant Levels of Intelligence">
        </div>
        <div class="home_section_half">
            <p>Our Smart HR System provides a simple, yet effective method for managing companies! Add, edit, and fire employees with ease! Approve requests for time off, check your company's employee-related statistics, and raise your employees' wages, all with a few simple clicks. Allow your employees to clock in and out in but a moment with our intuitive design.</p>
            <a href="/login" class="approve">Login</a>
        </div>
    </div>
    <div class="home_section">
    <div class="home_section_half">
        <h3 style="text-align:center">Easy Company Management</h3>
        <p>Our website's intuitive home management system allows for simple management of your employees! View the statistics of your company's employees with the greatest of ease! Update salaries and roles in no time! Approve or decline requests of leave in an instant!</p>
    </div>
    <div class="home_section_half" style="background-image:url({{asset('images/tech-effect_home_2.png')}})"><img src="{{asset('images/business_man_on_computer.jpg')}}" height=300px width=250px alt="A Business Man on a Computer"></div>
    </div>
    <div class="home_section">
    <div class="home_section_half" style="background-image:url({{asset('images/tech-effect_home_1.png')}})">
    <img src="{{asset('images/employees.jpg')}}" width=300px height=200px>
    </div>
    <div class="home_section_half">
    <h3 style="text-align:center">Employee Empowerment</h3>
    <p>With our simple system for employees, they will be able to spend less time logging and more time working! Clock in and out in no time! Check out your salary and locate other basic details easily!</p>
    </div>
    </div>
    <h3 style="text-align:center;margin-top:25px;">Our Satisfied Customers!</h3>
    <div class="review_section">
    <div class="review" style="background-image:linear-gradient(rgba(0,0,0,0.3),rgba(0,0,0,0.3)),url({{asset('images/saxton_hale_profile.png')}})">
    <div class="review_comment"><p>"Smart-HR's management system's great, mate! Thanks to it, I can always appropriately assign my workers, giving me more time for what I really enjoy: punching endangered animals into extinction!"</p></div>
    Saxton Hale<br>CEO of Mann Co
    </div>
    <div class="review center_comment" style="background-image:linear-gradient(rgba(0,0,0,0.3),rgba(0,0,0,0.3)),url({{asset('images/victor_veloci_profile.png')}});">
    <div class="review_comment"><p>"Smart-HR is the perfect system for my large-scale business. Thanks to it, I can direct my employees in my plans to create a Second Mesozoic Era and capture those PERFECT DINOSA... uhhh, I mean, release my highly healthy bio-engineered chicken feed and donate money to orphanages!"</p></div>
    Victor Veloci<br>CEO of Raptordyne
    </div>
    <div class="review" style="background-image:linear-gradient(rgba(0,0,0,0.3),rgba(0,0,0,0.3)),url({{asset('images/nute_gunray_profile.png')}})">
    <div class="review_comment"><p>"Smart-HR is a lifesaver! With it, I can find exactly how to underpay my employees, providing me with more time to guide my droids and plot revenge against the Jedi and Senator Amidala! Thank you, Smart-HR, you are truly a manager's best friend!"</p></div>
    Nute Gunray<br>Viceroy of the Trade Federation
    </div>
    </div>  
    </section>

@endsection