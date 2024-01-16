<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
		<style>
			label {
				color: #203e6a;
				font-weight: bold;
			}
		</style>
	</head>
	<body>
		<div class="col-12">
				<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
					<div class="container-fluid ">
						<div class="collapse navbar-collapse" id="navbarColor01">
							<ul class="navbar-nav me-auto mb-2 mb-lg-0">
								<li class="nav-item">
									<a class="nav-link" href="/">Home</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="{{ route('autor.index')  }}">Autores</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="{{ route('assunto.index')  }}">Assuntos</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="{{ route('livro.index')  }}">Livros</a>
								</li>
							</ul>
						</div>
					</div>
				</nav>
				<div class="container mt-2">
					<div class="col-12">
						@if ($errors->any())
							<div class="alert-danger mb-2">
								<ul class="list-group">
									@foreach ($errors->all() as $error)
										<li class="list-group-item list-group-item-danger mt-1">{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif
						@if (\Session::has('success'))
							<div class="alert-success mb-2">
								<ul class="list-group">
									<li class="list-group-item list-group-item-success mt-1">{!! \Session::get('success') !!}</li>
								</ul>
							</div>
						@endif

						@yield('content')
					</div>
				</div>

		</div>
	</body>
</html>