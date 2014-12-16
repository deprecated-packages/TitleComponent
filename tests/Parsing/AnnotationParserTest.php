<?php

namespace Zenify\TitleComponent\Tests;

use PHPUnit_Framework_TestCase;
use Zenify\TitleComponent\Parsing\AnnotationParser;
use Zenify\TitleComponent\Tests\Parsing\Source\SomeClass;


class AnnotationParserTest extends PHPUnit_Framework_TestCase
{

	/**
	 * @var SomeClass
	 */
	private $someClass;

	/**
	 * @var AnnotationParser
	 */
	private $annotationParser;


	protected function setUp()
	{
		$this->someClass = new SomeClass;
		$this->annotationParser = new AnnotationParser;
	}


	public function testDetectAndExtract()
	{
		$this->assertSame(
			'This is my title',
			$this->annotationParser->detectAndExtract($this->someClass, 'default')
		);
	}


	public function testDetectAndExtractActionFirst()
	{
		$this->assertSame(
			'First',
			$this->annotationParser->detectAndExtract($this->someClass, 'edit')
		);
	}

}
