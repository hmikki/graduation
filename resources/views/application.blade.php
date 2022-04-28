<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Application Form</title>

        <link rel="shortcut icon" href="{{asset('logo.jpg')}}" type="image/x-icon" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
              crossorigin="anonymous" />
        <link rel="stylesheet" href="{{asset('assets/css/style.css')}}" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
              integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
              crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css"
              integrity="sha512-OTcub78R3msOCtY3Tc6FzeDJ8N9qvQn1Ph49ou13xgA9VsH9+LRxoFU6EqLhW4+PKRfU+/HReXmSZXHEkpYoOA=="
              crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link href='https://fonts.googleapis.com/css?family=Cairo' rel='stylesheet'>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
              crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
              integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@700&display=swap" rel="stylesheet" />
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.css"
            rel="stylesheet"
        />

        <!-- Styles -->

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body>
    <!-- Image and text -->
    <nav class="navbar navbar-light pl-lg-5 pr-lg-5 no-print">
        <a class="navbar-brand font-20 white" href="#">
            <img src="{{asset('logo.jpg')}}" width="50" height="50" class="m-2" alt="">
            <p class="web_title white pt-3"><span class="font-28 font-weight-bold">A</span>PPLICATION <span class="font-28 font-weight-bold">F</span>ORM</p>
        </a>
        <div class="ml-auto pt-2">
            @guest
            <a class="btn btn-success p-1 p-lg-2" data-toggle="modal" data-target="#login">login</a>
            <a class="btn btn-warning p-1 p-lg-2" data-toggle="modal" data-target="#register">Register</a>
            @endguest
            @auth
                    <a class="btn btn-warning p-1 p-lg-2" href="#logout_form" onclick="event.preventDefault(); document.getElementById('logout_form').submit();">logout</a>
                    <form method="POST" id="logout_form" action="{{ route('logout') }}" style="display: none;">
                        @csrf
                    </form>
                @endauth
{{--            <span class="white">Ar<i class="ml-2 flag flag-saudi-arabia"></i></span>--}}
{{--            <span class="white">En<i class="ml-2 flag flag-united-states"></i></span>--}}
        </div>
    </nav>
        <div class="container">
            <form action="{{route('submit_application')}}" method="post">
                @csrf
                @if(session()->get('success'))
                    <div class="mt-2 alert alert-success">{{session()->get('success')}}</div>
                @endif
                @if(session()->get('error'))
                    <div class="mt-2 alert alert-success">{{session()->get('error')}}</div>
                @endif
                @if ($errors->any())
                    <div class="mt-2 alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <section class="mt-2 p-0 app_form">
                    <h4 class="p-3 white app_title">1- Student Information</h4>
                    <section class="m-3 p-2 p-0 civil">
                        <div class="row form-group">
                        <div class="col-sm-4 col-md-4 col-lg-2">
                            <label>Student ID(*)</label>
                        </div>
                            <div class="col-4">
                            <input type="text" name="student_id" id="student_id" disabled class="form-control" @auth value="{{auth()->user()->getStudentId()}}" @endauth required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-4 col-md-4 col-lg-2">
                                <label>Student Name(*)</label>
                            </div>
                            <div class="col-4">
                                <input type="text" name="student_name" id="student_name" class="form-control" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-4 col-md-4 col-lg-2">
                                <label>Student Track(major)(*)</label>
                            </div>
                            <div class="col-4">
                                <input type="text" name="student_track" id="student_track" class="form-control" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-4 col-md-4 col-lg-2">
                                <label>Section Number(*)</label>
                            </div>
                            <div class="col-4">
                                <input type="text" name="section_no" id="section_no" class="form-control" required>
                            </div>
                        </div>
                    </section>
                </section>
                <section class="mt-2 p-0 Program_form">
                    <h4 class="p-3 white app_title">2- Program General Info</h4>
                    <section class="m-3 p-2 p-0 high_school">
                        <div class="row form-group">
                            <div class="col-sm-4 col-md-4 col-lg-2">
                                <label>Project Title(no-shortcut)(*)</label>
                            </div>
                            <div class="col-4">
                                <input type="text" name="project_title" id="project_title" class="form-control" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-4 col-md-4 col-lg-2">
                                <label>Project Type(*)</label>
                            </div>
                            <div class="col-4">
                                <select name="project_type" class="form-control" required>
                                    <option value="System Development">System Development</option>
                                    <option value="Mobile Apps Development">Mobile Apps Development</option>
                                    <option value="Hardware">Hardware</option>
                                    <option value="Networking">Networking</option>
                                    <option value="Business-Related Projects">Business-Related Projects</option>
                                </select>
                            </div>
                        </div>
                    </section>
                </section>
                <section class="mt-2 p-0 additional_info">
                    <h4 class="p-3 white app_title">3- Project's Core Information</h4>
                    <section class="m-3 p-2 p-0 work_info">
                        <div class="row form-group">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label>Describe the Problem you are trying to solve:</label>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <textarea name="problem" id="problem"></textarea>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label>Give a brief on the proposed solution:</label>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <textarea name="solution" id="solution"></textarea>
                            </div>
                        </div>
                    </section>
                </section>
                <section class="mt-2 p-0 upload_documents no-print">
                    <section class="m-3 p-2 p-0">
                       <div class="row">
                           <div class="col-sm-12 col-md-12 col-lg-12 mb-2">
                               <input type="checkbox" name="acceptance" id="acceptance" required>
                               <label>I confirm the above information are accurate and true</label>
                           </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 mb-2">
                                <input type="submit" name="submit" class="btn btn-primary" @auth @if(auth()->user()->getStatus() != null) disabled title="your are previously submitted form" @endif @endauth @guest onclick="$('#login').modal('show')" @endguest>
                                <input type="button" class="btn btn-warning" id="view" value="view" onclick="window.print()">
                                <input type="reset" class="btn btn-success" id="reset" value="reset">
                            </div>
                        </div>
                    </section>
                </section>
            </form>
        </div>

    <!-- Modal -->
    <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('signin')}}" method="post">
                    @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6 mb-2">
                            <label for="username">Email</label>
                        </div>
                        <div class="col-6 mb-2">
                            <input type="text" id="username" name="email" class="form-control w-100" required>
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-6 mb-2">
                                <label for="pass">Password</label>
                            </div>
                            <div class="col-6 mb-2">
                                <input type="password" id="pass" name="password" class="form-control" required>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-success" value="login">
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle1">Register</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('signup')}}" method="post">
                    @csrf
                <div class="modal-body">
                        <div class="row form-group">
                            <div class="col-6">
                                <label for="email">email</label>
                            </div>
                            <div class="col-6">
                                <input class="form-control" type="email" id="email" name="email" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-6">
                                <label for="stu_id">Student Id</label>
                            </div>
                            <div class="col-6">
                                <input class="form-control w-100" type="text" id="stu_id" name="student_id" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-6">
                                <label for="password">Password</label>
                            </div>
                            <div class="col-6">
                                <input class="form-control" type="password" id="password" name="password" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-6">
                                <label for="password">Confirm Password</label>
                            </div>
                            <div class="col-6">
                                <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" required>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-success" value="Register">
                </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
            integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
            crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
            integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
    <script
        type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"
    ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    </body>
</html>
