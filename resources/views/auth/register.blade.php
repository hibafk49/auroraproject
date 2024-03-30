<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Formulaire d'inscription</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>

		<div class="wrapper" style="background-image: url('images/bg-registration-form-1.jpg');">
			<div class="inner">
				<div class="image-holder">
					<img src="images/registration-form-1.jpg" alt="">
				</div>
				<form method="POST" action="{{ route('register') }}">
					@csrf
					<h3>Inscription</h3>
					<div class="form-group">
						<label for="nom" class="col-md-4 col-form-label text-md-end">Nom</label>
						<input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom') }}" required autofocus>
						@error('nom')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>

					<div class="form-group">
						<label for="email" class="col-md-4 col-form-label text-md-end">Adresse Email</label>
						<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
						@error('email')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>

					<div class="form-group">
						<label for="mdp" class="col-md-4 col-form-label text-md-end">Mot de passe</label>
						<input id="mdp" type="password" class="form-control @error('mdp') is-invalid @enderror" name="mdp" required>
						@error('mdp')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					
					<div class="form-group">
						<label for="numero_telephone" class="col-md-4 col-form-label text-md-end">Numéro de téléphone</label>
						<input id="numero_telephone" type="text" class="form-control @error('numero_telephone') is-invalid @enderror" name="numero_telephone" value="{{ old('numero_telephone') }}" required>
						@error('numero_telephone')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>

					<div class="form-group">
						<label for="adresse" class="col-md-4 col-form-label text-md-end">Adresse</label>
						<input id="adresse" type="text" class="form-control @error('adresse') is-invalid @enderror" name="adresse" value="{{ old('adresse') }}" required>
						@error('adresse')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>

					<div class="form-group mb-0">
						<div class="col-md-6 offset-md-4">
							<button type="submit" class="btn btn-primary">S'inscrire</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		
	</body>
</html>
