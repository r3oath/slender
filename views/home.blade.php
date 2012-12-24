@layout('slender::master')
@section('title')
    Slender CMS
@endsection
@section('content')

    <div class="container_12">
        <div class="grid_12">
            <div class="home-logo">
                Slender
            </div>
            <div class="home-slogan">
                A lightweight, flexible and utterly simple CMS plugin for Laravel.
            </div>
        </div>        
    </div>
    <div class="container_12">
        <div class="grid_12">
            <div class="home-login">
                {{ Form::open('slender') }}             
                    <input type="text" required="required" placeholder="Username" name="username">
                    <input type="password" required="required" placeholder="Password" name="password">
                    <input type="submit" value="Login">
                {{ Form::close() }}
            </div>
            <div class="home-error">
                @if ($failed === '1')
                    Authentication failed. Please try again.
                @endif
            </div>
        </div>
    </div>

@endsection
@section('scripts')

@endsection