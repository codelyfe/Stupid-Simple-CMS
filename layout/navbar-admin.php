<?php
include "settings/global.php";
include "text-content/{$selectlang}.php";
require_once __DIR__ . '/../includes/store.php';
$site = site_settings();
$siteTitle = $site['title'];
$siteCopyright = $site['copyright'];
$websiteUrl = $site['websiteurl'];
$currentYear = date('Y');
require __DIR__ . '/admin-nav.php';
