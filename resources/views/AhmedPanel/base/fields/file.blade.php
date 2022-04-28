<div class="@if(isset($Field['col'])) {{$Field['col']}} @else col-md-12 @endif" id="{{$Field['name']}}_div">
    <label for="{{$Field['name']}}">{{__('crud.'.$lang.'.'.$Field['name'])}} @if($Field['is_required'])*@endif</label>
    <input type="file" id="{{$Field['name']}}" name="{{$Field['name']}}" @if($Field['is_required']) required @endif class=" {{ $errors->has($Field['name']) ? ' is-invalid' : '' }}">
    @if ($errors->has($Field['name']))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first($Field['name']) }}</strong>
        </span>
    @endif
</div>
