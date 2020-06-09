@extends('app', ['page_title' => 'Options'])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="alert alert-primary alert-dismissible">
            Assessment: <strong>{{ $assessment->title }}</strong><br />
            Category: <strong>{{ $category->description }}</strong><br />
            Item: <strong>{{ $item->description }}</strong>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('assessments.categories.items.options.index', [$assessment->slug(), $category->slug(), $item->slug()]) }}"><i class="fas fa-list"></i> Existing Options</a>
        <a class="btn btn-primary" href="{{ route('assessments.categories.items.index', [$assessment->slug(), $category->slug()]) }}"><i class="fas fa-arrow-left"></i> Back to Items</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <legend>New Option</legend>
        {!! Form::model(new App\AssOption, ['route' => ['assessments.categories.items.options.store', $assessment->slug(), $category->slug(), $item->slug()], 'class' => 'form-group']) !!}
            @include('options/form', ['submit_text' => 'Create Option'])
        {!! Form::close() !!}
    </div>
</div>
@endsection
