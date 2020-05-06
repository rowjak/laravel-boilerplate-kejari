
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Bootstrap 4 Admin &amp; Dashboard Template">
	<meta name="author" content="Bootlab">

	<title>Sign In - AppStack - Admin &amp; Dashboard Template</title>

	<link rel="preconnect" href="//fonts.gstatic.com/" crossorigin="">

	<!-- PICK ONE OF THE STYLES BELOW -->
	<link href="{{asset('')}}back/css/classic.css" rel="stylesheet">
</head>

<body>
	<main class="main d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row h-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Anjungan Mini Kejaksaan Negeri Kab. Batang</h1>
							<p class="lead">
								Login Terlebih Dahulu Untuk Melanjutkan
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<div class="text-center">
										<img src="{{asset('logo.png')}}" alt="Kejaksaan Negeri Kab. Batang" class="img-fluid rounded-circle" width="192" height="192">
									</div>
                                    <form method="post" action="{{route('login')}}">
                                        {{csrf_field()}}
										<div class="form-group">
											<label>Username</label>
											<input class="form-control form-control-lg" type="text" name="username" placeholder="Username">
										</div>
										<div class="form-group">
											<label>Password</label>
											<input class="form-control form-control-lg" type="password" name="password" placeholder="Masukkan Password">
										</div>
										<div class="text-center mt-3">
											<button type="submit" class="btn btn-lg btn-primary">Masuk</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
	<script src="{{asset('')}}back/js\app.js"></script>

</body>

</html>
