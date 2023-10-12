<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Electronic Shop</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="<?= base_url('css/app.css') ?>" rel="stylesheet">
</head>
<body>
    <?php $session = session('user_data'); ?>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="<?= route_to('/') ?>">
                    Electronic Shop
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->

                    <?php
                        helper('common');
                        $menus = getMenu();
                    ?>

                    <?php if (isset($session['logged_in']) && $session['logged_in'] == TRUE) { ?>
                        <ul class="navbar-nav mr-auto">
                            <?php foreach ($menus as $m) { ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url('u/'.$m->uri_path) ?>"><?= $m->name; ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        
                        <?php if (isset($session['logged_in']) && $session['logged_in'] == TRUE) { ?>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <?php echo ucfirst($session['name']); ?> <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="<?= base_url('u/profile') ?>">
                                        Profile
                                    </a>
                                    <a class="dropdown-item" href="<?= base_url('u/reset') ?>">
                                        Change Password
                                    </a>
                                    <a class="dropdown-item" href="<?= base_url('logout') ?>">
                                        Logout
                                    </a>
                                </div>
                            </li>
                        <?php } else { ?> 
                            <li class="nav-item">
                                <a class="nav-link" href="<?= route_to('login') ?>">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= route_to('register') ?>">Register</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <?= $this->renderSection('content') ?>
        </main>
    </div>

    <!-- JQuery core JS-->
    <script src="<?= base_url('js/jquery-3.6.0.js') ?>"></script>

    <!-- Axios core JS-->
    <script src="<?= base_url('js/axios.min.js') ?>"></script>

    <script src="<?= base_url('js/bootstrap.bundle.js') ?>"></script>
    <!-- App JS-->
    <script src="<?= base_url('js/app.js') ?>"></script>

    <?= $this->renderSection('footer') ?>
</body>
</html>
