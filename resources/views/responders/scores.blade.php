@extends('app', ['page_title' => 'Scores'])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="alert alert-primary alert-dismissible">
            Assessment: <strong>{{ $assessment->title }}</strong><br />
            Organization: <strong>{{ $responder->organization_name }}</strong><br />
            Reviewer: <strong>{{ $responder->reviewer_name }}</strong><br />
            Email Address: <strong>{{ $responder->email }}</strong>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('assessments.index') }}"><i class="fas fa-arrow-left"></i> Back to Assessments</a>
        <a class="btn btn-primary" href="{{ route('assessments.responders.index', [$assessment->slug()]) }}"><i class="fas fa-arrow-left"></i> Back to Responders</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <table class="table table-bordered table-responsive-md" width="100%">
            @foreach (App\AssCategory::where('active', true)->orderBy('order_number')->get() as $category)
            <tr>
                <td>
                    <div class="row">
                        <div class="col-md-2" style="font-weight: bold;">
                            {{ $category->description }}<br />(Category Score: {{ App\AssResponse::whereIn('item_id', App\AssItem::where('category_id', $category->id)->pluck('id')->toArray())->where('responder_id', $responder->id)->sum('option_score') }})
                        </div>
                        <div class="col-md-10">
                            <table class="table table-striped table-hover" width="100%">
                                @foreach (App\AssItem::where('category_id', $category->id)->where('active', true)->orderBy('order_number')->get() as $item)
                                <tr>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-7">{{ $item->description }}</div>
                                            <div class="col-md-3">{{ App\AssResponse::where('item_id', $item->id)->where('responder_id', $responder->id)->first()->option_description }}</div>
                                            <div class="col-md-2 pull-right">{{ App\AssResponse::where('item_id', $item->id)->where('responder_id', $responder->id)->first()->option_score }}</div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
