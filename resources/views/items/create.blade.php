@extends('app', ['page_title' => 'Items'])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="alert alert-primary alert-dismissible">
            Assessment: <strong>{{ $assessment->title }}</strong><br />
            Category: <strong>{{ $category->description }}</strong>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('assessments.categories.items.index', [$assessment->slug(), $category->slug()]) }}"><i class="fas fa-list"></i> Existing Items</a>
        <a class="btn btn-primary" href="{{ route('assessments.categories.index', [$assessment->slug()]) }}"><i class="fas fa-arrow-left"></i> Back to Categories</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <legend>New Item</legend>
        {!! Form::model(new App\AssItem, ['route' => ['assessments.categories.items.store', $assessment->slug(), $category->slug()], 'class' => 'form-group']) !!}
            @include('items/form', ['submit_text' => 'Create Item'])
        {!! Form::close() !!}
    </div>
</div>
@endsection
