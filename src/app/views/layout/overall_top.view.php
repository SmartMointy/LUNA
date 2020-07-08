<!DOCTYPE HTML>
<html lang="<?= Config::get('app/language') ?>">
    <head itemscope itemtype="http://schema.org/WebSite">
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <title itemprop="name" lang="de"><?= Config::get('page/title'); ?></title>
        <meta itemprop="description" lang="de" name="description" content="<?= Config::get('page/description'); ?>">
        <meta itemprop="keywords" lang="de" name="keywords" content="<?= Config::get('page/keywords'); ?>"> 
        <meta itemprop="image" content="<?php // echo $Image;?>" />	
        <meta itemprop="author" name="author" content="<?= Config::get('page/author') ?>">
        <meta name="application-name" content="<?= Config::get('app/name') ?>">
        <meta name="theme-color" content="<?= Config::get('app/theme_color') ?>">
    <?php
        foreach (Config::get('page/custom_head_elements') as $element) {
            echo '<' . $element[0] . ' ' . $element[1] . '="' . $element[2] . '" ' . $element[3] . '="' . $element[4] . '">
            ';
        }
    ?>
    <!---- STYLES ---->
    <?php
        for ($i = 0; $i < count(Config::get('page/css')); $i++) {
            echo '<link rel="stylesheet" type="text/css" href="assets/css/' . Config::get('page/css')[$i] . '.css">
            ';
        }
    ?>
    <!---- VERIFICATIONS ---->
    <?php
        foreach (Config::get('app/verification_tokens') as $searchEngine => $verification_token) {
            echo '<meta name=' . $searchEngine . ' content="' . $verification_token . '" />
            ';
        }
    ?>
    <!---- ICONS ---->
        <link href="favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
    <?php
        if (!empty(Config::get('app/icons/default'))) {
            echo '<link rel="icon" sizes="192x192" href="' . Config::get('app/icons/default') . '">
            <link rel="apple-touch-icon" href="' . Config::get('app/icons/default') . '">
            ';
        }

        if (!empty(Config::get('app/icons/safari'))) {
            echo '<link rel="mask-icon" href="' . Config::get('app/icons/safari') . '" color="' . Config::get('app/theme_color') . '">
            ';
        }
    ?>
    <!---- SCRIPTS ---->
    <?php
        for ($i = 0; $i < count(Config::get('page/js')); $i++) {
            echo '<script defer src="assets/js/' . Config::get('page/js')[$i] . '.js" type="text/javascript"></script>
            ';
        }
    ?>
    </head>
    <body>
