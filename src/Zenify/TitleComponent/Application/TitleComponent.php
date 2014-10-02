<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace Zenify\TitleComponent\Application;


trait TitleComponent
{

	/**
	 * @inject
	 * @var \Zenify\TitleComponent\ControlFactory
	 */
	public $titleControl;


	/**
	 * @return \Zenify\TitleComponent\Control
	 */
	protected function createComponentTitle()
	{
		return $this->titleControl->create();
	}

}
