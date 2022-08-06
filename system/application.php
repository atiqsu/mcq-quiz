<?php

namespace Mcq_Quiz\System;


class Application {

	protected Container $container;
	protected string $origin;

	public function __construct( $file ) {
		$this->origin    = $file;
		$this->container = new Container();
	}

	public function resolve( string $name, $object = null ) {
		if ( ! $this->container->has( $name ) ) {
			$this->container->register( $name, $object );
		}

		return $this->container->get( $name );
	}

	public function getContainer(): Container {
		return $this->container;
	}

	public function get( $key ) {
		return $this->container->get( $key );
	}

	public function setOrigin( $file ) {
		$this->origin = $file;
	}

	public function plugin_dir() {
		return trailingslashit( plugin_dir_path( $this->origin ) );
	}

	public function plugin_url() {
		return trailingslashit( plugin_dir_url( $this->origin ) );
	}

	public function assets_dir() {
		return trailingslashit( self::plugin_dir() . 'assets' );
	}

	public function assets_url() {
		return trailingslashit( self::plugin_url() . 'assets' );
	}
}

