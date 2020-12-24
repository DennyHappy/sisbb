<?php
require_once 'config.php';

try {
    if ($adapter->isConnected()) {
        $adapter->disconnect();

        session_unset();
        session_destroy();

        header('location: index.php?status=successLogout');
        exit;
    }
}
catch( Exception $e ){
    echo $e->getMessage() ;
}

