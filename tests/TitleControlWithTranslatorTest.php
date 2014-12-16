<?php

namespace Zenify\TitleComponent\Tests;

use PHPUnit_Framework_TestCase;
use Zenify\TitleComponent\Tests\Source\DummyTranslator;
use Zenify\TitleComponent\TitleControl;


class TitleControlWithTranslatorTest extends PHPUnit_Framework_TestCase
{

	/**
	 * @var TitleControl
	 */
	private $titleControl;


	protected function setUp()
	{
		$this->titleControl = new TitleControl(new DummyTranslator);
	}


	public function testTranslate()
	{
		$this->titleControl->set('homepage.title.english');
		$this->assertSame('Welcome home', $this->callGetTitle($this->titleControl));
	}


	public function testTranslateWithParam()
	{
		$this->titleControl->set(['user.detail.name', NULL, ['name' => 'John']]);
		$this->assertSame('This is profile of John', $this->callGetTitle($this->titleControl));
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
