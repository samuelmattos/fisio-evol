<?php
 $app->get('/evolucao/cadastrar/{id_paciente}/{id}', '\App\Controllers\user\evolucaoController:create');
 $app->post('/evolucao/salvar', '\App\Controllers\user\evolucaoController:store');
 $app->get('/evolucao/{id}', '\App\Controllers\user\evolucaoController:index');
 $app->get('/evolucao/edit/{id}', '\App\Controllers\user\evolucaoController:edit');
 $app->post('/evolucao/update/{id}', '\App\Controllers\user\evolucaoController:update');    
 $app->get('/evolucao/remove/{id}/{id_paciente}', '\App\Controllers\user\evolucaoController:destroy'); 
 $app->get('/evolucao/relatorio/{id}', '\App\Controllers\user\evolucaoController:rel');    