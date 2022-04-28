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
    <nav class="navbar navbar-light pl-1 pr-1">
        <a class="navbar-brand font-20 white" href="#">
            <img src="{{asset('logo.jpg')}}" width="50" height="50" class="m-2" alt="">
            <p class="white pt-3"><span class="font-28 font-weight-bold">A</span>PPLICATION <span class="font-28 font-weight-bold">F</span>ORM</p>
        </a>
        <div class="ml-auto pt-2">
            <span class="white">Ar<i class="ml-2 flag flag-saudi-arabia"></i></span>
            <span class="white">En<i class="ml-2 flag flag-united-states"></i></span>
        </div>
    </nav>
        <div class="container">
            <form>
                <section class="mt-2 p-2 first">
                <p class="font-20">AOU is now accepting applications for the following semesters:
{{--                    <span class="ml-1 pl-lg-1 pr-lg-1 blue font-14 semester">Second 2020/2021<i class="pl-1 fas fa-circle-notch" data-toggle="modal" data-target="#exampleModal"></i></span>--}}
                    <select name="semester" class="form-control w-auto" required>
                        <option value="2021">First 2020/2021</option>
                        <option value="2022">First 2020/2021</option>
                        <option value="2023">First 2020/2021</option>
                        <option value="2024">First 2020/2021</option>
                    </select>
                </p>
                <p class="font-20">Admition Center(*)
                    <select name="semester" class="form-control w-auto" required>
                        <option value="">Select value</option>
                        <option value="1">Administrator</option>
                        <option value="2">Supervisor</option>
                    </select>
                    </p>
            </section>
                <section class="mt-2 p-2 second">
                    <p class="font-20">
                        If you are already have submitted an application and you want to go to payment
                        <a href="#" class="blue underline">click here</a>
                    </p>
                </section>
                <section class="mt-2 p-0 app_form">
                    <h4 class="p-3 white app_title">1- Application Personal Info</h4>
                    <section class="m-3 p-2 p-0 civil">
                        <h5 class="font-weight-bold pb-2 blue border_bottom w-25">Civil ID</h5>
                        <div class="row form-group">
                        <div class="col-sm-4 col-md-4 col-lg-2">
                            <label>Civil ID(*)</label>
                        </div>
                            <div class="col-4">
                            <input type="text" name="civil_id" id="civil_id" class="form-control" required>
                            </div>
                        </div>
                    </section>
                    <section class="m-3 p-2 p-0 personal">
                        <h5 class="font-weight-bold pb-2 blue border_bottom w-25">Personal Information</h5>
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-4"><p class="name_ar">Name In Arabic(as shown in Civil ID)</p></div>
                            <div class="col-4"><p class="name_en">Name In English(as shown in Passport)</p></div>
                        </div>
                        <div class="row form-group">
                            <div class="col-4">
                                <label>First Name(*)</label>
                            </div>
                            <div class="col-4">
                                <input type="text" name="first_name_ar" id="first_name_ar" class="form-control" required>
                            </div>
                            <div class="col-4">
                                <input type="text" name="first_name_en" id="first_name_en" class="form-control" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-4">
                                <label>Second Name</label>
                            </div>
                            <div class="col-4">
                                <input type="text" name="second_name_ar" id="second_name_ar" class="form-control">
                            </div>
                            <div class="col-4">
                                <input type="text" name="second_name_en" id="second_name_en" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-4">
                                <label>Third Name</label>
                            </div>
                            <div class="col-4">
                                <input type="text" name="third_name_ar" id="third_name_ar" class="form-control">
                            </div>
                            <div class="col-4">
                                <input type="text" name="third_name_en" id="third_name_en" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-4">
                                <label>Family Name(*)</label>
                            </div>
                            <div class="col-4">
                                <input type="text" name="family_name_ar" id="family_name_ar" class="form-control" required>
                            </div>
                            <div class="col-4">
                                <input type="text" name="family_name_en" id="family_name_en" class="form-control" required>
                            </div>
                        </div>
                    </section>
                    <section class="m-3 p-2 p-0 additional">
                        <h5 class="font-weight-bold pb-2 blue border_bottom w-25">Aditional Information</h5>
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                    <label>Gender(*)</label>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                    <select name="gender" class="form-control" required>
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                    </select>
                                </div>
                            <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                <label>Marital Status(*)</label>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                <select name="marital_status" class="form-control" required>
                                    <option value="1">Single</option>
                                    <option value="2">Married</option>
                                    <option value="3">Divorced</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                <label>Date Of Birth(*)</label>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                <input type="date" name="date_of_bith" id="date_of_bith" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                <label>Place Of Birth(*)</label>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                <select name="country" class="form-control" required>
                                    <option value="1">Saudi-arabia</option>
                                    <option value="2">Palestine</option>
                                    <option value="3">Egypt</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                <label>Nationality(*)</label>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                <select name="nationality" class="form-control" required>
                                    <option value="1">Saudi-arabian</option>
                                    <option value="2">Palestinian</option>
                                    <option value="3">Egyptian</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-4 mb-2">
                                <label>Date Of Expiration Of Civil Or Security Card(*)</label>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                <input type="date" name="civil_expiration_card" id="civil_expiration_card" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                <label>ID Type(*)</label>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                <select name="id_type" class="form-control" required>
                                    <option value="1">Civil Card</option>
                                    <option value="2">Passport</option>
                                    <option value="3">Security Card</option>
                                </select>
                            </div>
                        </div>
                    </section>
                    <section class="m-3 p-2 p-0 contact">
                        <h5 class="font-weight-bold pb-2 blue border_bottom w-25">Contact Information</h5>
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-2 mb-2">
                                <label>Home Phone(*)</label>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-2 mb-2">
                                <input type="text" name="phone" id="phone" class="form-control" placeholder="1234567890" required>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-2 mb-2">
                                <label>Mobile Phone 1(*)</label>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-2 mb-2">
                                <input type="text" name="mobile_1" id="mobile_1" class="form-control" placeholder="1234567890" required>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-2 mb-2">
                                <label>Mobile Phone 2(*)</label>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-2 mb-2">
                                <input type="text" name="mobile_2" id="mobile_2" class="form-control" placeholder="1234567890" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                <label>Personal Email(*)</label>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                <input type="email" name="email" id="email" class="form-control" placeholder="1234567890" required>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                <label>Confirm Personal Email(*)</label>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                <input type="email" name="email_confirmation" id="email_confirmation" class="form-control" placeholder="1234567890" required>
                            </div>
                        </div>
                    </section>
                    <section class="m-3 p-2 p-0 address">
                        <h5 class="font-weight-bold pb-2 blue border_bottom w-25">Address</h5>
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                <label>Area(*)</label>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                <select name="area" class="form-control" required>
                                    <option value="1">Saudi-arabia</option>
                                    <option value="2">Palestine</option>
                                    <option value="3">Egypt</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                <label>City(*)</label>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                <select name="city" class="form-control" required>
                                    <option value="1">Reyadh</option>
                                    <option value="2">Jeddah</option>
                                    <option value="3">Madinah</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-4"><p class="name_ar">In English</p></div>
                            <div class="col-4"><p class="name_en">In Arabic</p></div>
                        </div>
                        <div class="row form-group">
                            <div class="col-4">
                                <label>Street(*)</label>
                            </div>
                            <div class="col-4">
                                <input type="text" name="street_ar" id="street_ar" class="form-control" required>
                            </div>
                            <div class="col-4">
                                <input type="text" name="street_en" id="street_en" class="form-control" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-4">
                                <label>Building(*)</label>
                            </div>
                            <div class="col-4">
                                <input type="text" name="building_ar" id="building_ar" class="form-control" required>
                            </div>
                            <div class="col-4">
                                <input type="text" name="building_en" id="building_en" class="form-control" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-4">
                                <label>Floor(*)</label>
                            </div>
                            <div class="col-4">
                                <input type="text" name="floor_ar" id="floor_ar" class="form-control" required>
                            </div>
                            <div class="col-4">
                                <input type="text" name="floor_en" id="floor_en" class="form-control" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-4">
                                <label>Block(*)</label>
                            </div>
                            <div class="col-4">
                                <input type="text" name="block_ar" id="block_ar" class="form-control" required>
                            </div>
                            <div class="col-4">
                                <input type="text" name="block_en" id="block_en" class="form-control" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-4">
                                <label>Avenue(*)</label>
                            </div>
                            <div class="col-4">
                                <input type="text" name="avenue_ar" id="avenue_ar" class="form-control" required>
                            </div>
                            <div class="col-4">
                                <input type="text" name="avenue_en" id="avenue_en" class="form-control" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-4">
                                <label>POX(*)</label>
                            </div>
                            <div class="col-4">
                                <input type="text" name="box_ar" id="box_ar" class="form-control" required>
                            </div>
                            <div class="col-4">
                                <input type="text" name="box_en" id="box_en" class="form-control" required>
                            </div>
                        </div>
                    </section>
                </section>
                <section class="mt-2 p-0 Program_form">
                    <h4 class="p-3 white app_title">2- Program</h4>
                    <section class="m-3 p-2 p-0 high_school">
                        <h5 class="font-weight-bold pb-2 blue border_bottom w-25">Information Related to High School Certificate</h5>
                        <div class="row form-group">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <input type="radio" name="high_school" value="1" required><label class="mr-3">High school in Art/Science</label>
                                <input type="radio" name="high_school" value="1" required><label>Courses</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                <label>Certificate Type(*)</label>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                <select name="certificate_type" class="form-control" required>
                                    <option value="1">High School</option>
                                    <option value="2">Bachelor</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                <label>Average (over 100) (*)</label>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                <input type="text" name="average" class="form-control" id="average" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                <label>Graduation Year(*)</label>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                <select name="graduation_year" class="form-control" required>
                                    <option value="1">2020</option>
                                    <option value="2">2021</option>
                                    <option value="3">2022</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                <label>Country Of High School(*)</label>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                <select name="high_school_country" class="form-control" required>
                                    <option value="1">Saudi-arabia</option>
                                    <option value="2">Palestine</option>
                                    <option value="3">Egypt</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                    <label>Experience 4 Years or above</label>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                    <input type="checkbox" name="four_years_of_experience" class="" value="true">
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                <label>English Level (*)</label>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                <select name="english_level" class="form-control" required>
                                    <option value="1">Excellent</option>
                                    <option value="2">Fair</option>
                                    <option value="3">Good</option>
                                    <option value="3">Poor</option>
                                    <option value="3">Undefined</option>
                                    <option value="3">Very good</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                <label>Qiyas Grade</label>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                <input type="text" name="qiyas_grade" class="form-control" id="qiyas_grade">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                <label>Have you taken TOEFL or IELTS or STEP test?</label>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                <input type="checkbox" name="step_test"  id="step_test" class="" value="true">
                            </div>
                        </div>
                    </section>
                    <section class="m-3 p-2 p-0 program">
                        <h5 class="font-weight-bold pb-2 blue border_bottom w-25">Program</h5>
                        <div class="row form-group">
                            <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                <label>Program(*)</label>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                <select name="program" class="form-control" required>
                                    <option value="1">System Development</option>
                                    <option value="2">Mobile App</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                <label>Track(*)</label>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                <select name="program" class="form-control" required>
                                    <option value="1">Excellent</option>
                                    <option value="2">Very Good</option>
                                    <option value="3">Good</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                <label>Do you have Transferred Credits ?</label>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3 mb-2">
                                <input type="checkbox" name="transfer_credit"  id="transfer_credit" class="" value="true">
                            </div>
                        </div>
                    </section>
                </section>
                <section class="mt-2 p-0 additional_info">
                    <h4 class="p-3 white app_title">3- Additional Info</h4>
                    <section class="m-3 p-2 p-0 work_info">
                        <h5 class="font-weight-bold pb-2 blue border_bottom w-25">Work Info</h5>
                        <div class="row form-group">
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <label>Do you currently have any job?</label>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <input type="checkbox" name="step_test"  id="step_test" class="" value="true">
                            </div>
                        </div>
                    </section>
                    <section class="m-3 p-2 p-0 additional_info">
                        <h5 class="font-weight-bold pb-2 blue border_bottom w-25">Additional Info</h5>
                        <div class="row form-group">
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <label>If you have any kind of disability, please specify?</label>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <input type="checkbox" name="disability"  id="disability" class="" value="true">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <label>How did you know about AOU? (*)</label>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <select name="reference" class="form-control" required>
                                    <option value="1">Social Media</option>
                                    <option value="2">المعارض والمؤتمرات التي تشارك بها الجامعة</option>
                                    <option value="3">Relatives and Friends</option>
                                    <option value="4">الرسائل النصية</option>
                                    <option value="5">Twitter</option>
                                    <option value="6">Facebook</option>
                                    <option value="7">Youtube</option>
                                    <option value="8">Instagram</option>
                                    <option value="9">Road & Airport Advertisement</option>
                                    <option value="10">Snapchat</option>
                                    <option value="11">Youtube</option>
                                    <option value="12">AOU WEB Site</option>
                                    <option value="13">Others</option>
                                </select>
                            </div>
                        </div>
                    </section>
                    <section class="m-3 p-2 p-0 emergency_contact">
                        <h5 class="font-weight-bold pb-2 blue border_bottom w-25">Emergency Contact Information</h5>
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-4"><p class="name_ar">In English</p></div>
                            <div class="col-4"><p class="name_en">In Arabic</p></div>
                        </div>
                        <div class="row form-group">
                            <div class="col-4">
                                <label>Contact Name(*)</label>
                            </div>
                            <div class="col-4">
                                <input type="text" name="contact_name_en" id="contact_name_en" class="form-control" required>
                            </div>
                            <div class="col-4">
                                <input type="text" name="contact_name_ar" id="contact_name_ar" class="form-control" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-4">
                                <label>Phone Number(*)</label>
                            </div>
                            <div class="col-4">
                                <input type="text" name="emergency_phone" id="emergency_phone" class="form-control" required>
                            </div>
                        </div>
                    </section>
                </section>
                <section class="mt-2 p-0 upload_documents">
                    <h4 class="p-3 white">4- Upload Documents</h4>
                    <section class="m-3 p-2 p-0">
                        <p>Please upload the following documents: (High School Certificate, Passport, ID, Personal Photo)
                            If you have certificates issued outside the Kingdom of Saudi Arabia for non-Saudi students, please submit the document for the Equivalence Documents.</p>
                        <div class="row">
                            <div class="col-sm-4 col-md-4 col-lg-4 mb-2">
                                <label>Document Type (*)</label>
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4 mb-2">
                                <select name="id_type" class="form-control" required>
                                    <option value="1">Select value</option>
                                    <option value="2">ID - الهوية</option>
                                    <option value="3">Photo - صورة شمسية</option>
                                    <option value="3">High School Certificate</option>
                                    <option value="3">Certified Equivalence</option>
                                    <option value="3">Passport</option>
                                    <option value="3">Transcript</option>
                                    <option value="3">Qiyas Test</option>
                                </select>
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4 mb-2">
                                <input type="file" name="id_document" id="id_document" required>
                            </div>
                        </div>
                    </section>
                    <section class="m-3 p-2 p-0">
                       <div class="row">
                           <div class="col-sm-12 col-md-12 col-lg-12 mb-2">
                               <input type="checkbox" name="acceptance" id="acceptance" required>
                               <label>I confirm the above information are accurate and true</label>
                           </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 mb-2">
                                <input type="submit" name="submit" class="btn btn-primary">
                                <input type="button" class="btn btn-success" id="pay" value="Pay">
                            </div>
                        </div>
                    </section>
                </section>
            </form>
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
    </body>
</html>
