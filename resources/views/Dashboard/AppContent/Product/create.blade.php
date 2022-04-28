
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
                            <div class="form-group label-floating">
                                <label for="status" class="control-label">{{__('crud.'.$lang.'.quality')}} *</label>
                                <select id="status" name="quality" required class="form-control {{ $errors->has('quality') ? ' is-invalid' : '' }}">
                                    <option></option>
                                    <option value="2">{{__('crud.Product.'.\App\Helpers\Constant::QUALITY['HIGH'])}}</option>
                                    <option value="1">{{__('crud.Product.'.\App\Helpers\Constant::QUALITY['MID'])}}</option>
                                    <option value="0">{{__('crud.Product.'.\App\Helpers\Constant::QUALITY['LOW'])}}</option>
                                </select>
                            </div>
                            @if ($errors->has('quality'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('quality') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="col-md-12">
                            <div class="row" id="size">
                                <div id="size_row1">
                                    <div class="col-md-5">
                                        <div class="form-group label-floating ">
                                            <label for="size_name" class="control-label">{{ __('crud.Product.size') }}*</label>
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
                                                {{ __('crud.Product.price') }}*</label>
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
                        <div class="col-md-12">
                            <div class="row" id="attribute">
                                <div id="attribute_row1">
                                    <div class="col-md-5">
                                        <div class="form-group label-floating ">
                                            <label for="attribute_name" class="control-label">{{ __('crud.Attribute.crud_name') }}*</label>
                                            <input type="text" id="attribute_name"
                                                   name="attribute_name[]"
                                                   class="form-control "
                                                   value="">
                                            <span class="material-input"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group label-floating ">
                                            <label for="attribute_description" class="control-label">
                                                {{ __('crud.Attribute.description') }}*</label>
                                            <input type="text" id="attribute_description"
                                                   name="attribute_description[]"
                                                   class="form-control "
                                                   value="">
                                            <span class="material-input"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="btn btn-primary no-text ticket-manage "
                                             id="new_attribute">{{ __('dashboard.add') }}
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

        var x = 1;
        var y = 1;
        $('#new_attribute').on('click', function () {
            x ++;
            $('#attribute').append(`
             <div id="attribute_row` + x  + `">
                                    <div class="col-md-5">
                                        <div class="form-group label-floating ">
                                            <label for="attribute_name" class="control-label">Attribute name *</label>
                                            <input type="text" id="attribute_name"
                                                   name="attribute_name[]"
                                                   class="form-control "
                                                   value="">
                                            <span class="material-input"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group label-floating ">
                                            <label for="attribute_description" class="control-label">Attribute Description *</label>
                                            <input type="text" id="attribute_description"
                                                   name="attribute_description[]"
                                                   class="form-control "
                                                   value="">
                                            <span class="material-input"></span>
                                        </div>
                                    </div>
                                <div class="col-md-2">
                                    <div class="btn btn-danger no-text ticket-manage remove_field_attribute"  id="` + x + `" >حذف </div>  </div>
                                </div>
 </div>
`);
        });
        $(document).on('click', '.remove_field_attribute', function () {
            console.log(y);
            var btn_id = $(this).attr("id");
            $('#attribute_row' + btn_id + '').remove();
        });

       /* function permissionCheck() {
            let roleEls = document.getElementsByClassName('role');
            let permissionEls = document.getElementsByClassName('permission');
            for (let p = 0; p < permissionEls.length; p++) {
                permissionEls[p].checked = false;
                permissionEls[p].disabled = false;
            }
            for (let r = 0; r < roleEls.length; r++) {
                let roleEl = roleEls[r];
                let permission = RolePermission[roleEl.id];
                for (let i = 0; i < permission.length; i++) {
                    let permissionEl = document.getElementById('permission' + permission[i]);
                    if (roleEl.checked) {
                        permissionEl.checked = true;
                        permissionEl.disabled = true;
                    }
                }
            }
        }

        function ParentCheck(id) {
            let main_permission = document.getElementById('permission' + id);
            let permissionEls = document.getElementsByClassName('permission_' + id);
            for (let p = 0; p < permissionEls.length; p++) {
                permissionEls[p].checked = !!main_permission.checked;
            }
        }

        function TriggerParentCheck(id, id2) {
            let main_permission = document.getElementById('permission' + id);
            let sub_permission = document.getElementById('permission' + id2);
            if (sub_permission.checked) {
                main_permission.checked = true;
            }
        }*/
    </script>
@endpush
