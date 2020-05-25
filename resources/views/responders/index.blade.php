@extends('app', ['page_title' => 'Responses'])

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
        <a class="btn btn-primary" href="{{ route('assessments.index') }}"><i class="fas fa-arrow-left"></i> Back to Assessments</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div id="accordion1">
            <div class="card">
                <div class="card-header bg-white text-primary" id="heading3" style="padding: 0;">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                            <strong>All Responses</strong>
                        </button>
                    </h5>
                </div>
                <div id="collapse3" class="collapse show" aria-labelledby="heading3" data-parent="#accordion1">
                    <div class="card-body">
                        <table id="myTable4" class="display-1 table table-condensed table-hover table-striped responsive" width="100%">
                            <thead>
                                <tr class="text-center">
                                    <th width="15%"><strong>CREATED AT</strong></th>
                                    <th><strong>REVIEWER</strong></th>
                                    <th><strong>EMAIL ADDRESS</strong></th>
                                    <th><strong>ORGANIZATION</strong></th>
                                    @foreach (App\AssCategory::where('active', true)->get() as $category)
                                    <th data-priority="1"><strong>{{ strtoupper($category->description) }}</strong></th>
                                    @endforeach
                                    <th data-priority="1"><strong>TOTAL</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($responders as $responder)

                                <tr>
                                    <td>{{ $responder->created_at }}</td>
                                    <td>{{ $responder->reviewer_name }}</td>
                                    <td>{{ $responder->email }}</td>
                                    <td>{{ $responder->organization_name }}</td>
                                    @foreach (App\AssCategory::where('active', true)->get() as $category)
                                    <td align="right">{{ App\AssResponse::where('responder_id', $responder->id)->whereIn('item_id', App\AssItem::where('category_id', $category->id)->pluck('id')->toArray())->sum('option_score') }}</td>
                                    @endforeach
                                    <td align="right">{{ App\AssResponse::where('responder_id', $responder->id)->sum('option_score') }}</td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
