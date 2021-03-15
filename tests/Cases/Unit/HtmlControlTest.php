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
		$this->control = new HtmlControl(Html::el('span'));
	}

	public function testRender(): void {
		\ob_start();
		$this->control->render();
		$result = \ob_get_clean();

		Assert::equal('<span></span>', $result);
	}
}

(new HtmlControlTest())->run();