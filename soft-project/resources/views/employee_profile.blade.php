@extends('layout.employee')
@section('content')
<style>
    .edit_button{
        background-color: var(--lavender);
        border:none;
        border-radius:50px;
        color:white;
        width:100px;
        height:40px;
        margin-left:10px;
        cursor:pointer;
        padding: 10px;
    }

    label {
        display: block;
        margin: 0 10px 0 5px;
    }
</style>
    <section>
        <div class="profile_holder" style="margin-bottom:10px;border: 1px solid var(--deep-navy);">
            <h4 style="width: 100%;">Employee Profile</h4>
            <div>
                <img src="{{ $employee->profile_pic }}" alt="" class="profile_pic">
            </div>
            
            <div class="profile_holder" style="width: auto">
                <div class="profile_stats_section">
                    <div style="width:100%">
                        Name: {{ $employee->lastName }}, {{ $employee->firstName }}
                    </div>
                    <div class="profile_container">
                        Designation: {{ $designation->designationName }}
                    </div>
                    <div class="profile_container">
                        Department: {{$department->departmentName}}
                    </div>
                    <div class="profile_container">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                            <path
                                d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z" />
                        </svg> Email: {{$employee->email}}</div>
                    <div class="profile_container">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                            <path
                                d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10" />
                            <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                        </svg>
                        Company: {{$company->companyName}}</div>
                        <div>
                            Employee ID #: {{$employee->employeeID}}
                        </div>
                        
                </div>
                                        <div class="monthly_salary">
                            Monthly Salary<br>${{ $employee->salary }}
                        </div>
            </div>
        </div>
            <div class="profile_holder" style="margin-bottom:10px;border: 1px solid var(--deep-navy);">
                <div class="profile_container">
                    <h4>Personal Details:</h4>
                </div>
                <div class="profile_container" style="margin-bottom:10px;text-align: right;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path
                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd"
                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                        </svg> Edit</div>
                <form id="changeName" action="/employee/updateProfile" method=POST>
                    @csrf
                    <label class="upload-btn">
                    Change Photo
                    <input type="file" id="imageInput" class="name_changer" name="profile_pic" form="updateForm" accept="image/*" hidden>
                </label>
                <span id="filenameDisplay"></span>

                <br>
                <br>

                    <label for="first_name">First Name: </label>
                    <input class="name_changer" name="first_name" type="text"
                            value="{{$employee->firstName}}">
                            <br>
                    <label for="last_name">Last Name: </label>
                    <input class="name_changer" name="last_name" type="text"
                            value="{{$employee->lastName}}">
                            <br>
                    <label for="email">Email: </label>
                    <input type="text" name="email" class="name_changer" value="{{ $employee->email }}">
                            <br>
                    <label for="password">Password: </label>
                    <input type="text" name="password" class="name_changer" placeholder="*********">
                            <br>
                    <button class="approve" type="submit"
                        form="changeName" style="align-self: flex-end">Save Changes</button>
                </form>
                @if (session('msg'))
                <p class="success">{{ session('msg') }}</p>
                @endif
            </div>
    </section>

@endsection