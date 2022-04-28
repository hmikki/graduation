@extends('app')
@section('title')
    | About
@endsection
@section('content')
    <section class="about">
    <div class="row">
        <div class="col-12">
            <div class="bg-img-about"><img src="{{asset('lib/img/img4.png')}}" alt=""></div>
            <div class="h1 text-center about-h"> About Unicode </div>
            <div class="about-content">
                <div class="row mb-5">
                    <div class="col-1"></div>
                    <div class="col-5 text-right">
                        <div class="h2">
                            مهمتنا
                        </div>
                        <p>خلق تجربة يومية أفضل لطلاب الجامعات</p>
                    </div>
                    <div class="col-5 pr-0">
                        <div class="h2">
                            Our Mission
                        </div>
                        <p>Create a better everyday experience for college students.</p>
                    </div>
                    <div class="col-1"></div>
                </div>
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-5 text-right">
                        <div class="h2">
                            رؤيتـــنا
                        </div>
                        <p>ابتكار حلول متنوعة لتعزيز تجربة طلاب الجامعات</p>
                    </div>
                    <div class="col-4">
                        <div class="h2">
                            Vision
                        </div>
                        <p>Innovate various solutions to enhance the college students’ experience</p>
                    </div>
                    <div class="col-2"></div>
                </div>
            </div>
        </div>
    </div>
    </section>
    <section class="about-img">
    <div class="row about-overflow">
        <div class="col-12">
            <div class="bg-img-about-green"><img src="{{asset('lib/img/img-6.png')}}" alt=""></div>
            <div class="about-content">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <img src="{{asset('lib/img/about.png')}}" alt="">
                    </div>
                    <div class="col-2"></div>
                </div>
            </div>
        </div>
    </div>
    </section>
    <section class="contact-us">
    <div class="row">
        <div class="col-12">
            <div class="h1">
                Contact Unicode
            </div>
            <p>Drop us a line with any questions, inquiries or business proposals</p>
            <form action="{{url('contact')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" required id="name" aria-describedby="Name" placeholder="">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="email">E-Mail</label>
                            <input type="email" name="email" class="form-control" required id="email" aria-describedby="Email" placeholder="">
                        </div>
                    </div>
                    <div class="col-2"></div>
                </div>
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" required id="title" aria-describedby="Title" placeholder="">
                        </div>
                    </div>
                    <div class="col-2"></div>
                </div>
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea class="form-control" name="message" id="message" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <div class="col-2"></div>
                </div>
            </form>
        </div>
    </div>
    </section>
@endsection
