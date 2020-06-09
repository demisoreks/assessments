@extends('app', ['page_title' => 'Categories'])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="alert alert-primary alert-dismissible">
            Assessment: <strong>{{ $assessment->title }}</strong>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('assessments.categories.index', [$assessment->slug()]) }}"><i class="fas fa-list"></i> Existing Categories</a>
        <a class="btn btn-primary" href="{{ route('assessments.index') }}"><i class="fas fa-arrow-left"></i> Back to Assessments</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <legend>New Category</legend>
        {!! Form::model(new App\AssCategory, ['route' => ['assessments.categories.store', $assessment->slug()], 'class' => 'form-group']) !!}
            @include('categories/form', ['submit_text' => 'Create Category'])
        {!! Form::close() !!}
    </div>
</div>
@endsection
