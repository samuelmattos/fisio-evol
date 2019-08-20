<?php
 $group->get('/evolucao/cadastrar/{id_paciente}/{id}', '\App\Controllers\user\evolucaoController:create');
 $group->post('/evolucao/salvar', '\App\Controllers\user\evolucaoController:store');
 $group->get('/evolucao/{id}', '\App\Controllers\user\evolucaoController:index');
 $group->get('/evolucao/viewEdit/{id}/{index}', '\App\Controllers\user\evolucaoController:edit');
 $group->post('/evolucao/update/{id}', '\App\Controllers\user\evolucaoController:update');    
 $group->get('/evolucao/remove/{id}/{id_paciente}', '\App\Controllers\user\evolucaoController:destroy'); 
 $group->get('/evolucao/relatorio/{id}', '\App\Controllers\user\evolucaoController:rel');    