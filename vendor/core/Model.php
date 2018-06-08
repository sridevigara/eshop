<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ES_Model {

	/**
	 * Constructor
	 *
	 * @access public
	 */
	function __construct()
	{
	}

	/**
	 * __get
	 *
	 * Allows models to access ES's loaded classes using the same
	 * syntax as controllers.
	 *
	 * @param	string
	 * @access private
	 */
	function __get($key)
	{
		$ES =& get_instance();
		return $ES->$key;
	}
}
// END Model Class

/* End of file Model.php */
/* Location: ./vendor/core/Model.php */