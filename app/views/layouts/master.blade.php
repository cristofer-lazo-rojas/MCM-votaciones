<!DOCTYPE html PUBLIC "">
<!-- [if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif] -->
<!-- [if IE 7]><html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif] -->
<!-- [if IE 8]><html class="no-js lt-ie9" lang="en"> <![endif] -->
<!-- [if gt IE 8]><! -->
<html>
    <!-- <![endif] -->
    <head>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>

        <![endif]-->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>

        {{HTML::script("recursos/jquery/jquery-2.1.0.js")}}
        {{HTML::script("recursos/jquery/plugin/jquery.form-validator.js")}}
        {{HTML::script("recursos/jquery/plugin/locale.js")}}
        {{HTML::script("recursos/jquery/plugin/location.js")}}
        {{HTML::script("recursos/jquery/plugin/date.js")}}
        {{HTML::script("recursos/jquery/plugin/security.js")}}
        {{HTML::script("recursos/jquery/plugin/file.js")}}
        <!--
        
        {{HTML::script("foundation/js/foundation/foundation.js")}}
        {{HTML::script("foundation/js/foundation/foundation.topbar.js")}}
        {{HTML::script("foundation/js/foundation/foundation.magellan.js")}}
        -->
        @yield('scripts')
        <!--
        {{HTML::style("foundation/css/foundation.css")}}
        {{HTML::style("foundation/css/docs.css")}}
        -->
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0-wip/css/bootstrap.min.css" />
        {{HTML::style("recursos/css/estilo.css")}}
        {{HTML::style("recursos/jquery/plugin/css/jquery.form-validator.css")}}
        @yield('estilos')


    </head>
    <body class="antialiased hide-extras" style="background: ">
        <header class="header">
            @yield('header')
        </header>
        <nav class="nav">
            @yield('nav')
        </nav>
        <section class="main">
            @yield('content')
        </section>
        <footer class="footer">
            @yield('footer')
        </footer>
        <!--
        <script>
            $(document).foundation();
        </script>
        -->
        
        <script>
            $.validate({
                language : localeFormValidator('es'),
                modules : 'location, date, security, file'
            });            
        </script>
    </body>
</html>
