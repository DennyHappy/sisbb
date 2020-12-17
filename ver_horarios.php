<?php

require __DIR__.'/vendor/autoload.php';

use \App\Entity\Agenda;

session_start();

$agendas = Agenda::getAgendas();

include __DIR__.'/includes/header1.php';
include __DIR__.'/includes/info_user.php';
include __DIR__.'/includes/listagem_horarios.php';
include __DIR__.'/includes/footer.php';

