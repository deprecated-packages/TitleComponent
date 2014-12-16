<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace Zenify\TitleComponent\Parsing;

use Nette\Reflection\ClassType;


class AnnotationParser
{

	const TITLE = 'title';


	/**
	 * @param object $class
	 * @param string $action
	 * @return string|NULL
	 */
	public function detectAndExtract($class, $action)
	{
		$methods = ['action' . $action, 'render' . $action];
		$classReflection = new ClassType($class);
		foreach ($methods as $method) {
			if ($title = $this->getMethodAnnotation($classReflection, $method, self::TITLE)) {
				return $title;
			}
		}
		return NULL;
	}


	/**
	 * @param ClassType $reflection
	 * @param string $method
	 * @param string $annotation
	 * @return string|bool
	 */
	private function getMethodAnnotation(ClassType $reflection, $method, $annotation)
	{
		if ($reflection->hasMethod($method)) {
			$reflectionMethod = $reflection->getMethod($method);
			if ($title = $reflectionMethod->getAnnotation($annotation)) {
				return $title;
			}
		}
		return FALSE;
	}

}
