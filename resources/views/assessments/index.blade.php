@extends('app', ['page_title' => 'Assessments'])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('assessments.create') }}"><i class="fas fa-plus"></i> New Assessment</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div id="accordion1">
            <div class="card">
                <div class="card-header bg-white text-primary" id="heading3" style="padding: 0;">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                            <strong>Active</strong>
                        </button>
                    </h5>
                </div>
                <div id="collapse3" class="collapse show" aria-labelledby="heading3" data-parent="#accordion1">
                    <div class="card-body">
                        <table id="myTable3" class="display-1 table table-condensed table-hover table-striped responsive" width="100%">
                            <thead>
                                <tr class="text-center">
                                    <th width="15%"><strong>CREATED AT</strong></th>
                                    <th><strong>TITLE</strong></th>
                                    <th width="15%" data-priority="1">&nbsp;</th>
                                    <th width="15%" data-priority="1">&nbsp;</th>
                                    <th width="10%" data-priority="1">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assessments as $assessment)
                                    @if ($assessment->active)
                                <tr>
                                    <td>{{ $assessment->created_at }}</td>
                                    <td>{{ $assessment->title }}<br />Link: <a href="{{ config('app.url').'/assessments/'.$assessment->slug().'/take' }}">{{ config('app.url').'/assessments/'.$assessment->slug().'/take' }}</a></td>
                                    <td><a class="btn btn-primary btn-block btn-sm" href="{{ route('assessments.categories.index', [$assessment->slug()]) }}">Categories</a></td>
                                    <td><a class="btn btn-primary btn-block btn-sm" href="{{ route('assessments.responders.index', [$assessment->slug()]) }}">Responses ({{ App\AssResponder::where('assessment_id', $assessment->id)->count() }})</a></td>
                                    <td class="text-center">
                                        <a title="Edit" href="{{ route('assessments.edit', [$assessment->slug()]) }}"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
                                        <a title="Trash" href="{{ route('assessments.disable', [$assessment->slug()]) }}" onclick="return confirmDisable()"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-white text-primary" id="heading4" style="padding: 0;">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
                            <strong>Inactive</strong>
                        </button>
                    </h5>
                </div>
                <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#accordion1">
                    <div class="card-body">
                        <table id="myTable2" class="display-1 table table-condensed table-hover table-striped responsive" width="100%">
                            <thead>
                                <tr class="text-center">
                                    <th width="15%"><strong>CREATED AT</strong></th>
                                    <th><strong>TITLE</strong></th>
                                    <th width="15%" data-priority="1">&nbsp;</th>
                                    <th width="15%" data-priority="1">&nbsp;</th>
                                    <th width="10%" data-priority="1">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assessments as $assessment)
                                    @if (!$assessment->active)
                                <tr>
                                    <td>{{ $assessment->created_at }}</td>
                                    <td>{{ $assessment->title }}<br />Link: <a href="{{ config('app.url').'/assessments/'.$assessment->slug().'/take' }}">{{ config('app.url').'/assessments/'.$assessment->slug().'/take' }}</a></td>
                                    <td><a class="btn btn-primary btn-block btn-sm" href="{{ route('assessments.categories.index', [$assessment->slug()]) }}">Categories</a></td>
                                    <td><a class="btn btn-primary btn-block btn-sm" href="{{ route('assessments.responders.index', [$assessment->slug()]) }}">Responses ({{ App\AssResponder::where('assessment_id', $assessment->id)->count() }})</a></td>
                                    <td class="text-center">
                                        <a title="Restore" href="{{ route('assessments.enable', [$assessment->slug()]) }}"><i class="fas fa-undo"></i></a>
                                    </td>
                                </tr>
                                    @endif
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
