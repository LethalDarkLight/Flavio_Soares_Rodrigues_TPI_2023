<?php
/**
 * @copyright dominique@aigroz.com 2003-2016
 */
require_once ROOT.'config/sessionparam.php';

/**
 * @brief	Session class for managing session
 * @author 	dominique.aigroz@kadeo.net
 * @see  	https://www.php.net/manual/en/class.sessionhandler.php
 */
class ESession extends SessionHandler {

	protected $key;
	protected $name;
	protected $cookie;

	/**
	 * Constructor
	 * @param unknown $key  The session key
	 * @param string $name	The session name 
	 * @param array $cookie	The cookie array
	 */
	public function __construct($key, $name = 'SCHOOL_SESSION', $cookie = [])
	{
		$this->key = $key;
		$this->name = $name;
		$this->cookie = $cookie;

		$this->cookie += [
				'lifetime' => 0,
				'path'     => ini_get('session.cookie_path'),
				'domain'   => ini_get('session.cookie_domain'),
				'secure'   => isset($_SERVER['HTTPS']),
				'httponly' => true
		];
		$this->setup();
		// Start the session
		session_start();
	} # end method


	/**
	 * Setup the session using its name
	 */
	private function setup()
	{
		ini_set('session.use_cookies', 1);
		ini_set('session.use_only_cookies', 1);

		session_name($this->name);
		session_set_cookie_params(
				$this->cookie['lifetime'],
				$this->cookie['path'],
				$this->cookie['domain'],
				$this->cookie['secure'],
				$this->cookie['httponly']
				);
	} # end method


	/**
	 * Starts the session
	 * @return boolean True if successfully started, otherwise false is returned
	 */
	public function start()
	{
		if (session_id() === '') {
			if (session_start()) {
				return mt_rand(0, 4) === 0 ? $this->refresh() : true; // 1/5
			}
		}
		return false;
	} # end method


	/**
	 * Clear the session
	 * @return boolean True if successufully destroyed, otherwise false is returned
	 */
	public function forget()
	{
		if (session_id() === '') {
			return false;
		}
		// Destroy the session
		$_SESSION = [];
		setcookie(
				$this->name,
				'',
				time() - 42000,
				$this->cookie['path'],
				$this->cookie['domain'],
				$this->cookie['secure'],
				$this->cookie['httponly']
				);
		return session_destroy();
	} # end method

	/**
	 * Refresh the session by regenerate its id
	 * @return boolean
	 */
	public function refresh()
	{
		return session_regenerate_id(true);
	} # end method


	/**
	 * Read the session data using an id
	 * {@inheritDoc}
	 * @see SessionHandler::read()
	 */
	public function read($id)
	{
		return mcrypt_decrypt(MCRYPT_3DES, $this->key, parent::read($id), MCRYPT_MODE_ECB);
	} # end method


	/**
	 * Write data to the session using an id  
	 * {@inheritDoc}
	 * @see SessionHandler::write()
	 */
	public function write($id, $data)
	{
		return parent::write($id, mcrypt_encrypt(MCRYPT_3DES, $this->key, $data, MCRYPT_MODE_ECB));
	} # end method


	/**
	 * Has the session expired
	 * @param number $ttl The time. Default is 30
	 * @return boolean True if expired, otherwise false.
	 */
	public function isExpired($ttl = 120)
	{
		$last = isset($_SESSION['_last_activity']) ? $_SESSION['_last_activity'] : false;
		if ($last !== false && time() - $last > $ttl * 60) {
			return true;
		}

		$_SESSION['_last_activity'] = time();
		return false;
	} # end method


	/**
	 * Is the fingerprint corresponding to the one stored within the session
	 * @return boolean True if corresponding, otherwise false.
	 */
	public function isFingerprint()
	{
		$hash = md5(
				$_SERVER['HTTP_USER_AGENT'] .
				(ip2long($_SERVER['REMOTE_ADDR']) & ip2long('255.255.0.0'))
				);

		if (isset($_SESSION['_fingerprint'])) {
			return $_SESSION['_fingerprint'] === $hash;
		}

		$_SESSION['_fingerprint'] = $hash;
		return true;
	} # end method


	/**
	 * Is the session valid
	 * @return boolean True if valid, False if not.
	 */
	public function isValid()
	{
		// prevent the session is started
		if (session_id() === '')
			$this->start();
		
		return ! $this->isExpired() && $this->isFingerprint();
	} # end method


	/**
	 * Get session value
	 * @param unknown $name	The value key
	 * @return NULL|unknown The value or null if not found
	 */
	public function get($name)
	{
		// prevent the session is started
		if (session_id() === '') 
			$this->start();
		
		$parsed = explode('.', $name);
		$result = $_SESSION;

		while ($parsed) {
			$next = array_shift($parsed);
			if (isset($result[$next])) {
				$result = $result[$next];
			} else {
				return null;
			}
		}
		return $result;
	} # end method


	/**
	 * Put a value for a key name
	 * @param unknown $name The value key
	 * @param unknown $value The value to set
	 */
	public function put($name, $value)
	{
		// prevent the session is started
		if (session_id() === '')
			$this->start();
		
		$parsed = explode('.', $name);
		$session =& $_SESSION;

		while (count($parsed) > 1) {
			$next = array_shift($parsed);
			if ( ! isset($session[$next]) || ! is_array($session[$next])) {
				$session[$next] = [];
			}
			$session =& $session[$next];
		}

		$session[array_shift($parsed)] = $value;
	} # end method
} # end class
