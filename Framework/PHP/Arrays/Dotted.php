<?php
namespace Framework\PHP\Arrays;

class Dotted {
	/**
	 * Main array
	 *
	 * @var $array 
	 */
	protected $array = [];

	/**
	 * Returns the current instance
	 *
	 * @param  array  $array
	 * @return Framework\PHP\Arrays\Dotted
	 */
	public function __construct(array $array)
	{
		$this->array = $this->transform($array);

		return $this;
	}

	/**
	 * Re-shapes the array, and fixes the keys like ['framework.id' => ['arr1']]
	 * turning into ['framework' => ['id' => ['arr1']]]
	 *
	 * @param  array  $array
	 * @return array
	 */
	public function transform($array)
	{
		$result = (array) $array;

		foreach( $result as $key => $value )
		{
			// if key has a "dot"
			$parts = explode('.', $key);

			if( count($parts) > 1 ) {
				$inside_eval = '';
				foreach( $parts as $part_id => $part )
				{
					$inside_eval .= '[$parts['.$part_id.']]';
				}
				eval('$result'.$inside_eval.' = $value;');
				// unset the current
				unset($result[$key]);
			}
		}
		return $result;
	}

	/* --------------------------------------------------------------
	 * 	Get an index
	 * -------------------------------------------------------------- */
	public function get($path = FALSE)
	{
		$data = $this->array;
		$keys = explode('.', $path);
		foreach($keys as $key){
			if( isset($data[$key]) )
			{
				$data =& $data[$key];
			} else
			{
				return FALSE;
			}
		}
		return $data;
	}

	/* --------------------------------------------------------------
	 * 	get_dotted
	 * -------------------------------------------------------------- */
	public function get_dotted($including_parents = false, $keys_prefix = '', $subval = FALSE)
	{
		$result = [];
		$input = (!is_array($subval) || count($subval) <= 0) ? $this->array : $subval;

		foreach( $input as $key => $value )
		{
			if( is_array($value) ) {
				$result += $this->get_dotted($including_parents, $keys_prefix . $key . '.', $value);
			}

			if( $including_parents === TRUE || !is_array($value) ) {
				$result[$keys_prefix . $key] = $value;	
			}
		}

		return $result;
	}

	/* --------------------------------------------------------------
	 * 	Has an index?
	 * -------------------------------------------------------------- */
	public function has($path = FALSE)
	{
		$data = $this->array;
		$keys = explode('.', $path);
		foreach($keys as $key){
			if( isset($data[$key]) )
			{
				$data =& $data[$key];
			} else
			{
				return FALSE;
			}
		}
		return TRUE;
	}

	/* --------------------------------------------------------------
	 * 	Set an index
	 * -------------------------------------------------------------- */
	public function set($path, $value)
	{
		$data = $this->array;
		$keys = explode('.', $path);
		$last = array_pop($keys);
		foreach($keys as $key){
			if(isset($data[$key]) && is_array($data[$key]))
			{
				$data =& $data[$key];
			} else
			{
				$data[$key] = array();
				$data =& $data[$key];
			}
		}
		$data[$last] = $value;

		$this->array = $data;

		return $this;
	}

	/* --------------------------------------------------------------
	 * 	Delete an index
	 * -------------------------------------------------------------- */
	public function delete($path)
	{
		$data = $this->array;
		$keys = explode('.', $path);
		$last = array_pop($keys);
		foreach($keys as $k){
			if( isset($data[$k]) && is_array($data[$k]) )
			{
				$data =& $data[$k];
			} else {
				return FALSE;
			}
		}
		unset($data[$last]);

		$this->array = $data;

		return $data;
	}
}