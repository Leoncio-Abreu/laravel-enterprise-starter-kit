<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Col&eacute;gio Uni&atilde;o</title>
        <!-- Bootstrap Core CSS -->
        <link href="{{ asset("/bower_components/admin-lte/bootstrap/css/bootstrap.css") }}" rel="stylesheet" type="text/css" />
        <!-- Custom CSS -->
        <!-- Custom Fonts -->
        <link href="{{ asset("/bower_components/admin-lte/font-awesome/css/font-awesome.min.css") }}" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="{{ asset("/css/hexagons.css") }}" >
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
<style type="text/css">
        .jumbotron {
            background-image: url("img/fundo_top.jpg");
            background-size: cover;
        }
/*        .col-md-6 > .panel{
            position:relative;
        }
        .col-md-6 .panel-footer{
            position:absolute;
            width:100%;
            bottom:0;
        }*/
        .jumbotron_height {
            padding: 0px;
            margin: 0px;
        }
        .panel-body {
            background: white;
            word-wrap: break-word;
        }
		.panel-title{
			text-align:center;
		}
        .bg_white {
            background: white;
          }
/*        .col-md-7, .col-md-5 {
            background: white;
        }*/
        @media only screen and (max-width : 767px) {
            .box {
                height: auto !important;
            } 
        }
        body {
            -webkit-font-smoothing: antialiased;
        }
.dropdown-menu { left:auto; }

.navbar{
    margin-bottom: 0px !important;
} 
p {
    font-family: "Times New Roman", Times, serif;
    color: black;
}
address {
    color: black;
}
.no-gutters {
position: relative;
bottom: -20px;
}

.carousel-inner > .item > img {
    margin: 0 auto;
}
/*@media (min-width: 1200px) {
  .container {
    width: 800px;
   }
}*/
iframe, object, embed {
    max-width: 100%;
}
body{ background: lightgray !important; }
    </style>
  </head>
  <body id="page-top" class="index">
    
        @include('partials._frontend_header')
    
        @include('partials._frontend_navigation')
    
        @yield('content')
    
        @include('partials._frontend_footer')
    
    </body>
</html>
