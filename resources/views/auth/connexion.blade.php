<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IBAM - Connexion</title>
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,800" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link id="pagestyle" href="{{ asset('css/soft-ui-dashboard.css?v=1.1.0') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="d-flex align-items-center justify-content-center vh-100 bg-light">
    <div class="card shadow-lg p-4 w-100" style="max-width: 400px;">
        <div class="text-center ">
            <img src="{{ asset('img/logo_ibam.png') }}" alt="IBAM Logo" class="mb-3" style="max-width: 100px;">
            <h3 class="fw-bold">Gestion des Congés et Absences</h3>
            <p class="text-muted">Connectez-vous à votre compte</p>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                <li style="list-style: none; color: white">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('connexion') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Adresse email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" id="email" name="email" class="form-control" placeholder="exemple@ibam.org"
                        value="{{ old('email') }}" required autofocus>
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <div class="input-group" style="height: 50px;">
                    <span class="input-group-text d-flex align-items-center" style="height: 100%;"><i class="fas fa-lock"></i></span>
                    <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required style="height: 100%;">
                    <span class="btn toggle-password d-flex align-items-center" type="button" style="height: 100%;">
                        <i class="fas fa-eye-slash"></i>
                    </span>
                </div>
            </div>


            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-sign-in-alt me-2"></i> Se connecter
            </button>


        </form>
        <div class="text-center mt-3">
            <a href="/" class="text-decoration-none">
                <i class="fas fa-arrow-left me-1"></i> Retour à l'accueil
            </a>
        </div>
    </div>



    <script>
        document.querySelector('.toggle-password').addEventListener('click', function () {
            const passwordField = document.getElementById('password');
            const icon = this.querySelector('i');
            passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>
