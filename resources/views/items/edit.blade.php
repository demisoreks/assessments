@extends('app', ['page_title' => 'Categories'])

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
        <legend>Edit Item</legend>
        {!! Form::model($item, ['route' => ['assessments.categories.items.update', $assessment->slug(), $category->slug(), $item->slug()], 'class' => 'form-group']) !!}
        @method('PUT')
        @include('items/form', ['submit_text' => 'Update Item'])
        {!! Form::close() !!}
    </div>
</div>
@endsection
