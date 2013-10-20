<?php 

use System\View;

class TwitterCardAdminView extends View {

	/**
	 * The current path to view file
	 *
	 * @var string
	 */
	public $path;

	/**
	 * Array of view variables
	 *
	 * @var array
	 */
	public $vars = array();

	/**
	 * Create a instance or the View class for chaining
	 *
	 * @param string
	 * @param array
	 * @return object
	 */
	public static function create($path, $vars = array()) {
		return new static($path, $vars);
	}

	/**
	 * Create a instance of a View class for chaining using a
	 * method for the file name
	 *
	 * @example View::home(array('title' => 'Home'));
	 *
	 * @param string
	 * @param array
	 * @return object
	 */
	public static function __callStatic($method, $arguments) {
		$vars = count($arguments) ? current($arguments) : array();
		return new static($method, $vars);
	}

	/**
	 * Create a instance or the View class
	 *
	 * @param string
	 * @param array
	 */
	public function __construct($path, $vars = array()) {
		$this->path = PATH.'plugins'.DS.'TwitterCard'.DS.'views'.DS.$path.EXT;
		$this->vars = array_merge($this->vars, $vars);
	}

	/**
	 * Render a partial view
	 *
	 * @return string
	 */
	public function partial($name, $path, $vars = array(), $plugin) {
		$this->vars[$name] = static::create($path, $vars)->render($path, $plugin);
		return $this;
	}

	/**
	 * Render the view
	 *
	 * @return string
	 */
	public function render($path = '', $plugin = true) {
		ob_start();

		extract($this->vars);
        if ($plugin) {
            require $this->path;
        } else {
            require APP . 'views/' . $path . EXT; 
        }

		return ob_get_clean();
	}

}
