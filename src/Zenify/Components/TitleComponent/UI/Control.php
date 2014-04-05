<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace Zenify\Components\TitleComponent\UI;

use Nette;


class Control extends Nette\Application\UI\Control
{
	/** @var string */
	private $title;

	/** @var Nette\Localization\ITranslator */
	private $translator;


	public function inject(Nette\Localization\ITranslator $translator = NULL)
	{
		$this->translator = $translator;
	}


	public function attached($presenter)
	{
		parent::attached($presenter);

		$methods[] = $presenter->formatActionMethod($presenter->view);
		$methods[] = $presenter->formatRenderMethod($presenter->view);
		foreach ($methods as $method) {
			if ($presenter->reflection->hasMethod($method)) {
				$reflectionMethod = $presenter->reflection->getMethod($method);

				if ($title = $reflectionMethod->getAnnotation('title')) {
					$this->title = $title;
				}
			}
		}
	}


	public function render()
	{
		if ($this->translator) {
			$this->title = $this->translator->translate($this->title);
		}

		$this->template->title = $this->title;
		$this->template->setFile(__DIR__ . '/templates/default.latte');
		$this->template->render();
	}


	public function setTitle($title)
	{
		$this->title = $title;
	}

}
