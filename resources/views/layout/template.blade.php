<!doctype html>
<html lang="en">
    <head>
        <title>Restoran</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="{{ asset('build/assets/app-D-sv12UV.css') }}"
            rel="stylesheet"
        />
    </head>

    <body>
        <div class="container">
            <nav
                class="navbar navbar-expand-xxl navbar-light bg-light"
            >
                <div class="container">
                    <a class="navbar-brand" href="#"><strong>Restoran</strong></a>
                    <button
                        class="navbar-toggler d-lg-none"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapsibleNavId"
                        aria-controls="collapsibleNavId"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                    >
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="collapsibleNavId">
                        <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="/index">Pesan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/pesanan">Pesanan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/produk">Produk</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/pelanggan">Pelangan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/meja">Meja</a>
                            </li>
                        </ul>
                        <div class="d-flex justify-content-center align-items-center gap-4">
                        <h5><strong>Haloo {{ session()->get('nama') }}</strong></h2>
                        <h5>
                            <a
                            name="logout"
                            id="logout"
                            class="btn btn-warning"
                            href="/logout"
                            role="button"
                            >Keluar                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M16 13v-2H7V8l-5 4 5 4v-3z"></path><path d="M20 3h-9c-1.103 0-2 .897-2 2v4h2V5h9v14h-9v-4H9v4c0 1.103.897 2 2 2h9c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2z"></path></svg>
                            </a
                        >
                        </div>

                    </div>
                </div>
            </nav>

            @yield('template')
        </div>
    </body>
    </html>
    <script src="{{ asset('build/assets/app-BziwsqBe.js') }}"></script>
