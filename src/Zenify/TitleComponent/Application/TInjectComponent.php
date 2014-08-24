<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace Zenify\TitleComponent\Application;


trait TInjectComponent
{
	/**
	 * @inject
	 * @var \Zenify\TitleComponent\IControlFactory
	 */
	public $titleControl;


	/**
	 * @return \Zenify\TitleComponent\Control
	 */
	public function createComponentTitle()
	{
		return $this->titleControl->create();
	}

}
