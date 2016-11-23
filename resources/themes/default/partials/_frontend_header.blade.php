			<div class="row">
				<div class="col-md-12">
					<nav class="navbar navbar-default">
						<div class="container-fluid">
						<!-- Brand and toggle get grouped for better mobile display -->
							<div class="navbar-header">
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<a class="navbar-brand" href="/"><i class="fa fa-home fa-fw"></i>Home</a>
							</div>
							<!-- Collect the nav links, forms, and other content for toggling -->
							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
								<ul class="nav navbar-nav">
									<li><a href="https://accounts.google.com" target="_blank">WebMail</a></li>
									<li><a href="http://integrador.colegiouniao.net">Portal Acadêmico</a></li>
									<li><a href="http://www.sistemapoliedro.com.br" target="_blank">Poliedro</a></li>
									<li><a href="http://redepitagoras.com.br" target="_blank">Pitágoras</a></li>
									<li><a href="http://www.colegiouniao.net/index.php?option=com_content&view=section&layout=blog&id=12&Itemid=30">Vídeos</a></li>
								</ul>
								@if (Auth::user()) <a class="btn btn-warning pull-right" href="painel" target="_blank">Painel</a>@endif
							</div>
						</div>
					</nav>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="carousel slide" id="carousel-759016" >
				<ol class="carousel-indicators">
                      <li class="active" data-slide-to="0" data-target="#carousel-759016">
                      </li>
                      <li data-slide-to="1" data-target="#carousel-759016">
                      </li>
                      <li data-slide-to="2" data-target="#carousel-759016">
                      </li>
                </ol>
                <div class="carousel-inner">
					<div class="item active">
						<img src={{ asset("/img/slide_show_01.jpg") }}>
                        <div class="carousel-caption"></div>
                    </div>
                    <div class="item">
						<img src={{ asset("/img/slide_show_02.jpg") }}>
                        <div class="carousel-caption"></div>
                    </div>
                    <div class="item">
						<img src={{ asset("/img/slide_show_03.jpg") }}>
                        <div class="carousel-caption"></div>
                    </div>
				</div>
						<a class="left carousel-control" href="#carousel-759016" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#carousel-759016" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<nav class="navbar navbar-default">
						<div class="container-fluid">
							<!-- Brand and toggle get grouped for better mobile display -->
							<div class="navbar-header">
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2" aria-expanded="false">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							</div>
							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
								<ul class="nav navbar-nav">
									<li class="{{ isActiveRoute('welcome') }}"><a href="/"><i class="fa fa-home fa-fw"></i>Home</a></li>
									<li class="{{ isActiveRoute('unidades') }}"><a href="/unidades">Unidades</a></li>
									<li class="{{ isActiveRoute('historia') }}"><a href="/historia">Hist&oacute;ria</a></li>
									<li class="{{ isActiveRoute('contato') }}"><a href="/contato">Contato</a></li>
								</ul>
							</div>
						</div>
					</nav>
				</div>
			</div>
