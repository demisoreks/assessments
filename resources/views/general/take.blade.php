@extends('general', ['page_title' => $assessment->title])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                {!! Form::model(null, ['route' => ['assessments.submit', $assessment->slug()], 'class' => 'form-group']) !!}
                    @include('assessments/form_take', ['submit_text' => 'Submit Assessment'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection