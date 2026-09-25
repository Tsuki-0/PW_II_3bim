<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>CRUD com Bootstrap</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <link rel="stylesheet" href="<?php echo BASEURL; ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo BASEURL; ?>css/style.css">
    <link rel="stylesheet" href="<?php echo BASEURL; ?>css/all.min.css">

    <style>
        body {
            padding-top: 50px;
            padding-bottom: 20px;
        }

        main {
            margin-top: 1.5rem;
            
        }

        .nav {
            background-color: var(--white);
            border-bottom: 1px solid var(--border);
        }

        .navbar.fixed-top {
            background: var(--white);
        }

        .topbar {
            background: var(--white);
            border-bottom: 1px solid var(--border);
            padding: 0 2rem;
            display: flex;
            align-items: center;
            gap: 0rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .06);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: .6rem;
            font-weight: 700;
            font-size: 1.20rem;
            color: var(--teal);
        }

        .navbar-brand:hover,
        .navbar-brand:focus {
            color: var(--teal);
        }

        .navbar-brand-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            border-radius: 8px;
            background: var(--teal);
            color: var(--white);
            font-size: 1rem;
            flex-shrink: 0;
        }

        .topbar-end {
            display: flex;
            align-items: center;
            gap: 1.25rem;
        }

        .clientes-toggle {
            display: flex;
            align-items: center;
            gap: .5rem;
            padding: .5rem 0;
            color: var(--muted);
            font-weight: 600;
            transition: color .1s ease;
        }

        .clientes-toggle:hover,
        .clientes-toggle:focus,
        .clientes-toggle.show {
            color: var(--teal);
        }

        .clientes-toggle::after {
            margin-left: .2rem;
        }

        .dropdown-menu {
            border: 1px solid var(--border);
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, .08);
            padding: .4rem;
            margin-top: .5rem;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: .6rem;
            border-radius: 6px;
            padding: .55rem .75rem;
            color: var(--muted);
            font-size: .95rem;
        }

        .dropdown-item i {
            color: var(--teal);
            width: 1.1rem;
            text-align: center;
        }

        .dropdown-item:hover,
        .dropdown-item:focus {
            background-color: var(--teal-dim);
            color: var(--teal);
        }

        .dropdown-item:active {
            background-color: var(--teal);
            color: var(--white);
        }

        .dropdown-item:active i {
            color: var(--white);
        }

        @media (max-width: 991.98px) {
            .topbar {
                padding: 0 1rem;
            }

            .navbar-brand {
                font-size: 1.05rem;
                gap: .4rem;
            }

            .navbar-brand-icon {
                width: 28px;
                height: 28px;
                font-size: .85rem;
            }

            .topbar-end {
                gap: .75rem;
            }
        }

        @media (max-width: 575.98px) {
            .topbar {
                padding: 0 .75rem;
            }

            .navbar-brand {
                font-size: .95rem;
            }

            .navbar-brand-icon {
                width: 26px;
                height: 26px;
                font-size: .75rem;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top mb-3" data-bs-theme="white">
        <div class="container-fluid topbar">
            <a class="navbar-brand" href="<?php echo BASEURL; ?>index.php">
                <span class="navbar-brand-icon"><i class="fa-solid fa-user"></i></span>
                Gestão de Enfermagem
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCrud"
                aria-controls="navbarCrud" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse topbar-end" id="navbarCrud">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle clientes-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa-solid fa-user-group"></i> Enfermeiros
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo BASEURL; ?>customers"><i
                                        class="fa-solid fa-user-group"></i> Gerenciar Enfermeiros</a>
                            </li>
                            <li><a class="dropdown-item" href="<?php echo BASEURL; ?>customers/add.php"><i
                                        class="fa-solid fa-user-plus"></i> Novo Enfermeiro</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container">