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
		$request = array();
		$request = $this->request;
		ksort($request);

		return sha1(json_encode($request));
	}
	
	public function setHeader($responseCode)
	{
		header('Content-type: application/json');
		if($responseCode == 200) {
			header("HTTP/1.1 200 OK");
		}
		elseif($responseCode == 401) {
			header("HTTP/1.1 401 Unauthorized");
		}
	}
}
