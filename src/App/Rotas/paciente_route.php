<?php

$app->get('/paciente', '\App\Controllers\user\pacienteController:create');
$app->get('/pacientes', '\App\Controllers\user\pacienteController:index');
$app->post('/pacientes/cadastro', '\App\Controllers\user\pacienteController:store');
$app->get('/pacientes/edit/{id}', '\App\Controllers\user\pacienteController:edit');
$app->post('/pacientes/edit/editar/{id}', '\App\Controllers\user\pacienteController:update');
