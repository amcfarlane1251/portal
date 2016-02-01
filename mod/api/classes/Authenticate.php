<?php


/**
 * Authenticate Class
 *
 * @author McFarlane.a
 */
class Authenticate {
	/**
	 * The username for the auth request.
	 * @access protected
	 * @var string
	 */
	protected $username;
	/**
	 * The password for the auth request.
	 * @access protected
	 * @var string
	 */
	protected $password;
	
	public $publicKey;
	
	public $privateKey;
	
	/**
	 * Holds the error string for the authentication object.
	 * @var array 
	 */
	public $errors = array();
	
	public function __construct($username, $password)
	{
		$this->username = $username;
		$this->password = $password;
	}
	
	public function validate()
	{
		if( !isset($this->username) || empty($this->username) ) {
			$this->errors['username'] = 'Username is required';
		}
		if( !isset($this->password) || empty($this->password) ) {
			$this->errors['password'] = 'Password is required';
		}
		
		if(empty($this->errors)) {
			return true;
		}
		else{
			return false;
		}
	}
	
	public function login()
	{
		$result = elgg_authenticate($this->username, $this->password);
		if($result === true) {
			return true;
		}
		else{
			$this->errors['authenticate'] = $result;
			return false;
		}
	}
	
	public function getResponseInfo()
	{
		$user = $this->getUser();

		return array('publicKey' => $user->guid, 'privateKey' => sha1($user->guid));
	}
	
	private function getUser()
	{
		return get_user_by_username($this->getUsername());
		
	}
	
	private function getUsername()
	{
		return $this->username;
	}
	
	public function setHeader($responseCode)
	{
		header('Content-type: application/json');
		if($responseCode == 200) {
			header("HTTP/1.1 200 OK");
		}
	}
}
