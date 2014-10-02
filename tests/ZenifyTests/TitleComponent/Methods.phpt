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


class MethodsTest extends BaseTestCase
{

	public function setUp()
	{
		$this->presenter = new DummyPresenter;
		$this->container->callInjects($this->presenter);
	}


	public function testRender()
	{
		/** @var Zenify\TitleComponent\Control $control */
		$control = $this->presenter['title'];
		$control->set(NULL);

		Assert::same(
			$this->getComponentRender($control, array('mainTitle' => 'Main title')),
			'<title>Main title</title>'
		);
	}


	public function testAppendPrepend()
	{
		/** @var Zenify\TitleComponent\Control $control */
		$control = $this->presenter['title'];
		$control->set('Main title');
		$control->append('appendix');

		Assert::same(
			$this->getComponentRender($control),
			'<title>Main title | appendix</title>'
		);

		$control->setSeparator(' | ');

		Assert::same(
			$this->getComponentRender($control),
			'<title>Main title | appendix</title>'
		);

		$control->append('after appendix');

		Assert::same(
			$this->getComponentRender($control),
			'<title>Main title | appendix | after appendix</title>'
		);

		$control->prepend('prefix');

		Assert::same(
			$this->getComponentRender($control),
			'<title>prefix | Main title | appendix | after appendix</title>'
		);

		$control->prepend('before prefix');


		Assert::same(
			$this->getComponentRender($control),
			'<title>before prefix | prefix | Main title | appendix | after appendix</title>'
		);
	}


	public function testSeparator()
	{
		/** @var Zenify\TitleComponent\Control $control */
		$control = $this->presenter['title'];
		$control->set('Main title');
		$control->prepend('prefix');

		$control->setSeparator(' * ');

		Assert::same(
			$this->getComponentRender($control),
			'<title>prefix * Main title</title>'
		);

		$control->setSeparator(' - ');

		Assert::same(
			$this->getComponentRender($control),
			'<title>prefix - Main title</title>'
		);
	}


	public function testSet()
	{
		/** @var Zenify\TitleComponent\Control $control */
		$control = $this->presenter['title'];
		$control->set('Main title');
		$control->prepend('prefix');
		$control->setSeparator(' | ');

		Assert::same(
			$this->getComponentRender($control),
			'<title>prefix | Main title</title>'
		);

		$control->set('New main title');

		Assert::same(
			$this->getComponentRender($control),
			'<title>New main title</title>'
		);

		$control->prepend('prefix');

		Assert::same(
			$this->getComponentRender($control),
			'<title>prefix | New main title</title>'
		);

		Assert::same(
			$this->getComponentRender($control, array('mainTitle' => 'another title')),
			'<title>another title | prefix | New main title</title>'
		);
	}

}


\run(new MethodsTest($container));
