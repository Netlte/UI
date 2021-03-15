<?php declare(strict_types = 1);

namespace Netlte\UI;

use Nette\Utils\Html;

/**
 * @author       Tomáš Holan <tomas@holan.dev>
 * @package      netlte/ui
 * @copyright    Copyright © 2021, Tomáš Holan [www.holan.dev]
 */
class HtmlControl extends AbstractControl {

	protected Html $html;

	public function __construct(Html $html) {
		$this->html = $html;
	}

	public function getHtml(): Html {
		return $this->html;
	}

	public function render(): void {
		echo $this->html;
	}


}