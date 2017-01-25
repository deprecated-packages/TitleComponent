<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace Zenify\TitleComponent;

use Nette\Application\UI\Control;
use Nette\Bridges\ApplicationLatte\Template;
use Nette\Localization\ITranslator;
use Zenify\TitleComponent\Parsing\AnnotationParser;


/**
 * @property-read Template $template
 */
class TitleControl extends Control
{

	/**
	 * @var string[]
	 */
	private $items = [];

	/**
	 * @var string
	 */
	private $separator = ' | ';

	/**
	 * @var ITranslator
	 */
	private $translator;


	public function __construct(ITranslator $translator = NULL)
	{
		$this->translator = $translator;
	}


	/**
	 * @param string $separator
	 */
	public function setSeparator($separator)
	{
		$this->separator = $separator;
	}


	/**
	 * @param string
	 */
	public function prepend($title)
	{
		array_unshift($this->items, $title);
	}


	/**
	 * @param string
	 */
	public function append($title)
	{
		array_push($this->items, $title);
	}


	/**
	 * @param string|array
	 */
	public function set($title)
	{
		$this->items = [];
		$this->append($title);
	}


	public function attached($presenter)
	{
		parent::attached($presenter);

		$parser = new AnnotationParser;
		if ($title = $parser->detectAndExtract($presenter, $presenter->action)) {
			$this->set($title);
		}
	}


	/**
	 * @param string|NULL $mainTitle
	 */
	public function render($mainTitle = NULL)
	{
		if ($mainTitle) {
			$this->prepend($mainTitle);
		}
		$this->template->setParameters(['title' => $this->getTitle()]);
		$this->template->setFile(__DIR__ . '/templates/default.latte');
		$this->template->render();
	}


	/**
	 * @return string
	 */
	private function getTitle()
	{
		$this->items = array_filter($this->items);
		if ($this->translator) {
			$this->items = array_map([$this, 'translate'], $this->items);
		}
		return implode($this->separator, $this->items);
	}


	/**
	 * @param string $title
	 * @return mixed|string
	 */
	private function translate($title)
	{
		if (is_array($title)) {
			$title = call_user_func_array([$this->translator, 'translate'], $title);

		} else {
			$title = $this->translator->translate($title);
		}
		return $title;
	}

}
