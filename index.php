<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="Hugo 0.104.2">
    <title>Pokedex</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/cover/">

<!-- CSS only -->
<link href="https://getbootstrap.com/docs/5.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <!-- Favicons -->
<link rel="apple-touch-icon" href="https://getbootstrap.com/docs/5.2/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="https://getbootstrap.com/docs/5.2/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="https://getbootstrap.com/docs/5.2/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="https://getbootstrap.com/docs/5.2/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="https://getbootstrap.com/docs/5.2/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
<link rel="icon" href="https://getbootstrap.com/docs/5.2/assets/img/favicons/favicon.ico">
<meta name="theme-color" content="#712cf9">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/5.2/examples/cover/cover.css" rel="stylesheet">
  </head>
  <body class="d-flex h-100 text-center text-bg-dark">
    
<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
  <header class="mb-auto">
    <div>
      <h3 class="float-md-start mb-0">Pokedex</h3>
      <nav class="nav nav-masthead justify-content-center float-md-end">
      </nav>
    </div>
  </header>

  <main class="px-3">
    <h1>Buscar Pokemon.</h1>   
    <form>
    <div class="mb-3">
        <input type="text" value="" class="form-control-lg" id="search" require/>
    </div>    
    </form>    
    <p class="lead">
      <a href="#" id="btn_search" class="btn btn-lg btn-secondary fw-bold border-white bg-white">Buscar</a>
    </p>
    <div class="row" id="pokemon_card">
        
    </div>
  </main>
  
  <footer class="mt-auto text-white-50">
    <p>@yozhmx</p>
  </footer>
</div>
    
  </body>
  <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
  <script>
    var str_search;
    $("#btn_search").click(function() {
        str_search = $("#search").val();
        fn_search(str_search);  
    });

    function fn_search(str_search){
        $.ajax({
          method:"POST",  
          url:"controller.php",
          data:{search: str_search},
          beforeSent: function (xhr) {
            xhr.overrideMimeType("text/plain; charset=x-user-defined");
          }  
        }).done(function (data){
            console.log(data);
            const pokemon = JSON.parse(data);
            card_pokemon(pokemon);
        }).fail(function(){
            alert("No encontramos el pokemon");
        });
    }

    function card_pokemon(pokemon){
        var template = '<div class="col-12 tex-center">'
                     +   'Nombre: '+ pokemon.name +'<br/>'
                     +   '<img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/'+ pokemon.id +'.png">'
                     + '</div>';
        $("#pokemon_card").html(template);             
    }
  </script>
</html>
