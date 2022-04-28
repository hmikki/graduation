@extends('AhmedPanel.crud.main')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header " data-background-color="{{ config('app.color') }}">
                <h4 class="title">{{__('dashboard.show')}} {{__(('crud.'.$lang.'.crud_the_name'))}}</h4>
            </div>
            <div class="card-content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-content table-responsive">
                                <table class="table table-hover">
                                    <tr>
                                        <th style="border-top: none !important;">{{__('crud.'.$lang.'.name')}}</th>
                                        <td style="border-top: none !important;">{{$Object->getStudentName()}}</td>
                                    </tr>
                                    <tr>
                                        <th style="border-top: none !important;">{{__('crud.'.$lang.'.mobile')}}</th>
                                        <td style="border-top: none !important;">{{$Object->getMobile()}}</td>
                                    </tr>
                                    <tr>
                                        <th style="border-top: none !important;">{{__('crud.'.$lang.'.email')}}</th>
                                        <td style="border-top: none !important;">{{$Object->getEmail()}}</td>
                                    </tr>

                                    <tr>
                                        <th style="border-top: none !important;">{{__('crud.'.$lang.'.created_at')}}</th>
                                        <td style="border-top: none !important;">{{\Carbon\Carbon::parse($Object->created_at)->format('Y-m-d')}}</td>
                                    </tr>
                                    <tr>
                                        <th style="border-top: none !important;">{{__('crud.'.$lang.'.active')}}</th>
                                        <td style="border-top: none !important;">
                                            <span class="label label-{{($Object->isActive())?'success':'danger'}}">{{($Object->isActive())?__('dashboard.activation.active'):__('dashboard.activation.in_active')}}</span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-content table-responsive">
                                <table class="table table-hover">


                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header" data-background-color="{{ config('app.color') }}">
                                <h4 class="title">  {{__('dashboard.Home.n_send_general')}} </h4>
                            </div>
                            <div class="card-content">
                                <form action="{{url('uni-dashboard/notification/send')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{$Object->id}}">
                                    <div class="row">
                                        <div class="col-md-4 btn-group required">
                                            <label for="title">{{__('dashboard.Home.n_title')}} :</label>
                                            <input type="text" required="" name="title" id="title" class="form-control" placeholder="{{__('dashboard.Home.n_enter_title')}}">
                                        </div>
                                        <div class="col-md-6 btn-group required">
                                            <label for="msg">{{__('dashboard.Home.n_text')}} :</label>
                                            <input type="text" required="" name="msg" id="msg" class="form-control" placeholder="{{__('dashboard.Home.n_enter_text')}}">
                                        </div>
                                        <div class="col-md-1 " style="margin-top: 50px">
                                            <button type="submit" id="send" class="btn btn-primary">{{__('dashboard.Home.n_send')}}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
