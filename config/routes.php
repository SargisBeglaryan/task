<?php

Router::get(['/', 'users/index/$1']);
Router::get(['login', 'users/showLogin']);
Router::post(['login', 'users/login']);
Router::get(['register', 'users/showRegister']);
Router::post(['register', 'users/register']);
Router::get(['logout', 'users/logout']);