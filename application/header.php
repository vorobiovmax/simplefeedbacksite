<?php
defined('ENTRY_POINT_USED') || die;
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="/styles/style.css" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="/includes/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="/includes/js/jquery.cookie-1.4.1.min.js"></script>
</head>
<body>
<div class="page_title">
    <h1><?= htmlspecialchars($pageTitle ?? null) ?></h1>
</div>
<div class="container">
