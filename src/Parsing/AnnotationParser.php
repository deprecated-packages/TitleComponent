<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace Zenify\TitleComponent\Parsing;

use Nette;


class AnnotationParser
{

	/**
	 * @param Nette\Application\UI\Presenter $presenter
	 * @return string|NULL
	 */
	public function detectAndExtract(Nette\Application\UI\Presenter $presenter)
	{
		$methods = [];
		$methods[] = $presenter->formatActionMethod($presenter->action);
		$methods[] = $presenter->formatRenderMethod($presenter->action);

		foreach ($methods as $method) {
			if ($presenter->reflection->hasMethod($method)) {
				$reflectionMethod = $presenter->reflection->getMethod($method);

				if ($title = $reflectionMethod->getAnnotation('title')) {
					return $title;
				}
			}
		}

		return NULL;
	}

}
