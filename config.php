<?php
session_start([
    'cookie_lifetime' => 0, // La sesión expirará cuando se cierre el navegador
    'gc_maxlifetime' => 0, // La sesión expirará cuando se cierre el navegador
]);
?>