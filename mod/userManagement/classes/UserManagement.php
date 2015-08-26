<?php
class UserManagement extends ElggObject
{
	public function __construct()
	{
		$this->initializeAttributes();
	}

	protected function initializeAttributes()
	{
		parent::initializeAttributes();
		$this->users = array();
		$this->user = '';
		$this->siteDomain = get_site_domain($CONFIG->site_guid);
		$this->site = elgg_get_site_entity();
		
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

	public function sendEmail($action, $email)
	{
		switch($action){
			case 'activate':
				$email = sanitise_string($email);
				$user = $this->getUserByEmail($email);

				if(!$user)
				{
					return false;
				}
				if(!$user->deactivated)
				{
					return false;
				}
				//construct the email
				$from = "noreply@".$this->siteDomain;
				$to = $email;
				$subject = "Activate your account";
				$code = $this->generateCode($user->guid, $email, date('Ymd'));
				$link = "{$this->site->url}usermgmt/activation?u={$user->guid}&c=$code";
				$message = elgg_echo('email:activate:body', array($user->name, $link, $this->site->name, $this->$site->url));

				if(elgg_send_email($from, $to, $subject, $message))
				{
					return true;
				}

				break;
		}
	}

	public function validateCode($code)
	{
		if($code != $this->generateCode($this->user->guid, $this->user->email, date('Ymd')))
		{

		}
	}

	private function generateCode($userGuid, $email, $date)
	{
		return md5($userGuid . $email . $date . elgg_get_site_url() . get_site_secret());
	}

} 
