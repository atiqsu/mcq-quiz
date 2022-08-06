<?php

namespace Mcq_Quiz\Handlers;

class Deactivation {

	public function handle() {
		flush_rewrite_rules();
	}
}
