<?php
// return array(

// 	'/' => 'users/index',
// 	'login' => 'users/login',
// 	'regiester' => 'users/regiester'

// 	);

Router::get(['/', 'users/index']);
Router::get(['login', 'users/login']);