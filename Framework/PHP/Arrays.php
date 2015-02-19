<?php
namespace Framework\PHP;
use Framework\PHP\Arrays\Dotted as ArrayDotted;

class Arrays {
	/**
	 * Returns a merged value of arrays
	 *
	 * @param  array  $parameter1
	 * @param  array  $parameter2
	 * @param  array  $others
	 * @return array
	 */
	public function merge()
	{
		return call_user_func_array('array_merge', func_get_args());
	}

	/**
	 * Creates a new instance of 'ArrayDotted'
	 *
	 * @param  array  $package
	 * @return array
	 */
	public function dotted($array)
	{
		return (new ArrayDotted($array));
	}
}