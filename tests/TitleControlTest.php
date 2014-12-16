<?php

namespace Zenify\TitleComponent\Tests;

use PHPUnit_Framework_TestCase;
use Zenify\TitleComponent\TitleControl;
use Zenify\TitleComponent\TitleControlFactory;


class TitleControlTest extends PHPUnit_Framework_TestCase
{

	/**
	 * @var TitleControl
	 */
	private $titleControl;


	protected function setUp()
	{
		$this->titleControl = new TitleControl;
	}


	public function testSetAppendPrepend()
	{
		$this->titleControl->set(NULL);
		$this->assertSame('', $this->callGetTitle($this->titleControl));

		$this->titleControl->set('Main');
		$this->titleControl->append('appendix');
		$this->assertSame('Main | appendix', $this->callGetTitle($this->titleControl));

		$this->titleControl->append('after appendix');
		$this->assertSame('Main | appendix | after appendix', $this->callGetTitle($this->titleControl));

		$this->titleControl->prepend('prefix');
		$this->assertSame('prefix | Main | appendix | after appendix', $this->callGetTitle($this->titleControl));
	}


	public function testSeparator()
	{
		$this->titleControl->set('Main');
		$this->titleControl->prepend('prefix');

		$this->titleControl->setSeparator(' * ');
		$this->assertSame('prefix * Main', $this->callGetTitle($this->titleControl));

		$this->titleControl->setSeparator(' - ');
		$this->assertSame('prefix - Main', $this->callGetTitle($this->titleControl));
	}


	/**
	 * @return string
	 */
	private function callGetTitle(TitleControl $control)
	{
		$reflection = $control->getReflection();
		$getTitleMethod = $reflection->getMethod('getTitle');
		$getTitleMethod->setAccessible(TRUE);
		return $getTitleMethod->invokeArgs($control, []);
	}

}
