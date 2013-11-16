<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	// Need to store the user's ID:
	private $_id;
	private $_name;
	
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user = Usuario::model()->findByAttributes(array('username'=>$this->username));
		
		//$ph = new PasswordHash(Yii::app()->params['phpass']['iteration_count_log2'], Yii::app()->params['phpass']['portable_hashes']);
		
		if ($user===null) {
			// No user found!
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		} else if ($user->password!==$this->password) {
			// Invalid password!
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		} else { // Okay!
			$this->_id = $user->id;
			$this->_name = $user->username;
			$this->setState('roles', $user->role);
			$this->errorCode=self::ERROR_NONE;
		}
		
		return !$this->errorCode;
	}
	
	public function getId()
	{
		return $this->_id;
	}
}