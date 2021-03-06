<div class="form-group row">
    {!! Form::label('order_number', 'Order Number *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::number('order_number', $value = null, ['class' => 'form-control', 'placeholder' => 'Order Number', 'required' => true]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('description', 'Description *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::text('description', $value = null, ['class' => 'form-control', 'placeholder' => 'Description', 'required' => true, 'maxlength' => 200]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('score', 'Score *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::number('score', $value = null, ['class' => 'form-control', 'placeholder' => 'Score', 'required' => true, 'step' => 0.01]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('remark', 'Remark', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::text('remark', $value = null, ['class' => 'form-control', 'placeholder' => 'Remark', 'maxlength' => 200]) !!}
    </div>
</div>
<div class="form-group row">
    <div class="col-md-10 offset-md-2">
        {!! Form::submit($submit_text, ['class' => 'btn btn-primary submit']) !!}
    </div>
</div>
