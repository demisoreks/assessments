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
        <a class="btn btn-primary" href="{{ route('assessments.categories.items.options.create', [$assessment->slug(), $category->slug(), $item->slug()]) }}"><i class="fas fa-plus"></i> New Option</a>
        <a class="btn btn-primary" href="{{ route('assessments.categories.items.index', [$assessment->slug(), $category->slug()]) }}"><i class="fas fa-arrow-left"></i> Back to Items</a>
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
                        <table id="myTable1" class="display-1 table table-condensed table-hover table-striped responsive" width="100%">
                            <thead>
                                <tr class="text-center">
                                    <th width="10%"><strong>ORDER NUMBER</strong></th>
                                    <th><strong>DESCRIPTION</strong></th>
                                    <th width="10%"><strong>SCORE</strong></th>
                                    <th width="35%"><strong>REMARK</strong></th>
                                    <th width="10%" data-priority="1">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($options as $option)

                                <tr>
                                    <td align="right">{{ $option->order_number }}</td>
                                    <td>{{ $option->description }}</td>
                                    <td align="right">{{ $option->score }}</td>
                                    <td>{{ $option->remark }}</td>
                                    <td class="text-center">
                                        <a title="Trash" href="{{ route('assessments.categories.items.options.disable', [$assessment->slug(), $category->slug(), $item->slug(), $option->slug()]) }}" onclick="return confirmDisable()"><i class="fas fa-trash"></i></a>
                                    </td>
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
