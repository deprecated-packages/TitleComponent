<?php

namespace ZenifyTests;

use Nette;


class DummyPresenter extends Nette\Application\UI\Presenter
{

	/**
	 * @inject
	 * @var \Zenify\TitleComponent\IControlFactory
	 */
	public $titleControlFactory;


	/**
	 * @title Contact us
	 */
	public function renderContact()
	{
	}


	/**
	 * @title About me
	 */
	public function actionAuthor()
	{
	}


	/**
	 * @title Action has priority
	 */
	public function actionPriority()
	{
	}


	/**
	 * @title Render doesn't have priority
	 */
	public function renderPriority()
	{
	}


	/**
	 * @return \Zenify\TitleComponent\Control
	 */
	protected function createComponentTitle()
	{
		return $this->titleControlFactory->create();
	}


	/**
	 * So we don't need templates for presenter
	 * @throws Nette\Application\AbortException
	 */
	public function sendTemplate()
	{
		$this->terminate();
	}

}
