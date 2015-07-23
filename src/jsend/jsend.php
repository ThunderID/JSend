<?php namespace ThunderID\jsend;

class jsend {
	
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

	function toArray()
	{
		return $this->results;
	}

	function __get($field)
	{
		switch (strtolower($field)) {
			case 'status':
				return $this->results['status'];
				break;
			
			case 'data':
				return $this->results['data'];
				break;

			case 'message':
				return $this->results['message'];
				break;

			default:
				return $this->results;
				break;
		}
	}
}