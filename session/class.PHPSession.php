<?php 
/**
 * PHP Session Helper
 *
 * Simple PHP Session for OOP.
 *
 * Use in PHP 5.3.0 or later.
 *
 * Copyright (c) 2017.
 *
 * @author 	Yudi Setiadi Permana <mail@yspermana.my.id>
 * @website yspermana.my.id
 *
 */

class PHPSession{

	/**
	 * Session expired time in minute.
	 */
	private $_expiredTime = 60;
	
	/**
	 * Constructor.
	 *
	 * @param integer $time
	 */
	function __construct($time){

		session_start();

		$this->_expiredTime = $time;

	}

	/**
	 * Destructor.
	 */
	function __destruct(){

		unset($this);

	}

	/**
	 * Initialization session.
	 */
	public function init(){

		$_SESSION['session_id'] 	= session_id();
		$_SESSION['session_time']	= intval($this->_expiredTime);
		$_SESSION['session_start'] 	= $this->_newTime();

	}

	/**
	 * Set key and value in session.
	 * 
	 * @param string $key
	 * @param string $value
	 *
	 * @return void
	 */
	public function set($key, $value){

		$_SESSION[$key] = $value;

	}

	/**
	 * Get value of key in session.
	 * 
	 * @param string $key
	 *
	 * @return string
	 */
	public function get($key){

		return isset($_SESSION[$key]) ? $_SESSION[$key] : false;

	}

	/**
	 * Get all data in session.
	 * 
	 * @return array
	 */
	public function getSession(){

		return $_SESSION;

	}

	/**
	 * Get id of session.
	 * 
	 * @return integer
	 */
	public function getSesionId(){

		return $_SESSION['session_id'];

	}

	/**
	 * Check if session is expired.
	 * 
	 * @return boolean
	 */
	public function isExpired(){

		if ($_SESSION['session_start'] < $this->_timeNow()) {
            return true;
        } else {
            return false;
        }

	}

	/**
     * Renew the session by adding count the expired time.
     */
	public function renew(){

        $_SESSION['session_start'] = $this->_newTime();

    }

    /**
     * Destroys the session.
     */
    public function end(){

        session_destroy();
        $_SESSION = array();

    }

    /**
     * Get time now.
     *
     * @return unix timestamp
     */
    private function _timeNow(){

    	return time();

    }

    /**
     * Get new time for session.
     *
     * @return unix timestamp
     */
    private function _newTime(){

    	return time() + ($this->_expiredTime * 60);

    }

}


?>