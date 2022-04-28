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
                                            <td style="border-top: none !important;">{{app()->getLocale() == 'ar'?$Object->getNameAr(): $Object->getName()}}</td>
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
                                        <tr>
                                            <th style="border-top: none !important;">{{__('crud.'.$lang.'.sizes_group')}}</th>
                                            <table class="table table-hover">
                                            @foreach($Object->offer_size_price as $key)
                                                <tr>
                                                <td style="border-top: none !important;">{{$key->size}}</td>
                                                <td style="border-top: none !important;">{{$key->price}}</td>
                                                </tr>
                                            @endforeach
                                            </table>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-content table-responsive">
                                    <table class="table table-hover">
                                        <tr>
                                            <th style="border-top: none !important;">{{__('crud.'.$lang.'.image')}}</th>
                                            <td style="border-top: none !important;"><img src="{{asset($Object->getImage())}}" alt="offer" style="width:200px; height: 200px;"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
