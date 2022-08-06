<?php

namespace Mcq_Quiz\System;


class Container implements Container_Interface {

	protected array $instance = [];

	public function has( string $id ): bool {

		return isset( $this->instance[ $id ] );
	}


	/**
	 * get is responsible for doing some .
	 *
	 * @param string $id
	 *
	 * @return mixed
	 * @throws \Exception
	 */
	public function get( string $id ): mixed {

		if ( isset( $this->instance[ $id ] ) ) {
			return $this->instance[ $id ];
		}

		throw new \Exception( sprintf( "Resource '%s' has not been registered with the container.", $id ) );
	}

	public function register( string $name, $val = null ) {
		if ( ! $this->has( $name ) ) {
			$val = is_null( $val ) ? $name : $val;
			$this->set( $name, $val );
		}
	}

	public function set( string $id, $val) {

		if ( isset( $this->registry[ $id ] ) ) {
			throw new \Exception( 'Duplicate key. A service is already registered with the given key.' );
		}

		if ( $val instanceof \Closure ) {
			throw new \Exception( 'For the time being we are not allowing closure.' );
		}

		$primitive = [
			'integer',
			'double',
			'NULL',
			'null',
			'object',
		];

		$typ = gettype( $val );

		if ( in_array( $typ, $primitive ) ) {
			$this->instance[ $id ] = $val;

			return true;
		}

		if ( class_exists( $val ) ) {
			$this->buildObject($id, $val);

			return true;
		}

		/**
		 * lets hope the value is simple string...though thats not may be the case..
		 *
		 */

		$this->instance[ $id ] = $val;

		return true;
	}

	private function buildObject(string $key, $className) {

		try {
			$reflection = new \ReflectionClass($className);

		} catch(\ReflectionException $ex) {
			throw new \Exception(
				sprintf('From reflection: cannot autowire due to "%s".', $ex->getMessage())
			);
		}

		$constructor = $reflection->getConstructor();

		if(is_null($constructor)) {
			// There is no constructor, just return a new object.
			$this->instance[$key] = new $className();

			return;
		}

		$params = $constructor->getParameters();

		if(count($params) < 1) {
			$this->instance[$key] = new $className;

			return;
		}

		throw new \Exception(
			sprintf('For the time being we are only allowing constructor with zero dependency, found : %d ".', count($params))
		);

		//foreach ($constructor->getParameters() as $param){}
	}
}

