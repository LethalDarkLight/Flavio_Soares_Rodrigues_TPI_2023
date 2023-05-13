<?php
/**
 * @copyright dominique@aigroz.com 2003-2016
 */
require_once ROOT.'session/SecureSession.php';


/**
 * @brief	Helper class for managing session
 * @author 	dominique.aigroz@kadeo.net
 * @remark
 */
class ESessionManager {
	private static $objInstance;
	private $sessionInstance;
	/**
	 * @brief	Class Constructor - Create a new session if one doesn't exist
	  * 			Set to private so no-one can create a new instance via ' = new ESession();'
	  */
	private function __construct() {}
	/**
	 * @brief	Like the constructor, we make __clone private so nobody can clone the instance
	  */
	private function __clone() {}
	/**
	 * @brief	Returns the session instance
	 * @return $objInstance;
	 */
	public static function getInstance() {
		if(!self::$objInstance){
			self::$objInstance = new ESessionManager();
			ini_set('session.save_handler', 'files');
			session_save_path(ROOT.ESES_DATAFOLDER);
			self::$objInstance->sessionInstance = new ESession(ESES_KEY);
			// Test if valid
			if (!self::$objInstance->sessionInstance->isValid()) {
				self::$objInstance->sessionInstance->forget();
			}
	
		}
		return self::$objInstance;
	} # end method
	
	/**
	 * Is the session valid
	 * @return boolean True if valid, otherwise false.
	 */
	public static function IsValid(){
		$Instance = self::getInstance();
		
		if ($Instance && $Instance->sessionInstance && $Instance->sessionInstance->isValid()){
			if ($Instance->sessionInstance->get(ESES_USERID) != null &&	
				$Instance->sessionInstance->get(ESES_ISADMIN) != null)
				return true;
		}
		return false;
	} # end method

	/**
	 * Clear the session
	 * @return boolean True if cleared, otherwise false.
	 */
	public static function Clear(){
		$Instance = self::getInstance();
		
		if ($Instance && $Instance->sessionInstance && $Instance->sessionInstance->isValid()){
			return $Instance->sessionInstance->forget();
		}
		return false;
	} # end method

	/**
	 * Get the user email of the connected user
	 * @return string|boolean The email, otherwise false.
	 */
	public static function GetConnectedUserId(){
		$Instance = self::getInstance();
	
		if ($Instance && $Instance->sessionInstance && $Instance->sessionInstance->isValid()){
			$id = $Instance->sessionInstance->get(ESES_USERID);
			if ($id)
				return $id;
		}
		return false;
	} # end method

	/**
	 * Is the connected user admin
	 * @return boolean True if admin, otherwise false.
	 */
	public static function IsConnectedUserAdmin(){
		$Instance = self::getInstance();
	
		if ($Instance && $Instance->sessionInstance && $Instance->sessionInstance->isValid()){
			$isAdmin = $Instance->sessionInstance->get(ESES_ISADMIN);
			if ($isAdmin)
				return $isAdmin;
		}
		return false;
	} # end method
	
	/**
	 * Set the user for this session
	 * @param integer $userid	The user id
	 * @param boolean $admin If admin
	 * @return boolean True if successfully set, otherwise false
	 */
	public static function SetUser($userid, $admin){
		$Instance = self::getInstance();
		
		if ($Instance && $Instance->sessionInstance && $Instance->sessionInstance->isValid()){
			$Instance->sessionInstance->put(ESES_USERID, $userid);
			$Instance->sessionInstance->put(ESES_ISADMIN, $admin);
			return true;
		}
		return false;
	} # end method
	
} # end class
	