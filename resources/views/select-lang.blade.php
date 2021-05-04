@extends('layouts.app')

@section('content')
<div class="container">

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="lang-cro" class="col-sm-6 control-label"> Croatian </label>
            <a class="dropdown-item" id="lang-cro" href="{{route('show.form',['locale'=>'cro'])}}">
                <img width="100px" height="100px"  src="{{ asset('/images/cro.png') }}">
            </a>
        </div>

        <div class="form-group col-md-6">
            <label for="lang-uk" class="col-sm-6 control-label"> English </label>
            <a class="dropdown-item" id="lang-uk" href="{{route('show.form',['locale'=>'en'])}}">
                <img width="100px" height="100px" src="{{ asset('/images/uk.png') }}">
            </a>
        </div>
    </div>
</div>
@endsection