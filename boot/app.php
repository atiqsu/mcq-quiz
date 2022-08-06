<?php

return function($file) {

	$app = new \Mcq_Quiz\System\Application($file);

	register_activation_hook($file, function() use ($app) {
		($app->resolve(\Mcq_Quiz\Handlers\Activation::class))->handle();
	});

	register_deactivation_hook($file, function() use ($app) {
		($app->resolve(\Mcq_Quiz\Handlers\Deactivation::class))->handle();
	});

	/**
	 * Initiate the plugin main features....
	 *
	 */
	(new \Mcq_Quiz\Plugin($app));
};
