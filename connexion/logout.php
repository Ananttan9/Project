<?php

require("../auth/EtreAuthentifie.php");

session_destroy();
$auth->clear();
$idm->clear();
redirect($pathFor['root']);