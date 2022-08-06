<?php

namespace Mcq_Quiz;

class Helper {

	public static function shuffleOptions( &$array ): bool {
		$keys = array_keys( $array );

		shuffle( $keys );

		foreach ( $keys as $key ) {
			$new[ $key ] = $array[ $key ];
		}

		$array = $new;

		return true;
	}
}
