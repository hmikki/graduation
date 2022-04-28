@extends('AhmedPanel.crud.main')
@section('title') | {{__('dashboard.edit')}} {{__('crud.'.$lang.'.crud_the_name')}} @endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" data-background-color="{{ config('app.color') }}">
                    <h4 class="title">{{__('dashboard.edit')}} {{__(('crud.'.$lang.'.crud_the_name'))}}</h4>
                </div>
                <div class="card-content">
                    <form action="{{url($redirect.'/'.$Object->id)}}" method="post" enctype="multipart/form-data">
                        <input name="_method" type="hidden" value="PUT">
                        @csrf
                        <div class="row">
                            @foreach($Fields as $Field)
                                @if(isset($Field['editable']))
                                    @if($Field['editable'])
                                        @if($Field['type'] != 'multi_checkbox' && $Field['type'] != 'images')
                                            {!! \App\Traits\AhmedPanelTrait::Fields($Field,$Object->{$Field['name']},$lang) !!}
                                        @else
                                            {!! \App\Traits\AhmedPanelTrait::Fields($Field,$Object,$lang) !!}
                                        @endif
                                    @endif
                                @else
                                    @if($Field['type'] != 'multi_checkbox' && $Field['type'] != 'images')
                                        {!! \App\Traits\AhmedPanelTrait::Fields($Field,$Object->{$Field['name']},$lang) !!}
                                    @else
                                        {!! \App\Traits\AhmedPanelTrait::Fields($Field,$Object,$lang) !!}
                                    @endif
                                @endif
                            @endforeach
                        </div>
                        <div class="row submit-btn">
                            <button type="submit" class="btn btn-primary"
                                    style="margin-left:15px;margin-right:15px;">{{__('dashboard.save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
