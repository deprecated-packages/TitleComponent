<?php

/**
 * @testCase
 */

namespace ZenifyTests\TitleComponent;

use Nette;
use Tester\Assert;
use Zenify;
use ZenifyTests\BaseTestCase;
use ZenifyTests\DummyPresenter;


$container = require_once __DIR__ . '/../bootstrap.php';


class AnnotationDetectionTest extends BaseTestCase
{

	public function setUp()
	{
		$this->presenter = new DummyPresenter();
		$this->container->callInjects($this->presenter);
	}


	public function testRenderAnnotation()
	{
		$this->callPresenterAction('Dummy', 'contact');

		Assert::same(
			'<title>Contact us</title>',
			$this->getPresenterComponentRender('title')
		);
	}


	public function testActionAnnotation()
	{
		$this->callPresenterAction('Dummy', 'author');

		Assert::same(
			'<title>About me</title>',
			$this->getPresenterComponentRender('title')
		);
	}



	public function testActionPriorityAnnotation()
	{
		$this->callPresenterAction('Dummy', 'priority');

		Assert::same(
			'<title>Action has priority</title>',
			$this->getPresenterComponentRender('title')
		);
	}

}


\run(new AnnotationDetectionTest($container));
