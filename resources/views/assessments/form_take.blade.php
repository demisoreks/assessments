<div class="form-group row">
    {!! Form::label('organization_name', 'Name of Organization *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::text('organization_name', $value = null, ['class' => 'form-control', 'placeholder' => 'Name of Organization', 'required' => true, 'maxlength' => 100]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('reviewer_name', 'Name of Reviewer *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::text('reviewer_name', $value = null, ['class' => 'form-control', 'placeholder' => 'Name of Reviewer', 'required' => true, 'maxlength' => 100]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('email', 'Email Address *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::email('email', $value = null, ['class' => 'form-control', 'placeholder' => 'Email Address', 'required' => true, 'maxlength' => 100]) !!}
    </div>
</div>
<?= html_entity_decode($assessment->information) ?>
<table class="table table-bordered table-responsive-md" width="100%">
    @foreach (App\AssCategory::where('assessment_id', $assessment->id)->where('active', true)->orderBy('order_number')->get() as $category)
    <tr>
        <td>
            <div class="row">
                <div class="col-md-2" style="font-weight: bold;">
                    {{ $category->description }}<br />(Total: {{ App\AssItem::where('category_id', $category->id)->where('active', true)->sum('weight') }})
                </div>
                <div class="col-md-10">
                    <table class="table table-striped table-hover" width="100%">
                        @foreach (App\AssItem::where('category_id', $category->id)->where('active', true)->orderBy('order_number')->get() as $item)
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-md-7">{{ $item->description }}</div>
                                    <div class="col-md-2">{!! Form::select('option'.$item->id, App\AssOption::select(DB::raw("CONCAT(description, ' (', score, ')') AS opt"), 'id')->where('item_id', $item->id)->orderBy('order_number')->pluck('opt', 'id'), $value = null, ['class' => 'form-control select-option', 'placeholder' => '- Select Option -', 'required' => true]) !!}</div>
                                    <div class="col-md-3"><div id="remark{{ $item->id }}" class="text-danger"></div></div>
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
<div class="form-group row">
    <div class="col-md-12">
        {!! Form::submit($submit_text, ['class' => 'btn btn-primary btn-block btn-lg', 'onClick' => 'return confirmSubmit()']) !!}
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".select-option").change(function() {
            var option_id  = $(this).val();
            var myString = "";

            var ajaxRequest = null;

            var browser = navigator.appName;
            if (browser == "Microsoft Internet Explorer") {
                ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
            } else {
                ajaxRequest = new XMLHttpRequest();
            }

            ajaxRequest.onreadystatechange = function() {
                if (ajaxRequest.readyState == 4) {
                    var json_object = JSON.parse(ajaxRequest.responseText);
                    $('#remark'+json_object.item_id).text(json_object.remark);
                }
            }

            ajaxRequest.open("GET", "../../option/"+option_id, true);
            ajaxRequest.send(null);
        });
    });
</script>
