<?php
class UserManagement extends ElggObject
{
	protected $users = array();
	public $user;
	protected $siteDomain;
	protected $site;
	protected $approvedDomains = array();

	public function __construct()
	{
		$this->initializeAttributes();
	}

	public static function withID($userGuid)
	{

		$instance = new self();
		if($user = get_entity($userGuid))
		{
			$instance->setUser($user);
			return $instance;
		}
	}

	public static function withFilter($userGuid)
	{

		$instance = new self();
		if($user = get_entity($userGuid))
		{
			$instance->setUser($user);
			return $instance;
		}
	}

	protected function initializeAttributes()
	{
		parent::initializeAttributes();
		$this->siteDomain = get_site_domain($CONFIG->site_guid);
		$this->site = elgg_get_site_entity();
		$this->approvedDomains = ['forces.gc.ca', 'test.gc.ca'];
	}

	public function setUser($user)
	{
		$this->user = $user;
	}

	public function setEmail($email)
	{
		$this->user->email = $email;
	}

	public function getUsers($queryString = null)
	{
		if($queryString) {
			if($queryString == true){$queryString=1;}
			
			return elgg_get_entities_from_metadata(array(
				'type' => 'user',
				'limit' => false,
				'metadata_name_value_pairs' => array(
					'name' => 'deactivated',
					'value' => $queryString,
				)
			)
			);
		}
	}
	public function getInactiveUsers()
	{
		//current date converted to time for math comparison
		$currentDate = strtotime(date('Ymd'));
		//define range end point (60 days in the past)
		$sixtyDaysAgo = $currentDate - ((24*60*60)*60);
		$users = elgg_get_entities(array(
				'type' => 'user',
				'limit' => 0,
				'joins' => array("join elgg_users_entity u on e.guid = u.guid"),
				'wheres' => array("u.last_action < {$sixtyDaysAgo}")
		));

		$this->users = $users;
	}

	private function getUserByEmail($email)
	{
		$user =  elgg_get_entities_from_metadata(array(
			'type' => 'user',
			'metadata_name_value_pairs' => array(
				'name' => 'registeredEmail',
				'value' => $email,
			)
		));

		return $user[0];
	}

	public function deactivateUsers($users = null)
	{
		if(!$users){$users = $this->users;}

		foreach($users as $user)
		{
			$user->deactivated = true;
			$user->save();
		}
	}

	public function activateUser($user = null)
	{
		if(!$user){$user = $this->user;}

		$status = elgg_get_ignore_access();
		elgg_set_ignore_access();
		$user->deleteMetadata('deactivated');
		
		if($user->save())
		{
			elgg_set_ignore_access($status);
			return true;
		}
		else
		{
			elgg_set_ignore_access($status);
			return false;
		}
	}

	public function importUsers($csvFileName)
	{
		$csvFile = fopen($csvFileName, 'r');
		while($line = fgetcsv($csvFile)){
			//validation
			if(count($line) > 4){
				register_error('Too many fields in row');
				forward(REFERER);
			}
			elseif(count($line) < 4){
				register_error('Too few fields in row');
				forward(REFERER);
			}
			elseif(!strpos($line[1], "@"))
			{
				register_error('No email in second column');
				forward(REFERER);
			}
			//name,email,username,password for column headers
			$name = $line[0];
			$email = $line[1];
			$username = $line[2];
			$password = $line[3];
			register_user($username, $password, $name, $email, TRUE);
		}
		fclose($csvFile);
	}
	
	public function sendEmail($action, $email, $guid)
	{
		switch($action){
			case 'activate':
				$email = sanitise_string($email);
				$user = get_entity($guid);
				if(!$user)
				{
					register_error(elgg_echo('email:activate:userNotFound'));
					return false;
				}
				if(!$user->deactivated)
				{
					register_error(elgg_echo('email:activate:userActivated'));
					return false;
				}
				if(!$this->validateEmail($email))
				{
					register_error(elgg_echo('email:activate:invalidEmail'));
					return false;
				}
				//construct the email
				$from = "no-reply@lp-pa.forces.gc.ca";
				$to = $email;
				$subject = elgg_echo('activate:heading');
				$code = $this->generateCode($user->guid, $email, date('Ymd'));
				$link = "{$this->site->url}usermgmt/activation?u={$user->guid}&c=$code";
				$message = elgg_echo('email:activate:body', array($user->name, $link, $this->site->name, $this->$site->url));

				if(elgg_send_email($from, $to, $subject, $message))
				{
					return true;
				}
				register_error(elgg_echo('email:activate:error'));
				return false;
				break;
		}
	}

	public function validateCode($code)
	{
		if($code != $this->generateCode($this->user->guid, $this->user->email, date('Ymd')))
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	private function generateCode($userGuid, $email, $date)
	{
		return md5($userGuid . $email . $date . elgg_get_site_url() . get_site_secret());
	}

	public function validEmail($email)
	{
		$domain = array_pop(explode('@', $email));
		if(!in_array($domain, $this->approvedDomains))
		{
			return false;
		}
		return true;
	}

	private function validateEmail($email)
	{
		if($this->validEmail($email)) {
			if($this->user->email != $email) {
				$this->updateUser('email',$email);
				return true;
			}
			return true;
		}
		else{
			return false;
		}
	}

	public function changeEmail($email)
	{
		if($this->validEmail($email))
		{
			$this->setEmail($email);
			
			if($this->updateUser('email', $email))
			{
				return true;
			}
			else
			{
				register_error(elgg_echo('changeEmail:error:exists'));
				return false;
			}
		}
		else
		{
			register_error(elgg_echo('changeEmail:error:domain'));
			return false;
		}
	}

	public function changePswd($password, $passwordAgain)
	{	
		if($password != $passwordAgain) {
			$error = elgg_echo('RegistrationException:PasswordMismatch');
		}
		if(!$this->validPswd($password)) {
			$error = elgg_echo('resetPassword:error:requirements');
		}
		if(!$this->updateUser('password', $password)) {
			$error = elgg_echo('resetPassword:error:general');
		}

		if($error) {
			register_error($error);
			return false;
		}
		else{
			return true;
		}
	}

	public function validPswd($password)
	{
		//check for bad password
		if(strlen($password) < 8 || preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[\d,.;:]).+$/', $password) == 0){
			return false;
		}
		return true;
	}

	private function updateUser($field, $value)
	{
		$status = elgg_get_ignore_access();
		elgg_set_ignore_access();

		$user = get_entity($this->user->guid);
		
		if($field == 'email') {
			if (!get_user_by_email($value)) {
				$user->$field = $value;
				return $user->save();
			}
			else {
				return false;
			}
		}

		if($field == 'password') {
			$user->$field = md5($value.$this->user->salt);
			return $user->save();
		}
	}

} 
