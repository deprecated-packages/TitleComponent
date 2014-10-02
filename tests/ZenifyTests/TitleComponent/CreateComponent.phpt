<?php

/**
 * @testCase
 */

namespace ZenifyTests\TitleComponent;

use Nette;
use Tester\Assert;
use Zenify;
use ZenifyTests\BaseTestCase;


$container = require_once __DIR__ . '/../bootstrap.php';


class CreateComponentTest extends BaseTestCase
{

	public function testFactory()
	{
		$factory = $this->container->getByType('Zenify\TitleComponent\ControlFactory');
		Assert::type('Zenify\TitleComponent\ControlFactory', $factory);
	}


	public function testControl()
	{
		$factory = $this->container->getByType('Zenify\TitleComponent\ControlFactory');
		Assert::type('Zenify\TitleComponent\Control', $factory->create());
	}

}


\run(new CreateComponentTest($container));
