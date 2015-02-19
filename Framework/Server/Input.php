<?php
namespace Framework\Server;
use Framework\PHP\Arrays as Arrays;
use Framework\Helpers\Package_Manager as Package_Manager;

class Input extends Package_Manager {
	/**
	 * Sends a package to the upper class
	 *
	 * @return array
	 */
	protected function package()
	{
		return Arrays::merge($_GET, $_POST);
	}
}