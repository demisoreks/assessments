@extends('app', ['page_title' => 'Assessments'])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('assessments.index') }}"><i class="fas fa-list"></i> Existing Assessments</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <legend>Edit Assessment</legend>
        {!! Form::model($assessment, ['route' => ['assessments.update', $assessment->slug()], 'class' => 'form-group']) !!}
        @method('PUT')
        @include('assessments/form', ['submit_text' => 'Update Assessment'])
        {!! Form::close() !!}
    </div>
</div>
@endsection
