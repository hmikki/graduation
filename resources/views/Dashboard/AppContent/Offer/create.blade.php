
@extends('AhmedPanel.crud.main')
@section('title') | {{ __('dashboard.add') }} {{ __('crud.' . $lang . '.crud_name') }} @endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" data-background-color="{{ config('app.color') }}">
                    <h4 class="title">{{ __('dashboard.add') }} {{ __('crud.' . $lang . '.crud_name') }}</h4>
                </div>
                <div class="card-content">
                    <form action="{{ url($redirect) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            @foreach ($Fields as $Field)
                                {!! \App\Traits\AhmedPanelTrait::Fields($Field, old($Field['name']), $lang) !!}
                            @endforeach
                        </div>

                        <div class="col-md-12">
                            <div class="row" id="size">
                                <div id="size_row1">
                                    <div class="col-md-5">
                                        <div class="form-group label-floating ">
                                            <label for="size_name" class="control-label">{{ __('crud.'.$lang.'.size') }}*</label>
                                            <input type="text" id="size_name"
                                                   name="size_name[]"
                                                   class="form-control "
                                                   value="">
                                            <span class="material-input"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group label-floating ">
                                            <label for="size_price" class="control-label">
                                                {{ __('crud.'.$lang.'.price') }}*</label>
                                            <input type="text" id="size_price"
                                                   name="size_price[]"
                                                   class="form-control "
                                                   value="">
                                            <span class="material-input"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="btn btn-primary no-text ticket-manage "
                                             id="new_size">{{ __('dashboard.add') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row submit-btn">
                            <button type="submit" class="btn btn-primary"
                                    style="margin-left:15px;margin-right:15px;">{{ __('dashboard.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        //console.log('hello');
        var z = 1;
        var i = 1;
        $('#new_size').on('click', function () {
            console.log('hello');
            z ++;
            $('#size').append(`
             <div id="size_row` + z  + `">
                                    <div class="col-md-5">
                                        <div class="form-group label-floating ">
                                            <label for="size_name" class="control-label">size *</label>
                                            <input type="text" id="size_name"
                                                   name="size_name[]"
                                                   class="form-control "
                                                   value="">
                                            <span class="material-input"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group label-floating ">
                                            <label for="size_price" class="control-label">price *</label>
                                            <input type="text" id="size_price"
                                                   name="size_price[]"
                                                   class="form-control "
                                                   value="">
                                            <span class="material-input"></span>
                                        </div>
                                    </div>
                                <div class="col-md-2">
                                    <div class="btn btn-danger no-text ticket-manage remove_field_size"  id="` + z + `" >حذف </div>  </div>
                                </div>
 </div>
`);
        });
        $(document).on('click', '.remove_field_size', function () {
            console.log(i);
            var btn_id = $(this).attr("id");
            $('#size_row' + btn_id + '').remove();
        });
    </script>
@endpush
