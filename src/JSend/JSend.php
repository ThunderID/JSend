<?php namespace ThunderID\JSend;

class JSend {
	
	protected $results;

	function __construct($status, $data) 
	{
		// validate status
		switch (strtolower($status))
		{
			case 'success': case 'error': case 'fail':
				$status = strtolower($status);
				break;
			default:
				throw new Exception("Invalid JSend Status (success or error or fail expected, ".$status." found)", 1);
		}

		// create results
		$this->results['status'] = $status;
		switch ($status)
		{
			case 'success': case 'fail':
				$this->results['data'] = $data;
				break;
			case 'error':
				$this->results['message'] = $data;
				break;
		}
	}

	function __toString()
	{
		return json_encode($this->results);
	}

	function toJson()
	{
		return json_encode($this->results);
	}
}