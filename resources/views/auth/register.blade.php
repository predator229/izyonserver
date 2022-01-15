<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>IzyStock</title>

    
  <link href="{{ asset('/icon.png') }}" rel="icon">
  <link href="{{ asset('/icon.png') }}" rel="apple-touch-icon">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
<!-- Matomo -->

<!-- Matomo -->
<script type="text/javascript">
  var _paq = window._paq || [];
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//matomo.test/";
    _paq.push(['setTrackerUrl', u+'matomo.php']);
    _paq.push(['setSiteId', '2']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Matomo Code -->
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('/icon.png') }}" class="img-circle" width="80"> <b style="font-size: 30px">IzyStock</b>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                           
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">

                            @csrf
    
                            <div class="row">
                                
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <div class="row">
                                      <div class="col-md-6">
                                        <label for="prenom" class="form-label text-md-right">{{ __('Prenom') }}</label>
                                        <input id="prenom" type="text" class="form-control{{ $errors->has('prenom') ? ' is-invalid' : '' }}" name="prenom" value="{{ $_GET['prenom'] }}" required readonly>
                                        @if ($errors->has('prenom'))
                                        <span class="invalid-feedback text-danger text-danger" role="alert">
                                            <strong>{{ $errors->first('prenom') }}</strong>
                                        </span>
                                        @endif
                                      </div>
                                      <div class="col-md-6">
                                        <label for="nom" class="form-label text-md-right">{{ __('Nom') }}</label>
                                        <input id="nom" type="text" class="form-control{{ $errors->has('nom') ? ' is-invalid' : '' }}" name="nom" value="{{ $_GET['nom'] }}" required readonly >
                                        @if ($errors->has('nom'))
                                          <span class="invalid-feedback text-danger" role="alert">
                                              <strong>{{ $errors->first('nom') }}</strong>
                                          </span>
                                        @endif
                                      </div>
                                    </div>
                                  </div>
      
                                  <div class="form-group">
                                    <label for="email" class="form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $_GET['email'] }}" required readonly>
      
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback text-danger" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                  </div>
                                
                                  <div class="form-group">
                                    <label for="adresse" class="form-label text-md-right">{{ __('Address') }}</label>
                                    <input id="email" type="text" class="form-control{{ $errors->has('adresse') ? ' is-invalid' : '' }}" name="adresse" value="{{ $_GET['adresse'] }}" required readonly>
      
                                    @if ($errors->has('adresse'))
                                        <span class="invalid-feedback text-danger" role="alert">
                                            <strong>{{ $errors->first('adresse') }}</strong>
                                        </span>
                                    @endif
                                  </div>
                              
                                  <div class="form-group">
                                    <div class="row">
                                      
                                      <div class="col-md-6">
                                          <label for="" class="form-label text-md-right"><i class="fa fa-phone"></i> {{ __('Telephone') }} </label>
                                          <input id="" type="text" class="form-control" name="telephone" value="{{ $_GET['telephone'] }}" required readonly>
                                      </div>
                                      <div class="col-md-6">
                                          <label for="password" class="form-label text-md-right">{{ __('Type dutilisateur') }}</label>
                                        <input type="text" class="form-control" name="typeUtilisateur" readonly value="Vendeur">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="row">
                                        <div class="col-md-6">
                                            <label for="password" class="form-label text-md-right">{{ __('Password') }}</label>
                                          <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
        
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback text-danger text-danger" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif       
                                        </div>
                                        <div class="col-md-6">
                                            <label for="password-confirm" class="form-label text-md-right">{{ __('Confirm Password') }}</label>
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                        </div>
                                      </div>
                                    </div>
                                  <br>                          
                                  
                                </div>
                                
                              </div>
                              <div class="row">
                                <div class="col-xs-4"></div>
                                <div class="col-xs-4"></div>
                                <div class="col-xs-4">
                                  <div class="form-group">                             
                                    <button type="submit" class="btn btn-primary btn-block">
                                        {{ __('Enregistrer') }}
                                    </button>
                                  </div>
                                </div>
                              </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

        </main>
    </div>
</body>
</html>
