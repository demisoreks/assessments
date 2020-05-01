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
<table class="table table-bordered table-responsive-md" width="100%">
    @foreach (App\AssCategory::where('active', true)->orderBy('order_number')->get() as $category)
    <tr>
        <td width="20%" style="font-weight: bold;">{{ $category->description }}<br />(Total: {{ App\AssItem::where('category_id', $category->id)->where('active', true)->sum('weight') }})</td>
        <td>
            <table class="table table-striped table-hover" width="100%">
                @foreach (App\AssItem::where('category_id', $category->id)->where('active', true)->orderBy('order_number')->get() as $item)
                <tr>
                    <td width="60%">{{ $item->description }}</td>
                    <td width="20%">{!! Form::select('option'.$item->id, App\AssOption::select(DB::raw("CONCAT(description, ' (', score, ')') AS opt"), 'id')->where('item_id', $item->id)->orderBy('order_number')->pluck('opt', 'id'), $value = null, ['class' => 'form-control', 'placeholder' => '- Select Option -', 'required' => true]) !!}</td>
                    <td width="20%">{!! Form::textarea('remark'.$item->id, $value = null, ['class' => 'form-control', 'placeholder' => 'Remark', 'maxlength' => 200, 'rows' => 2]) !!}</td>
                </tr>
                @endforeach
            </table>
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
        $("#location_id").change(function() {
            document.getElementById('course_id').length = 1;
            var location_id = $("#location_id").val();
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
                    for (var key in json_object) {
                        if (json_object.hasOwnProperty(key)) {
                            $("#course_id").append("<option value='"+json_object[key].id+"'>"+json_object[key].start+" - "+json_object[key].end+"</option>");
                        }
                    }
                }
            }
            
            ajaxRequest.open("GET", "locations/"+location_id+"/getCoursesDesc", true);
            ajaxRequest.send(null);
        });
    });
</script>