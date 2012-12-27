<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width">
    {{ HTML::style('bundles/slender/css/normalize.css') }}    
    {{ HTML::style('bundles/slender/css/960_12_col.css') }}
    {{ HTML::style('bundles/slender/css/fontello.css') }}
    {{ HTML::style('http://fonts.googleapis.com/css?family=Domine:400,700|Berkshire+Swash') }}
    <!-- Slender -->
    {{ HTML::style('bundles/slender/css/style.css') }}
    <!-- Markitup -->
    {{ HTML::style('bundles/slender/markitup/skins/markitup/style.css') }}
    {{ HTML::style('bundles/slender/markitup/sets/default/style.css') }}
</head>
<body>
    
    @yield('content')
    
    <div class="footer-container">
        <div class="bar-top"></div>
        <div class="footer">
            @render('slender::footer')
        </div>
    </div>

    <span id="tooltip-box"></span>

    {{ HTML::script('bundles/slender/js/vendor/jquery.js') }}
    {{ HTML::script('bundles/slender/js/vendor/underscore.js') }}
    {{ HTML::script('bundles/slender/js/vendor/backbone.js') }}
    <!-- Markitup -->
    {{ HTML::script('bundles/slender/markitup/jquery.markitup.js') }}
    {{ HTML::script('bundles/slender/markitup/sets/default/set.js') }}
    <!-- Slender -->
    {{ HTML::script('bundles/slender/js/tag-manager.min.js') }}
    {{ HTML::script('bundles/slender/js/tooltips.min.js') }}
    {{ HTML::script('bundles/slender/js/menu-items.min.js') }}

    @yield('scripts')

</body>
</html>