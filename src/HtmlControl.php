<?php declare(strict_types = 1);

namespace Netlte\UI;

use Nette\Utils\Html;

/**
 * @author       Tomáš Holan <tomas@holan.dev>
 * @package      netlte/ui
 * @copyright    Copyright © 2021, Tomáš Holan [www.holan.dev]
 */
class HtmlControl extends AbstractControl {

	public const RENDER_CHILDREN_FIRST = true;
	public const RENDER_CHILDREN_LAST = false;

	public int $indent = 1;
	public bool $childrenFirst = self::RENDER_CHILDREN_FIRST;
	protected Html $html;

	public function __construct(Html $html) {
		$this->html = $html;
	}

	public function getHtml(): Html {
		return $this->html;
	}

	public function render(): void {
		$s = $this->html->startTag();
		$indent = $this->indent;

		if (!$this->html->isEmpty()) {
			// add content
			$indent++;

			if (!$this->childrenFirst) {
				$s .= $this->addIndent($this->renderComponents(), $indent + 1);
			}

			foreach ($this->html->getChildren() as $child) {
				if ($child instanceof Html) {
					$s .= $child->render($indent);
				} else {
					$s .= $child;
				}
			}

			if ($this->childrenFirst) {
				$s .= $this->addIndent($this->renderComponents(), $indent + 1);
			}

			// add end tag
			$s .= $this->html->endTag();
		}

		echo $this->addIndent($s, $indent);
	}

	protected function renderComponents(): string {
		\ob_start();
		foreach ($this->getComponents() as $component) {
			$name = $component->getName();
			if ($name === null) continue;
			if ($this->isComponentHidden($name)) continue;
			if (!\method_exists($component,'render')) continue;
			$component->render();
		}
		$result = \ob_get_clean();
		return  $result !== false ? $result : '';
	}

	protected function addIndent(string $source, int $indent = 0): string {
		if ($source === '') return $source;
		return "\n" . \str_repeat("\t", $indent - 1) . $source . "\n" . \str_repeat("\t", \max(0, $indent - 2));
	}


}
