<?php
namespace Framework\Helpers;
use Framework\PHP\Arrays as Arrays;

class Package_Manager {
	/**
	 * Returns all of the package shaped by PHP\Arrays\Dotted
	 *
	 * @return array
	 */
	protected function package()
	{
		return Arrays::dotted((array) static::package());
	}

	/**
	 * Returns a value from the package
	 *
	 * @param  mixed  $element
	 * @return mixed
	 */
	public function get($element)
	{
		return self::package()->get($element);
	}
}