<?php

/**
 * Test: Zenify\TitleComponent\Control.
 *
 * @testCase
 * @package Zenify\TitleComponent
 */

namespace ZenifyTests\TitleComponent;

use Nette;
use Tester\Assert;
use Zenify;


$container = require_once __DIR__ . '/../bootstrap.php';


class CreateComponentTest extends \BaseTestCase
{

	public function testFactory()
	{
		$factory = $this->container->getByType('Zenify\TitleComponent\IControlFactory');
		Assert::type('Zenify\TitleComponent\IControlFactory', $factory);
	}


	public function testControl()
	{
		$factory = $this->container->getByType('Zenify\TitleComponent\IControlFactory');
		Assert::type('Zenify\TitleComponent\Control', $factory->create());
	}

}


\run(new CreateComponentTest($container));
