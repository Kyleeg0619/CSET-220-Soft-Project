@extends('layout.layout')
@section('content')
    <section class="home">
        <div class="banner">
            <div class="banner-content">
                <div class="banner-text">
                    <h1>Put Workforce Understanding to Work with Smart HR</h1>
                    <p>Smart HR is the workforce operating platform that empowers your front line and connects your front office. With powerful technology and actionable insights, it helps you solve challenges in any moment—across every industry.</p>
                </div>
                <video autoplay muted loop>
                    <source src="{{ asset('images/banner-bg.mp4') }}">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
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
    <div class="home_section graphic-section">
    <div class="home_section_half">
        <h3 style="text-align:center">Seamless Clock-In Experience</h3>
        <p>Give your team the power to clock in and out instantly with our user-friendly design. Reduce errors and save valuable time by streamlining attendance tracking into one simple step. Update salaries and roles in no time! Approve or decline requests of leave in an instant!</p>
    </div>
    <div class="home_section_half" style="background-image:url({{asset('images/tech-effect_home_2.png')}});border-radius: 0 20px 20px 0">
        <img src="{{asset('images/employee_teamwork.jpg')}}" alt="A Business Man on a Computer">
    </div>
    </div>
    <div class="home_section graphic-section">
    <div class="home_section_half" style="background-image:url({{asset('images/tech-effect_home_1.png')}});border-radius:20px 0 0 20px">
    <img src="{{asset('images/employees.jpg')}}">
    </div>
    <div class="home_section_half">
    <h3 style="text-align:center">Employee Empowerment</h3>
    <p>With our simple system for employees, they will be able to spend less time logging and more time working! Our intuitive design eliminates unnecessary steps, streamlining attendance and task management so your team can focus on what truly matters—productivity and growth. </p>
    </div>
    </div>
    <h3 style="text-align:center;margin-top:25px;">Our Satisfied Customers!</h3>
    <div class="review_section">
    <div class="review" style="background-image:url({{asset('images/review_2.jpg')}})">
    <div class="review_comment">
        <p>"Finally, HR made simple! Our company switched to Smart HR last quarter, and it’s been a game-changer. Managing requests and payroll is faster than ever.""
        </p>
        <p></p>
    </div>  
    <p>David R.,<br>Operations Lead at GreenLeaf Organics</p>
    </div>
    <div class="review" style="background-image:url({{asset('images/review_3.jpg')}});">
    <div class="review_comment"><p>"Intuitive and reliable. I love how easy it is for employees to clock in and out. The system feels modern and saves us hours every week."
</p></div>
    <p>Jessica M.,<br>HR Manager at BrightTech Solutions</p>
    </div>
    <div class="review" style="background-image:url({{asset('images/review_1.jpg')}})">
    <div class="review_comment"><p>"Data at my fingertips. The statistics dashboard helps me spot trends in staffing and wages. It’s like having an HR assistant working 24/7."
</p></div>
    <p>Samantha K.,<br>CEO of Horizon Logistics</p>

    </div>
    </div>  
    </section>

@endsection