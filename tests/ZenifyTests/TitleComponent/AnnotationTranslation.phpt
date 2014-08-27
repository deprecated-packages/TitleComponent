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
use ZenifyTests\LocalizedPresenter;


$container = require_once __DIR__ . '/../bootstrap.php';


class AnnotationTranslationTest extends \BaseTestCase
{

	public function setUp()
	{
		$this->presenter = new LocalizedPresenter;
		$this->container->callInjects($this->presenter);
	}


	public function testTranslation()
	{
		$this->callPresenterAction('Localized', 'homepage');

		Assert::same(
			'<title>Welcome home</title>',
			$this->getPresenterComponentRender('title')
		);
	}


	public function testArrayTranslation()
	{
		$this->callPresenterAction('Localized', 'user', array('name' => 'Matyas'));

		Assert::same(
			'<title>This is profile of Matyas</title>',
			$this->getPresenterComponentRender('title')
		);
	}

}


\run(new AnnotationTranslationTest($container));
