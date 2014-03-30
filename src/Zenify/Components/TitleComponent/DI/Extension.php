<?php

/**
 * This file is part of Zenify
 *
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 *
 * For the full copyright and license information, please view
 * the file license.md that was distributed with this source code.
 */

namespace Zenify\Components\TitleComponent\DI;

use Nette\DI\CompilerExtension;


class Extension extends CompilerExtension
{

	public function loadConfiguration()
	{
		$builder = $this->getContainerBuilder();
		$builder->addDefinition($this->prefix('control'))
			->setImplement('Zenify\Components\TitleComponent\UI\IControl');
	}

}
