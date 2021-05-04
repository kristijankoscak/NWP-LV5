@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('store.task') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }} 


        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="task-name" class="col-sm-6 control-label"> {{ __('task-messages.name') }} </label>
                <div>
                    <input type="text" name="name" id="task-name"
                        class="form-control @error('name') is-invalid @enderror" 
                        value="{{ old('name')  }}">
                    @error('name')
                        <span class="text-danger">*{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group col-md-6">
                <label for="task-name-en" class="col-sm-6 control-label"> {{ __('task-messages.name_en') }} </label>
                <div>
                    <input type="text" name="name_en" id="task-name-en"
                        class="form-control @error('name_en') is-invalid @enderror" 
                        value="{{ old('name_en')  }}">
                    @error('name_en')
                        <span class="text-danger">*{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="study_type" class="col-sm-6 control-label"> {{ __('task-messages.study_type') }} </label>
                <select class="form-control" id="study_type" name="study_type">
                    <option > {{ __('task-messages.professional_study') }} </option>
                    <option > {{ __('task-messages.undergraduate_study') }} </option>
                    <option > {{ __('task-messages.graduate_study') }} </option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="assignment" class="col-sm-6 control-label"> {{ __('task-messages.assignment') }} </label>
                <div>
                    <textarea type="text" name="assignment" id="assignment"
                        class="form-control @error('assignment') is-invalid @enderror">
                        {{ old('assignment') }}
                    </textarea>
                    @error('assignment')
                        <span class="text-danger">*{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group col-md-6">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-btn fa-plus"></i> {{ __('task-messages.add_button') }}
                </button>
            </div>
        </div>
    </form>
</div>
@endsection