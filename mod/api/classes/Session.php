<?php

/**
 * Session Class.
 * Model for the Session Resource
 *
 * @author McFarlane.a
 */
class Session {
	/**
	 * The username for the session.
	 * @access protected
	 * @var string
	 */
	protected $username;
	/**
	 * The password for the session.
	 * @access protected
	 * @var string
	 */
	protected $password;
	/**
	 * Holds the error string for the session object.
	 * @var array 
	 */
	public $errors = array();
	
	/**
	 * Constructor sets up {@link $username} and {@link $password}
	 * @param string $username
	 * @param string $password
	 */
	public function __construct($username, $password)
	{
		$this->username = $username;
		$this->password = $password;

	}
	
	/**
	 * Returns true if no validation errors.
	 * @return boolean
	 */
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
	
	/**
	 * Returns true if users credentials are valid.
	 * @return boolean
	 */
	public function authenticate()
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
	
	public function getUsername()
	{
		return $this->username;
	}
}
