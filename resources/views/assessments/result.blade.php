@extends('general', ['page_title' => $responder->assessment->title])

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="alert alert-info">
            You can view this result anytime using the following link:<br />
            <a href="{{ config('app.url') }}/assessments/{{ $responder->slug() }}/result">{{ config('app.url') }}/assessments/{{ $responder->slug() }}/result</a>
        </div>
        <div class="card">
            <div class="card-body">
                <h2 class="text-center">Result</h2>
                <table class="table table-bordered table-striped table-hover">
                    <tr>
                        <td colspan="2">Name of Organization</td>
                        <td colspan="2" style="font-weight: bold;">{{ $responder->organization_name }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">Name of Reviewer</td>
                        <td colspan="2" style="font-weight: bold;">{{ $responder->reviewer_name }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">Email Address</td>
                        <td colspan="2" style="font-weight: bold;">{{ $responder->email }}</td>
                    </tr>
                    <tr>
                        <th align="center">CATEGORY</th>
                        <th align="center">TOTAL WEIGHT</th>
                        <th align="center">SCORE</th>
                        <th align="center">PERCENTAGE</th>
                    </tr>
                    @foreach (App\AssCategory::where('assessment_id', $responder->assessment->id)->where('active', true)->orderBy('order_number')->get() as $category)
                    <tr>
                        <td width="25%">{{ $category->description }}</td>
                        <td width="25%" align="right">{{ number_format(App\AssItem::where('category_id', $category->id)->where('active', true)->sum('weight'), 2) }}</td>
                        <td width="25%" align="right">{{ number_format(App\AssResponse::where('responder_id', $responder->id)->whereIn('item_id', App\AssItem::where('category_id', $category->id)->where('active', true)->get('id')->toArray())->sum('option_score'), 2) }}</td>
                        <td width="25%" align="right">{{ number_format((App\AssResponse::where('responder_id', $responder->id)->whereIn('item_id', App\AssItem::where('category_id', $category->id)->where('active', true)->get('id')->toArray())->sum('option_score'))/(App\AssItem::where('category_id', $category->id)->where('active', true)->sum('weight'))*100, 2) }}%</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td width="25%" colspan="3" style="font-weight: bold;">Overall</td>
                        <td align="right" style="font-weight: bold;">{{ number_format((App\AssResponse::where('responder_id', $responder->id)->sum('option_score'))/(App\AssResponse::where('responder_id', $responder->id)->sum('item_weight'))*100, 2) }}%</td>
                    </tr>
                </table>
                <?= html_entity_decode($responder->assessment->closing_remark) ?>
            </div>
        </div>
    </div>
</div>
@endsection