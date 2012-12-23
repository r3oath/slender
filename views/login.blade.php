{{ Form::open('slender/login') }}
    {{ Form::text('username', '', array('required' => 'required', 'size' => '15')) }}
    {{ Form::password('password', array('required' => 'required', 'size' => '15')) }}
    {{ Form::submit('Login') }}
{{ Form::close() }}