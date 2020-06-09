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
    {!! Form::label('weight', 'Weight *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::number('weight', $value = null, ['class' => 'form-control', 'placeholder' => 'Weight', 'required' => true, 'step' => 0.01]) !!}
    </div>
</div>
<div class="form-group row">
    <div class="col-md-10 offset-md-2">
        {!! Form::submit($submit_text, ['class' => 'btn btn-primary submit']) !!}
    </div>
</div>
