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
                                            <th style="border-top: none !important;">{{__('crud.Country.crud_the_name')}}</th>
                                            <td style="border-top: none !important;">{{app()->getLocale() == 'ar'?$Object->country->getNameAr():$Object->country->getName()}}</td>
                                        </tr>
                                        <tr>
                                            <th style="border-top: none !important;">{{__('crud.'.$lang.'.brand_id')}}</th>
                                            <td style="border-top: none !important;">{{app()->getLocale() == 'ar'?$Object->brand->name_ar : $Object->brand->name}}</td>
                                        </tr>
                                        <tr>
                                            <th style="border-top: none !important;">{{__('crud.'.$lang.'.product_no')}}</th>
                                            <td style="border-top: none !important;">{{$Object->getProductNo()}}</td>
                                        </tr>
                                        <tr>
                                            <th style="border-top: none !important;">{{__('crud.'.$lang.'.description')}}</th>
                                            <td style="border-top: none !important;">{{app()->getLocale() == 'ar'?$Object->getDescriptionAr(): $Object->getDescription()}}</td>
                                        </tr>
                                        <tr>
                                            <th style="border-top: none !important;">{{__('crud.'.$lang.'.quality')}}</th>
                                            <td style="border-top: none !important;">{{$Object->getQuality()}}</td>
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
                                            <th style="border-top: none !important;">{{__('crud.'.$lang.'.attribute_id')}}</th>
                                            <table class="table table-hover">
                                            @foreach($Object->attributes as $attr)
                                                <tr>
                                                    <td style="border-top: none !important;">{{app()->getLocale() == 'ar'?$attr->name_ar : $attr->name}}</td>
                                                    <td style="border-top: none !important;">{{app()->getLocale() == 'ar'?$attr->description_ar : $attr->description}}</td>
                                                </tr>
                                                    @endforeach
                                            </table>
                                        </tr>
                                        <tr>
                                            <th style="border-top: none !important;">{{__('crud.'.$lang.'.sizes_group')}}</th>
                                            <table class="table table-hover">
                                            @foreach($Object->size_price as $key)
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
                                        <div class="col-md-12">
                                            <h2 style="border-top: none !important;">{{__('crud.'.$lang.'.images')}}</h2>
                                        </div>
                                            @foreach($Object->media as $image)
                                                <div class="col-md-3"><img src="{{asset($image->file)}}"></div>
                                        @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
