<?php

	//admin routes
	Router::connect('/admin/login', array('controller' => 'users', 'action' => 'login', 'admin' => true));
	Router::connect('/admin/logout', array('controller' => 'users', 'action' => 'logout', 'admin' => true));

	Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
	Router::connect('/login', array('controller' => 'users', 'action' => 'login'));
	Router::connect('/logout', array('controller' => 'users', 'action' => 'logout'));
	Router::connect('/recordings/save', array('controller' => 'recordings', 'action' => 'save'));
	
	Router::connect('/dashboard', array('controller' => 'users', 'action' => 'login'));	
	
	
/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
