<?php

namespace Mcq_Quiz\System;

interface Container_Interface {
	public function get( string $id );

	public function has( string $id ): bool;
}


