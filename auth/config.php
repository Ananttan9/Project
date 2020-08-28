<?php

$authTableData = [
    'table' => 'users',
    'idfield' => 'login',
    'cfield' => 'mdp',
    'uidfield' => 'userid',
    'rfield' => 'role',
];

$pathFor = [
    "login"  => "/projet_web/connexion/login.php",
    "logout" => "/projet_web/connexion/logout.php",
    "adduser" => "/projet_web/admin/ajout/adduser.php",
	"admin" => "/projet_web/admin/admin.php",
	"user" => "/projet_web/user/user.php",
    "root"   => "/projet_web/",
	"style"   => "/projet_web/style.css",
	"favicon" => "/projet_web/image/favicon.ico",
];

const SKEY = '_Redirect';