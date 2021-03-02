<?php declare(strict_types = 1);

namespace Netlte\UI;

use Nette\Application\UI\Control;
use Nette\Localization\Translator;

/**
 * @author       Tomáš Holan <tomas@holan.dev>
 * @package      netlte/navigation
 * @copyright    Copyright © 2021, Tomáš Holan [www.holan.dev]
 */
abstract class AbstractControl extends Control {

	private ?Translator $translator = null;
	private ?string $templateFile = null;

	public function setTranslator(?Translator $translator = null): self {
		$this->translator = $translator;
		return $this;
	}

	public function getTranslator(): ?Translator {
		return $this->translator;
	}

	public function getTemplateFile(): ?string {
		return $this->templateFile;
	}

	public function setTemplateFile(?string $templateFile): self {
		$this->templateFile = $templateFile;
		return $this;
	}

}