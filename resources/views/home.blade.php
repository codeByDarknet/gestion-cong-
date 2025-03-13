<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/logo_ibam.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('img/logo_ibam.png') }}">
    <title>GCA IBAM - Gestion des Congés et Absences</title>
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,800" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Nucleo Icons -->
    <link href="{{ asset('css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('css/soft-ui-dashboard.css?v=1.1.0') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .landing-hero {
            background-image: url('/api/placeholder/1200/600');
            background-size: cover;
            background-position: center;
            position: relative;
            height: 100vh;
            display: flex;
            align-items: center;
            background: linear-gradient(rgba(17, 1, 82, 0.7), rgba(67, 97, 238, 0.7));
        }

        .landing-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;


        }

        .landing-hero-content {
            position: relative;
            z-index: 2;
            color: white;
        }

        .feature-card {
            transition: all 0.3s ease;
            border-radius: 1rem;
            overflow: hidden;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .landing-cta {
            background: linear-gradient(310deg, #2152ff 0%, #21d4fd 100%);
        }

        .step-card {
            position: relative;
            border-radius: 1rem;
            overflow: hidden;
        }

        .step-number {
            position: absolute;
            top: -15px;
            left: 15px;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            z-index: 2;
            background: linear-gradient(310deg, #2152ff 0%, #21d4fd 100%);
            color: white;
        }

        .testimonial-card {
            min-height: 250px;
        }

        .testimonial-slider {
            overflow-x: auto;
            padding: 2rem 0;
            display: flex;
            gap: 20px;
        }

        @media (max-width: 768px) {
            .feature-card {
                margin-bottom: 20px;
            }

            .step-card {
                margin-bottom: 30px;
            }
        }
    </style>
</head>


<body class="g-sidenav-show bg-gray-100">
    <main class="main-content position-relative max-height-vh-100 h-100">
        <!-- Navigation -->
        <nav
            class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent">
            <div class="container" style="z-index: 2">
                <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-white" href="#">
                    <img src="{{ asset('img/logo_ibam.png') }}" height="40" alt="IBAM Logo" class="me-2">
                    IBAM Gestion des Congés
                </a>
                <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon mt-2">
                        <span class="navbar-toggler-bar bar1"></span>
                        <span class="navbar-toggler-bar bar2"></span>
                        <span class="navbar-toggler-bar bar3"></span>
                    </span>
                </button>
                <div class="collapse navbar-collapse" id="navigation">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link text-white font-weight-bold d-flex align-items-center me-2"
                                href="#features">
                                Fonctionnalités
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white font-weight-bold d-flex align-items-center me-2"
                                href="#how-it-works">
                                Processus
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white font-weight-bold d-flex align-items-center me-2"
                                href="#testimonials">
                                Témoignages
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-sm bg-gradient-primary px-3 mb-0 ms-3 text-white" href="/connexion">
                                <i class="fas fa-sign-in-alt me-1"></i> Connexion
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="landing-hero mb-5">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Texte à gauche -->
                    <div class="col-lg-6 landing-hero-content">
                        <h1 class="text-white font-weight-bolder display-4 mb-4">
                            La gestion des demandes de congés simplifiée !
                        </h1>
                        <p class="text-white opacity-8 lead pe-5 mb-4">
                            Notre plateforme numérique révolutionne la manière dont vous demandez et gérez vos congés et
                            absences professionnelles.
                        </p>
                        <div class="buttons">
                            {{-- route de connexion --}}
                            <a href="/connexion" class="btn bg-gradient-primary mb-0 me-2">
                                <i class="fas fa-user me-1"></i> Commencer maintenant
                            </a>
                            <a href="#features" class="btn btn-outline-white mb-0">
                                <i class="fas fa-info-circle me-1"></i> En savoir plus
                            </a>
                        </div>
                    </div>

                    <!-- Image à droite -->
                    <div class="col-lg-6 text-center">
                        <img src="{{ asset('img/illustrations_home.png') }}" alt="Hero Image" class="img-fluid">
                    </div>
                </div>
            </div>
        </section>


        <!-- Features Section -->
        <section id="features" class="py-5 mt-7">
            <div class="container">
                <div class="row justify-content-center mb-5">
                    <div class="col-lg-8 text-center">
                        <h2 class="text-gradient text-primary mb-0">Fonctionnalités principales</h2>
                        <h3 class="font-weight-bolder mb-3">Tout ce dont vous avez besoin</h3>
                        <p class="lead">Découvrez comment notre application simplifie votre quotidien</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 feature-card">
                            <div class="card-body p-4">
                                <div class="text-center feature-icon text-gradient text-primary">
                                    <i class="fas fa-file-signature"></i>
                                </div>
                                <h5 class="font-weight-bolder mt-3">Demande simplifiée</h5>
                                <p>Créez et soumettez vos demandes de congé en quelques clics, sans paperasse ni délais
                                    administratifs.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 feature-card">
                            <div class="card-body p-4">
                                <div class="text-center feature-icon text-gradient text-primary">
                                    <i class="fas fa-users"></i>
                                </div>
                                <h5 class="font-weight-bolder mt-3">Validation hiérarchique</h5>
                                <p>Processus de validation transparent avec notifications automatiques pour les
                                    responsables hiérarchiques.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 feature-card">
                            <div class="card-body p-4">
                                <div class="text-center feature-icon text-gradient text-primary">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <h5 class="font-weight-bolder mt-3">Suivi en temps réel</h5>
                                <p>Suivez l'état de vos demandes à tout moment et consultez votre historique de congés
                                    complet.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 feature-card">
                            <div class="card-body p-4">
                                <div class="text-center feature-icon text-gradient text-primary">
                                    <i class="fas fa-mobile-alt"></i>
                                </div>
                                <h5 class="font-weight-bolder mt-3">Accessible partout</h5>
                                <p>Accédez à la plateforme depuis n'importe quel appareil connecté à internet, au bureau
                                    ou en déplacement.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 feature-card">
                            <div class="card-body p-4">
                                <div class="text-center feature-icon text-gradient text-primary">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <h5 class="font-weight-bolder mt-3">Planification avancée</h5>
                                <p>Planifiez vos congés à l'avance avec la possibilité de les modifier avant validation.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 feature-card">
                            <div class="card-body p-4">
                                <div class="text-center feature-icon text-gradient text-primary">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <h5 class="font-weight-bolder mt-3">Sécurité des données</h5>
                                <p>Toutes vos informations sont protégées et sécurisées selon les normes
                                    institutionnelles les plus strictes.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- How it works Section -->
        <section id="how-it-works" class="py-5 mt-3 bg-gray-100">
            <div class="container">
                <div class="row justify-content-center mb-5">
                    <div class="col-lg-8 text-center">
                        <h2 class="text-gradient text-primary mb-0">Comment ça marche</h2>
                        <h3 class="font-weight-bolder mb-3">Un processus simple en 3 étapes</h3>
                        <p class="lead">Notre application rend la gestion des congés plus fluide et transparente</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 mb-lg-0 mb-4">
                        <div class="card" style="opacity: 1 !important;">
                            <div class="step-number">1</div>
                            <div class="card-body p-4 pt-5">
                                <h5 class="font-weight-bolder">Soumettez votre demande</h5>
                                <p>Connectez-vous à votre compte et remplissez le formulaire de demande de congé en
                                    précisant les dates, le type de congé et le motif.</p>
                                <a href="javascript:;" class="text-primary icon-move-right">
                                    En savoir plus
                                    <i class="fas fa-arrow-right text-sm ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-lg-0 mb-4">
                        <div class="card" style="opacity: 1 !important;">
                            <div class="step-number">2</div>
                            <div class="card-body p-4 pt-5">
                                <h5 class="font-weight-bolder">Validation hiérarchique</h5>
                                <p>Votre responsable reçoit une notification par email et peut approuver ou rejeter
                                    votre demande directement depuis son interface.</p>
                                <a href="javascript:;" class="text-primary icon-move-right">
                                    En savoir plus
                                    <i class="fas fa-arrow-right text-sm ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-lg-0 mb-4">
                        <div class="card " style="opacity: 1 !important;">
                            <div class="step-number">3</div>
                            <div class="card-body p-4 pt-5">
                                <h5 class="font-weight-bolder">Confirmation instantanée</h5>
                                <p>Recevez une notification par email dès que votre demande est traitée et consultez son
                                    statut dans votre espace personnel.</p>
                                <a href="javascript:;" class="text-primary icon-move-right">
                                    En savoir plus
                                    <i class="fas fa-arrow-right text-sm ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section id="testimonials" class="py-5 mt-3">
            <div class="container">
                <div class="row justify-content-center mb-5">
                    <div class="col-lg-8 text-center">
                        <h2 class="text-gradient text-primary mb-0">Ce que disent nos utilisateurs</h2>
                        <h3 class="font-weight-bolder mb-3">Des expériences positives</h3>
                        <p class="lead">Découvrez comment notre plateforme a transformé la gestion des congés à
                            l'IBAM</p>
                    </div>
                </div>
                <div class="testimonial-slider">
                    <div class="card testimonial-card" style="min-width: 300px; width: 30%;">
                        <div class="card-body p-4">
                            <div class="d-flex mb-4">
                                <div class="avatar avatar-xl bg-gradient-primary border-radius-md p-2">
                                    <i class="fas fa-user-tie text-white"></i>
                                </div>
                                <div class="ms-3">
                                    <h5 class="font-weight-bolder mb-0">Mohamed Kader</h5>
                                    <p class="text-sm font-weight-bold text-primary">Responsable de service, IBAM</p>
                                </div>
                            </div>
                            <p class="mb-0">"Ce système a considérablement réduit le temps de traitement des demandes
                                de congé dans notre service. Tout est plus fluide et transparent."</p>
                        </div>
                    </div>
                    <div class="card testimonial-card" style="min-width: 300px; width: 30%;">
                        <div class="card-body p-4">
                            <div class="d-flex mb-4">
                                <div class="avatar avatar-xl bg-gradient-primary border-radius-md p-2">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                                <div class="ms-3">
                                    <h5 class="font-weight-bolder mb-0">Fatima Ndiaye</h5>
                                    <p class="text-sm font-weight-bold text-primary">Employée administrative, IBAM</p>
                                </div>
                            </div>
                            <p class="mb-0">"Fini les formulaires papier et les délais interminables ! Je peux
                                désormais planifier mes congés en toute simplicité et suivre leur validation en temps
                                réel."</p>
                        </div>
                    </div>
                    <div class="card testimonial-card" style="min-width: 300px; width: 30%;">
                        <div class="card-body p-4">
                            <div class="d-flex mb-4">
                                <div class="avatar avatar-xl bg-gradient-primary border-radius-md p-2">
                                    <i class="fas fa-user-tie text-white"></i>
                                </div>
                                <div class="ms-3">
                                    <h5 class="font-weight-bolder mb-0">Jean-Paul Ouattara</h5>
                                    <p class="text-sm font-weight-bold text-primary">Gestionnaire RH, IBAM</p>
                                </div>
                            </div>
                            <p class="mb-0">"En tant que responsable RH, cette plateforme m'a permis de gagner un
                                temps précieux dans la gestion des absences et de centraliser toutes les informations."
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-5 landing-cta">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto text-center">
                        <h2 class="text-white font-weight-bolder mb-2">Prêt à simplifier la gestion de vos congés ?
                        </h2>
                        <p class="text-white mb-4">
                            Rejoignez les nombreux employés de l'IBAM qui ont déjà adopté notre solution numérique pour
                            la gestion des congés et des absences.
                        </p>
                        <a href="/connexion" class="btn btn-white mb-0">
                            <i class="fas fa-sign-in-alt me-1"></i> Commencer maintenant
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="footer pt-5 pb-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 mb-4 mb-lg-0">
                        <h6 class="text-gradient text-primary font-weight-bolder">IBAM Congés</h6>
                        <p class="text-sm mb-0">
                            La solution digitale pour la gestion des congés et absences à l'Institut Bancaire Africain
                            et Malgache.
                        </p>
                    </div>
                    <div class="col-lg-3 col-6 mb-4 mb-lg-0">
                        <h6 class="text-gradient text-primary font-weight-bolder">Liens rapides</h6>
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-sm">Accueil</a></li>
                            <li><a href="#features" class="text-sm">Fonctionnalités</a></li>
                            <li><a href="#how-it-works" class="text-sm">Comment ça marche</a></li>
                            <li><a href="#testimonials" class="text-sm">Témoignages</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-6 mb-4 mb-lg-0">
                        <h6 class="text-gradient text-primary font-weight-bolder">Ressources</h6>
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-sm">Guide d'utilisation</a></li>
                            <li><a href="#" class="text-sm">FAQ</a></li>
                            <li><a href="#" class="text-sm">Support technique</a></li>
                            <li><a href="#" class="text-sm">Politique de confidentialité</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-12 mb-4 mb-lg-0">
                        <h6 class="text-gradient text-primary font-weight-bolder">Contact</h6>
                        <ul class="list-unstyled">
                            <li><a href="mailto:support@ibam.org" class="text-sm"><i
                                        class="fas fa-envelope me-2"></i>support@ibam.org</a></li>
                            <li><a href="tel:+22500000000" class="text-sm"><i class="fas fa-phone me-2"></i>+225 00
                                    00 00 00</a></li>
                            <li><span class="text-sm"><i class="fas fa-map-marker-alt me-2"></i>Siège IBAM,
                                    Abidjan</span></li>
                        </ul>
                    </div>
                </div>
                <hr class="horizontal dark mt-4 mb-3">
                <div class="row">
                    <div class="col-12 text-center">
                        <p class="text-sm mb-0">
                            &copy;
                            <script>
                                document.write(new Date().getFullYear())
                            </script> IBAM Congés. Tous droits réservés.
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </main>

    <!-- Core JS Files -->
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/plugins/chartjs.min.js') }}"></script>
    <script src="{{ asset('js/soft-ui-dashboard.min.js?v=1.1.0') }}"></script>
    <script>
        // Animation on scroll
        window.addEventListener('DOMContentLoaded', (event) => {
            const featureCards = document.querySelectorAll('.feature-card');
            const stepCards = document.querySelectorAll('.step-card');

            const animateOnScroll = (elements) => {
                elements.forEach((element, index) => {
                    setTimeout(() => {
                        element.classList.add('opacity-100');
                        element.style.transform = 'translateY(0)';
                    }, index * 100);
                });
            };

            // Initialize cards with opacity 0
            featureCards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'all 0.5s ease';
            });

            stepCards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'all 0.5s ease';
            });

            // Animate features on load
            setTimeout(() => {
                animateOnScroll(featureCards);
            }, 500);

            // Animate steps when scrolled into view
            window.addEventListener('scroll', () => {
                const stepsSection = document.getElementById('how-it-works');
                const rect = stepsSection.getBoundingClientRect();

                if (rect.top < window.innerHeight && rect.bottom >= 0) {
                    animateOnScroll(stepCards);
                    window.removeEventListener('scroll', this);
                }
            });
        });
    </script>
</body>

</html>
