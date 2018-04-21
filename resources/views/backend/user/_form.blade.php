<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>{!!$heading or 'Thêm mới'!!}</h5>
    </div>
    <div class="ibox-content">
        @if(count($errors) > 0)
        <div class="col-md-12">
            <div class="alert alert-danger">
                <strong>Lỗi:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
        <div class="form-group">
            {!! Form::label('name','Name', ['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
            {!! Form::text('name',null, ['class' => 'form-control','required','placeholder'=>'Bắt buộc']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('username','Username', ['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
            {!! Form::text('username',null, ['class' => 'form-control','required','placeholder'=>'Bắt buộc']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('email','Email', ['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
            {!! Form::email('email',null, ['class' => 'form-control','required','placeholder'=>'Bắt buộc']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('password','Password', ['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
            {!! Form::password('password', ['class' => 'form-control','placeholder'=>'Bắt buộc']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('password_confirmation','Confirm Password:', ['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
            {!! Form::password('password_confirmation', ['class' => 'form-control','placeholder'=>'Bắt buộc']) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                {!! Form::reset('Cancel', ['class' => 'btn btn-default']) !!}
            </div>
        </div>
    </div>
</div>
