<?php

require __DIR__.'/vendor/autoload.php';

use \App\Entity\Agenda;

$agendas = Agenda::getAgendas();

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/listagem_agenda.php';
include __DIR__.'/includes/footer.php';

