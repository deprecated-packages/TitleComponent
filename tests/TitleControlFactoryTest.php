<?php

namespace Zenify\TitleComponent\Tests;

use PHPUnit_Framework_TestCase;
use Zenify\TitleComponent\TitleControl;
use Zenify\TitleComponent\TitleControlFactory;


class CreateComponentTest extends PHPUnit_Framework_TestCase
{

	public function __construct()
	{
		$this->container = (new ContainerFactory)->create();
	}


	public function testFactory()
	{
		/** @var TitleControlFactory $titleControlFactory */
		$titleControlFactory = $this->container->getByType(TitleControlFactory::class);
		$this->assertInstanceOf(
			TitleControlFactory::class,
			$titleControlFactory
		);

		$this->assertInstanceOf(
			TitleControl::class,
			$titleControlFactory->create()
		);
	}

}
