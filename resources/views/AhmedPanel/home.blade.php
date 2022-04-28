@extends('AhmedPanel.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6" onclick="window.location='{{url('dashboard/user_managements/users')}}'" style="cursor: pointer">
            <div class="card card-stats" style="height: 200px">
                <div class="card-header" data-background-color="blue">
                    <i class="material-icons">group</i>
                </div>
                <div class="card-content">
                    <h3 class="category">{{__('dashboard.students')}}</h3>
                    <h3 style="padding-top: 30px" class="title text-center">{{\App\Models\User::count()}}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats" onclick="window.location='{{url('dashboard/app_managements/employees')}}'" style="cursor: pointer; height: 200px">
                <div class="card-header" data-background-color="orange">
                    <i class="material-icons">people_outline</i>
                </div>
                <div class="card-content">
                    <h3 class="category">{{__('dashboard.admins')}}</h3>
                    <h3 style="padding-top: 30px" class="title text-center">{{\App\Models\Employee::count()}}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6" onclick="window.location='{{url('dashboard/app_content/orders')}}'" style="cursor: pointer;">
            <div class="card card-stats" style="height: 200px">
                <div class="card-header" data-background-color="red">
                    <i class="material-icons">category</i>
                </div>
                <div class="card-content">
                    <h3 class="category">{{__('dashboard.sidebar.orders')}}</h3>
                    @if(auth()->guard('dashboard')->user()->getType() == \App\Helpers\Constant::USER_TYPE['Admin'])
                    <h3 class="title text-center" style="padding-top: 30px">{{\App\Models\User::where('status', '!=', null)->count()}}</h3>
                    @elseif(auth()->guard('dashboard')->user()->getType() == \App\Helpers\Constant::USER_TYPE['Doctor'])
                        <h3 class="title text-center" style="padding-top: 30px">{{\App\Models\User::where('status', \App\Helpers\Constant::ORDER_STATUSES['New'])->count()}}</h3>
                    @elseif(auth()->guard('dashboard')->user()->getType() == \App\Helpers\Constant::USER_TYPE['Supervisor'])
                        <h3 class="title text-center" style="padding-top: 30px">{{\App\Models\User::where('status', \App\Helpers\Constant::ORDER_STATUSES['Accepted'])->count()}}</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>

{{--    <div class="row">--}}
{{--        <div class="col-lg-12 col-md-12">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header" data-background-color="{{ config('app.color') }}">--}}
{{--                    <h4 class="title">  {{__('dashboard.Home.n_send_general')}} </h4>--}}
{{--                </div>--}}
{{--                <div class="card-content">--}}
{{--                    <form action="{{url('uni-dashboard/notification/send')}}" method="post">--}}
{{--                        @csrf--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-4 btn-group required">--}}
{{--                                <label for="title">{{__('dashboard.Home.n_title')}} :</label>--}}
{{--                                <input type="text" required="" name="title" id="title" class="form-control" placeholder="{{__('dashboard.Home.n_enter_title')}}">--}}
{{--                            </div>--}}
{{--                            <div class="col-md-6 btn-group required">--}}
{{--                                <label for="msg">{{__('dashboard.Home.n_text')}} :</label>--}}
{{--                                <input type="text" required="" name="msg" id="msg" class="form-control" placeholder="{{__('dashboard.Home.n_enter_text')}}">--}}
{{--                            </div>--}}
{{--                            <div class="col-md-1 " style="margin-top: 50px">--}}
{{--                                <button type="submit" id="send" class="btn btn-primary">{{__('dashboard.Home.n_send')}}</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
@push('script')
@endpush
