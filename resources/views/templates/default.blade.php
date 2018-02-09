<!DOCTYPE html>
<html>
    <head>
        <title>Rifa Web</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://fonts.googleapis.com/css?family=Lato:100,400,700,900" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="{{ url('css/materialize.css') }}" media="screen" />
        <link rel="stylesheet" type="text/css" href="{{ url('css/font-awesome.min.css') }}" media="screen" />
        <link rel="stylesheet" type="text/css" href="{{ url('css/jquery.flipcountdown.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ url('js/bxslider/css/jquery.bxslider.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ url('css/style.css') }}?v={{rand()}}" media="screen" />
        @yield('header')
        

        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="{{ url('js/countdown.js') }}"></script>
      </head>
    <body>
        <section class="navigation">
            <div class="container">
             @if (Auth::guest())

             @else
             <?php
                        $usuario=App\User::find(Auth::user()->id);

                        if ($usuario->mensajes) {
                          $nuevos=App\Mensaje::where('user_id',$usuario->id)->where('leido',0)->count();
                        }
                      ?>  

                      <ul id="dropdown1" class="dropdown-content">
                        <li><a href="{{url('/perfil')}}">Perfil</a></li>
                        <li><a href="#">Mensajes @if($nuevos>0)<span class="new badge" data-badge-caption="">{{$nuevos}}</span>@endif</a></li>
                        <li><a href="#">Mis Rifas</a></li>
                        <li><a href="#">Direcciones</a></li>
                      </ul>
                      <ul id="dropdown0" class="dropdown-content">
                        <li><a href="#!">one</a></li>
                        <li><a href="#!">two</a></li>
                        <li class="divider"></li>
                        <li><a href="#!">three</a></li>
                      </ul>
              @endif
              

                <nav>
                  <div class="nav-wrapper">
                    <a class="brand-logo center auto hiddenmov" href="{{url('/')}}"><img src="{{url('img/Rifaweb2.png')}}" alt=""></a>
                    
                    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="fa fa-bars fa-2x"></i></a>
                    <ul class="right hide-on-med-and-down valign-wrapper" style="height: -webkit-fill-available;">
                      @if (Auth::guest())
                        <li><a href="{{url('/entrar')}}">ENTRAR</a></li>
                      @else
                      
                      <li><a class="dropdown-button" href="#!" data-activates="dropdown1">MI CUENTA</a></li>
                      <li><a href="{{url('/salir')}}">SALIR</a></li>
                      <li><a href="{{url('/carrito')}}"> CARRITO @if (Cart::content()->count()>0) ({{Cart::content()->count()}}) @endif</a></li>
                      @endif
                    </ul>
                    
                    <ul class="side-nav" id="mobile-demo">
                      @if (Auth::guest())
                        <li><a href="{{url('/entrar')}}">ENTRAR</a></li>
                      @else
                      <li><a class="dropdown-button" href="#!" data-activates="dropdown0">MI CUENTA</a></li>
                      <li><a href="{{url('/salir')}}">SALIR</a></li>
                      <li><a href="{{url('/carrito')}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> CARRITO @if (Cart::content()->count()>0) ({{Cart::content()->count()}}) @endif</a></li>
                      @endif
                    </ul>
                  </div>
                </nav>
            </div>
        </section>
        <section class="buttonsbar">
          <div class="container">
            <div class="row" style="margin-bottom:0;">
              <div class="col l2 s12 m2">
                
                  <div class="bouton_google text-center">
                    <div class="google_volet" style="background-color:#dd4b39;"><i class="fa fa-ticket fa-3x" aria-hidden="true"></i> <br><span class="hiddenmov">Rifas</span> </div>
                    <a href="{{url('/rifas')}}" style="text-decoration:none; color:#dd4b39;">
                      <div class="txt_google"><span class="hiddenmov">Todas las rifas</span><span class="visiblemov">Rifas</span> <br> <i class="fa fa-chevron-down fa-3x" aria-hidden="true"></i></div>
                    </a>
                  </div>
                
              </div>
              <div class="col l2 s12 m2">
                
                  <div class="bouton_google text-center">
                    <div class="google_volet" style="background-color:#25B6D2;"><i class="fa fa-user fa-3x" aria-hidden="true"></i> <br><span class="hiddenmov">Perfil</span> </div>
                    <a href="{{url('/rifas')}}" style="text-decoration:none; color:#25B6D2;">
                      <div class="txt_google"><span class="hiddenmov">Tus rifas, mensajes y premios</span><span class="visiblemov">Perfil</span> <br> <i class="fa fa-chevron-down fa-3x" aria-hidden="true"></i></div>
                    </a>
                  </div>
                
              </div>
              <div class="col l2 s12 m2">
                
                  <div class="bouton_google text-center">
                    <div class="google_volet" style="background-color:#FFCD50;"><i class="fa fa-trophy fa-3x" aria-hidden="true"></i> <br><span class="hiddenmov">Rifas ganadas</span> </div>
                    <a href="#123" style="text-decoration:none; color:#FFCD50;">
                      <div class="txt_google"><span class="hiddenmov">Ganadores de las rifas anteriores</span><span class="visiblemov">Ganadores</span> <br> <i class="fa fa-chevron-down fa-3x" aria-hidden="true"></i></div>
                    </a>
                  </div>
                
              </div>
              <div class="col l2 s12 m2">
                
                  <div class="bouton_google text-center">
                    <div class="google_volet" style="background-color:#2072A0;"><i class="fa fa-cogs fa-3x" aria-hidden="true"></i> <br> <span class="hiddenmov">¿Cómo Funciona?</span> </div>
                    <a href="#123" style="text-decoration:none; color:#2072A0;">
                      <div class="txt_google"><span class="hiddenmov">Ayuda sobre la plataforma</span><span class="visiblemov">Ayuda</span> <br> <i class="fa fa-chevron-down fa-3x" aria-hidden="true"></i></div>
                    </a>
                  </div>
                
              </div>
              <div class="col l2 s12 m4">
                
                  <div class="bouton_google text-center">
                    <div class="google_volet" style="background-color:#C61867;"><i class="fa fa-book fa-3x" aria-hidden="true"></i> <br><span class="hiddenmov">Permisos y Docs</span> </div>
                    <a href="#123" style="text-decoration:none; color:#C61867;">
                      <div class="txt_google"><span class="hiddenmov">Documentos legales</span><span class="visiblemov">Legales</span> <br> <i class="fa fa-chevron-down fa-3x" aria-hidden="true"></i></div>
                    </a>
                  </div>
                
              </div>
            </div>
          </div>
        </section>
        




        @yield('pagecontent')

        
        
        <footer>
          <div class="container">
            <div class="col l12">
              <p>Creado por PYM Digital</p>

              <p>Copyright 2017 © RifaWeb</p>
            </div>
          </div>
          
        </footer>
        <a href="#" id="back-to-top" title="Regresar arriba">&uarr;</a>
        <script type="text/javascript" src="{{ url('js/materialize.js') }}"></script>
        <script type="text/javascript" src="{{ url('js/bxslider/js/jquery.bxslider.js') }}"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>


        @yield('scripts')

        <script type="text/javascript" src="{{ url('js/script.js') }}"></script>
        <script>
          $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();     
            $('.collapsible').collapsible();
            $(".button-collapse").sideNav();
  // Initialize collapsible (uncomment the line below if you use the dropdown variation)
            $('.collapsible').collapsible();
            $('#tipo').material_select();
            $('.modal').modal();
            $('.slider').bxSlider({
              auto: true,

              stopAutoOnClick: true,
              adaptiveHeight: true,
              infiniteLoop: true,
              responsive: true,
              touchEnabled: true,
              mode: 'fade',

            });

            $('.materialboxed').materialbox();

            
            

         


          });
        </script>
    </body>
</html>