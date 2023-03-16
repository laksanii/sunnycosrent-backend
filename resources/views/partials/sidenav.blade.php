<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <a class="nav-link" href="/">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>

            <div class="sb-sidenav-menu-heading">Kostum</div>

            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#kostum"
                aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Daftar Kostum
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="kostum" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="/costumes">Semua Kostum</a>
                    <a class="nav-link" href="/costumes-available">Available</a>
                    <a class="nav-link" href="/costumes-booked">Booked</a>
                </nav>
            </div>

            <div class="sb-sidenav-menu-heading">Rental</div>

            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Daftar Rental
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="/rental">Semua Rental</a>
                    <a class="nav-link" href="/rental-sudah-dikirim">Sudah Dikirim</a>
                    <a class="nav-link" href="/rental-belum-dikirim">Belum Dikirim</a>
                    <a class="nav-link" href="/rental-sudah-lunas">Sudah Lunas</a>
                    <a class="nav-link" href="/rental-belum-lunas">Belum Lunas</a>
                </nav>
            </div>

            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pengembalian"
                aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Pengembalian
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="pengembalian" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="/pengembalian-sudah-dikirim">Sudah Dikirim</a>
                    <a class="nav-link" href="/pengembalian-belum-dikirim">Belum Dikirim</a>
                    <a class="nav-link" href="/pengembalian-terlambat">Terlambat</a>
                </nav>
            </div>
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        Start Bootstrap
    </div>
</nav>
