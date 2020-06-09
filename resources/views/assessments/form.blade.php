<div class="form-group row">
    {!! Form::label('title', 'Title *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::text('title1', $value = null, ['class' => 'form-control', 'placeholder' => 'Title', 'required' => true, 'maxlength' => 200]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('information', 'Information', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-8">
        {!! Form::textarea('information', $value = null, ['class' => 'form-control wysiwyg', 'placeholder' => 'Information']) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('closing_remark', 'Closing Remark', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-8">
        {!! Form::textarea('closing_remark', $value = null, ['class' => 'form-control wysiwyg', 'placeholder' => 'Closing Remark']) !!}
    </div>
</div>
<div class="form-group row">
    <div class="col-md-10 offset-md-2">
        {!! Form::submit($submit_text, ['class' => 'btn btn-primary submit']) !!}
    </div>
</div>

<script type="text/javascript">
    $('.submit').click(function () {
        tinymce.triggerSave()
    });
</script>
