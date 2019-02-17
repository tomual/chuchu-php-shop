<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo get_title() ? get_title() . ' | ' : '' ?>Site Title</title>
    <meta name="description" content="">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimal-ui">
    <meta http-equiv="cleartype" content="on">

    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/touch/apple-touch-icon-144x144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/touch/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/touch/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="img/touch/apple-touch-icon-57x57-precomposed.png">
    <link rel="shortcut icon" sizes="196x196" href="img/touch/touch-icon-196x196.png">
    <link rel="shortcut icon" href="img/touch/apple-touch-icon.png">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="img/touch/apple-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#222222">

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('css/normalize.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('css/main.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('css/style.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('css/jam.min.css') ?>" rel="stylesheet">
</head>
<body>
    <header class="container my-5">
        <div class="row">
            <div class="col">
                <div class="site-title float-left"><a href="<?php echo base_url() ?>">chuchu</a></div>
                <div class="float-right header-nav">
                    <?php if ($this->user): ?>
                        <a class="p-2 small" href="<?php echo base_url('settings/edit') ?>"><?php echo $this->user->username ?></a>
                        <a class="p-2 small" href="<?php echo base_url('user/logout') ?>">Log Out</a>
                    <?php else: ?>
                        <a class="p-2 small" href="<?php echo base_url('user/login') ?>">Log In</a>
                        <a class="p-2 small" href="<?php echo base_url('user/signup') ?>">Sign Up</a>
                    <?php endif ?>
                    <a class="p-2 jam jam-shopping-cart" href="<?php echo base_url('cart') ?>"></a>
                </div>
            </div>
        </div>
    </header>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container">
            <div class="row">
                <div class="col">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbar">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="<?php echo base_url('shop') ?>">Browse <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('page') ?>">Clothing</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('page') ?>">Accessories</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <main role="main" class="container">
