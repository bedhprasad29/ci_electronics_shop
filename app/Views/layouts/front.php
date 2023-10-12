<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{ csrf_token() }">

        <title>Test</title>
        
        <link rel="icon" type="image/x-icon" href="favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="<?= base_url('css/styles.css') ?>" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <?= $this->include('layouts/front/nav') ?>
        
        <!-- Page Header-->
        <?= $this->renderSection('header') ?>
        
        <!-- Main Content-->
        <?= $this->renderSection('content') ?>
        
        <!-- Footer-->
        <?= $this->include('layouts/front/footer') ?>
        
        <!-- JQuery core JS-->
        <script src="<?= base_url('js/jquery-3.6.0.js') ?>"></script>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="<?= base_url('js/scripts.js') ?>"></script>
    </body>
</html>
