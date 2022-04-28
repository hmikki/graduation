@extends('app')
@section('title')
    | Privacy Policy
@endsection
@section('content')
    <section class="privacy">
        <div class="row">
            <div class="col-12">
                <div class="h1 text-center privacy-h"> Terms And Conditions </div>
                <div class="privacy-content">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8 col-12">
                            <p>
                                {!! \App\Models\Setting::where('key','terms')->first()->value_ar !!}
                            </p>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
