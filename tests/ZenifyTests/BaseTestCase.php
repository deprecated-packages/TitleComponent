<?php

namespace ZenifyTests;

use Nette;
use Nette\Application\IResponse;
use Tester\TestCase;


class BaseTestCase extends TestCase
{

	/**
	 * @var Nette\DI\Container
	 */
	protected $container;

	/**
	 * @var Nette\Application\UI\Presenter
	 */
	protected $presenter;


	public function __construct(Nette\DI\Container $container)
	{
		$this->container = $container;
	}


	/**
	 * Simulates request calling presenter's action
	 * @param string $presenter
	 * @param string $action
	 * @param array $args
	 * @return IResponse
	 */
	protected function callPresenterAction($presenter, $action, $args = [])
	{
		$args['action'] = $action;
		$request = new Nette\Application\Request($presenter, 'GET', $args);
		return $this->presenter->run($request);
	}


	/**
	 * @param string
	 * @param array
	 * @return string
	 */
	protected function getPresenterComponentRender($name, array $args = array())
	{
		return $this->getComponentRender($this->presenter[$name], $args);
	}


	/**
	 * @param array $args
	 * @param $control
	 * @return string
	 */
	protected function getComponentRender($control, array $args = array())
	{
		$args = array_slice(func_get_args(), 1);
		ob_start();
		call_user_func_array(array($control, 'render'), $args);
		$render = ob_get_clean();

		return trim($render);
	}

}
