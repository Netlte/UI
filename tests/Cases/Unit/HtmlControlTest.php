<?php declare(strict_types = 1);

namespace Netlte\UI\Tests\Cases\Unit;

use Netlte\UI\HtmlControl;
use Nette\Utils\Html;
use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ . '/../../bootstrap.php';

class HtmlControlTest extends TestCase {

	public const CONTROL_NAME = 'testing';

	public HtmlControl $control;

	public function setUp(): void {
		$this->control = new HtmlControl(Html::el('div'));
	}

	public function testRender(): void {

		// default behavioral
		Assert::equal("\n<div></div>\n", $this->render());

		// Added 1 tab indentation
		$this->control->indent = 1;
		Assert::equal("\n\t<div></div>\n", $this->render());

		// Added text child
		$this->control->getHtml()->addText('Testing');
		Assert::equal("\n\t<div>Testing</div>\n", $this->render());

		$this->control->getHtml()->removeChildren();

		// Added html child
		$this->control->getHtml()->addHtml(Html::el('h1')->setText('Testing'));
		Assert::equal("\n\t<div>\n\t\t<h1>Testing</h1>\n\t</div>\n", $this->render());

		$this->control->getHtml()->removeChildren();
		$this->control->indent = 0;

		// Added child component
		$child = new HtmlControl(Html::el('p')->setText('Testing'));
		$child->indent = $this->control->indent + 1;
		$this->control->addComponent($child, 'child');
		Assert::equal("\n<div>\n\t\n\t<p>Testing</p>\n\n</div>\n", $this->render());

		// Child first - before sub-components
		$this->control->getHtml()->addHtml(Html::el('h1')->setText('Heading'));
		Assert::equal("\n<div>\n\t<h1>Heading</h1>\n\n\t\n\t<p>Testing</p>\n\n</div>\n", $this->render());

		// Child last - after sub-components
		$this->control->childrenFirst = HtmlControl::RENDER_CHILDREN_LAST;
		Assert::equal("\n<div>\n\t\n\t<p>Testing</p>\n\n\n\t<h1>Heading</h1>\n</div>\n", $this->render());



	}

	protected function render(): string {
		\ob_start();
		$this->control->render();
		$result = \ob_get_clean();
		return $result !== false ? $result : '';
	}
}

(new HtmlControlTest())->run();