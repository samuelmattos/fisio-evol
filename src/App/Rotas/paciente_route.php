<?php

$group->get('/paciente', '\App\Controllers\user\pacienteController:create');
$group->get('/pacientes', '\App\Controllers\user\pacienteController:index');
$group->post('/pacientes/cadastro', '\App\Controllers\user\pacienteController:store');
$group->get('/pacientes/edit/{id}', '\App\Controllers\user\pacienteController:edit');
$group->post('/pacientes/edit/editar/{id}', '\App\Controllers\user\pacienteController:update');
