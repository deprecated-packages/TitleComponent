<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace Zenify\TitleComponent\DI;

use Nette\DI\CompilerExtension;
use Zenify\TitleComponent\TitleControlFactory;


class TitleExtension extends CompilerExtension
{

	public function loadConfiguration()
	{
		$builder = $this->getContainerBuilder();
		$builder->addDefinition($this->prefix('flashMessageFactory'))
			->setImplement(TitleControlFactory::class);
	}

}
