<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    navbar-scroll="true">
    <div class="container-fluid py-1 px-3">

        <nav aria-label="breadcrumb">
            <p class="ml-2 text-muted">Bienvenue, {{ auth()->user()->nom }} !</p>

            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">

                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Espace</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">@yield('role')</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">@yield('title')</h6>
        </nav>



        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center gap-3">
                <!-- Barre de recherche (à ajouter si besoin) -->

                <div id="real-time-clock"
                    class="real-time-clock d-lg-flex align-items-center gap-2 p-2 bg-light rounded shadow-sm d-none">
                    <span class="fw-bold text-primary">
                        <i class="fas fa-clock"></i> <span id="time"></span>
                    </span>
                    <span class="fw-bold text-secondary">
                        <i class="fas fa-calendar"></i> <span id="date"></span>
                    </span>
                </div>

            </div>


        </div>
    </div>
</nav>


<script>
    function updateClock() {
        const now = new Date();
        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const seconds = now.getSeconds().toString().padStart(2, '0');

        document.getElementById('time').textContent = `${hours}h : ${minutes} : ${seconds}`;
        document.getElementById('date').textContent = now.toLocaleDateString();

        setTimeout(updateClock, 1000);
    }

    updateClock();
</script>
