<?php

/**
 * Session Class.
 * Model for the Session Resource
 *
 * @author McFarlane.a
 */
class Session {
	/**
	 * The signature for the session.
	 * @access protected
	 * @var string
	 */
	protected $signature;
	
	/**
	 * The public key for the session.
	 * @access protected
	 * @var string
	 */
	protected $publicKey;
	
	/**
	 * holds true if session user is an admin
	 * @access protected
	 * @var boolean
	 */
	protected $isAdmin;
	
	/**
	 * Holds the error string for the session object.
	 * @var array 
	 */
	public $errors = array();
	
	/**
	 * 
	 */
	
	/**
	 * Constructor sets up {@link $username} and {@link $password}
	 * @param string $username
	 * @param string $password
	 */
	public function __construct($publicKey, $signature, $request)
	{
		$this->publicKey = $publicKey;
		$this->signature = $signature;
		$this->request = $request;
		$this->isAdmin = $this->isAdmin();
	}
	
	public function verifySignature()
	{
		$sig = $this->createSignature();
		if($sig != $this->signature) {
			return false;
		}
		else{
			return true;
		}
	}
	
	private function createSignature()
	{
		$privateKey = sha1($this->publicKey);
		$requestString = $this->getRequestString();
		return base64_encode(hash_hmac("sha256", $requestString, $privateKey, true));
	}
	
	private function getRequestString()
	{
		if(empty($this->request)) {
			$request = json_decode("{}");
		}
		else{
			$request = array();
			$request = $this->request;
			ksort($request);
		}
		$val = json_encode($request); 
		return sha1(json_encode($request));
	}
	
	public function setHeader($responseCode)
	{
		header('Content-type: application/json');
		if($responseCode == 200) {
			header("HTTP/1.1 200 OK");
		}
		elseif($responseCode == 201){
			header("HTTP/1.1 201 Created");
		}
		elseif($responseCode == 401) {
			header("HTTP/1.1 401 Unauthorized");
		}
		elseif($responseCode == 500){
			
		}
		elseif($responseCode == 400){
			header("HTTP/1.1 400 Bad Request");
		}
	}
	
	public function isAdmin()
	{
		if(elgg_is_admin_user($this->publicKey)) {
			return true;
		}
		else{
			return false;
		}
	}
	
	public function getPublicKey()
	{
		return $this->publicKey;
	}
	
	public function getIsAdmin()
	{
		return $this->isAdmin;
	}
}
