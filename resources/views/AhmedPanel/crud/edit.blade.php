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
                        @if($lang == 'Dashboard')
                            <div class="row">
                                <div class="col-md-12" id="Roles">
                                    <label for="Roles" class="col-md-12">{{__('crud.Role.crud_names')}}</label>
                                    <script>let RolePermission =[];</script>
                                    @foreach(\App\Models\Role::all() as $role)
                                        <div class="col-md-3">
                                            <input type="checkbox" id="{{$role->getId()}}" name="roles[]" @if($Object->hasRole($role->getId())) checked @endif onchange="permissionCheck()" value="{{$role->getId()}}" class="role {{ $errors->has('roles') ? ' is-invalid' : '' }}">
                                            <label for="{{$role->getId()}}">{{$role->getName()}}</label>
                                        </div>
                                        {{$role->role_permissions()->count()}}
                                        <script>RolePermission['{{$role->getId()}}'] = [@foreach($role->role_permissions as $role_permission){{$role_permission->permission_id}} @if(!$loop->last),@endif @endforeach];</script>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @if($lang == 'Dashboard' || $lang == 'Role')
                            <div class="row">
                                <div class="col-md-12" id="Permission">
                                    <label for="Permission" class="col-md-12">{{__('crud.Permission.crud_names')}}</label>
                                    @foreach(\App\Models\Permission::whereNull('parent_id')->get() as $permission)
                                        <div class="form-group col-md-12">
                                            <input type="checkbox" id="permission{{$permission->getId()}}" name="permissions[]" onclick="ParentCheck({{$permission->getId()}})" @if($Object->hasPermission($permission->getId())) checked @endif value="{{$permission->getId()}}" class="permission {{ $errors->has('permissions') ? ' is-invalid' : '' }}">
                                            <label for="permission{{$permission->getId()}}">{{app()->getLocale() =='ar'?$permission->getNameAr():$permission->getName()}}</label>
                                        </div>
                                        @foreach(\App\Models\Permission::where('parent_id',$permission->getId())->get() as $cPermission)
                                            <div class="form-group col-md-3">
                                                <input type="checkbox" id="permission{{$cPermission->getId()}}" name="permissions[]"  @if($Object->hasPermission($permission->getId())) checked @endif value="{{$cPermission->getId()}}" onclick="TriggerParentCheck({{$permission->getId()}},{{$cPermission->getId()}})" class="permission permission_{{$permission->getId()}} {{ $errors->has('permissions') ? ' is-invalid' : '' }}">
                                                <label for="permission{{$cPermission->getId()}}">{{app()->getLocale() =='ar'?$cPermission->getNameAr():$cPermission->getName()}}</label>
                                            </div>
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <div class="row submit-btn">
                            <button type="submit" class="btn btn-primary" style="margin-left:15px;margin-right:15px;">{{__('dashboard.save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('script')
    <script>
        function permissionCheck() {
            let roleEls = document.getElementsByClassName('role');
            let permissionEls = document.getElementsByClassName('permission');
            for (let p = 0;p<permissionEls.length;p++){
                // permissionEls[p].checked=false;
                permissionEls[p].disabled=false;
            }
            for (let r = 0;r<roleEls.length;r++){
                let roleEl = roleEls[r];
                let permission = RolePermission[roleEl.id];
                for(let i = 0; i < permission.length; i++){
                    let permissionEl = document.getElementById('permission'+permission[i]);
                    if(roleEl.checked){
                        permissionEl.checked=true;
                        permissionEl.disabled=true;
                    }
                }
            }
        }
        permissionCheck();
        function ParentCheck(id){
            let main_permission = document.getElementById('permission'+id);
            let permissionEls = document.getElementsByClassName('permission_'+id);
            for (let p = 0;p<permissionEls.length;p++){
                permissionEls[p].checked = !!main_permission.checked;
            }
        }
        function TriggerParentCheck(id,id2){
            let main_permission = document.getElementById('permission'+id);
            let sub_permission = document.getElementById('permission'+id2);
            if (sub_permission.checked){
                main_permission.checked = true;
            }
        }
    </script>
@endpush
