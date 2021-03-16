<?php declare(strict_types = 1);

namespace Netlte\UI\Tests\Cases\Unit;

use Netlte\UI\AbstractControl;
use Nette\Localization\Translator;
use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ . '/../../bootstrap.php';

class AbstractControlTest extends TestCase {

	public const CONTROL_NAME = 'testing';

	public AbstractControl $control;

	public function setUp(): void {
		$this->control = new class extends AbstractControl {

			public function render(): void {
				foreach ($this->getComponents() as $component) {
					if (\in_array($component->getName(), $this->hidden, true)) continue;
					if (!\method_exists($component,'render')) continue;
					$component->render();
				}
			}

		};
	}

	public function testRender(): void {
		Assert::equal('', $this->render());

		$child = new class extends AbstractControl {
			public function render(): void {
				echo 'Testing';
			}
		};

		// Added child component
		$this->control->addComponent($child, 'child');
		Assert::equal('Testing', $this->render());

		// Hide child component
		$this->control->hideComponent('child');
		Assert::true($this->control->isComponentHidden('child'));
		Assert::false($this->control->isComponentHidden('undefined_component'));
		Assert::equal('', $this->render());

		// Show child component
		$this->control->showComponent('child');
		Assert::equal('Testing', $this->render());

	}

	public function testTemplateFile(): void {
		$result = $this->control->setTemplateFile(__FILE__);
		Assert::type(AbstractControl::class, $result);
		Assert::equal(__FILE__, $result->getTemplateFile());
	}

	public function testTranslator(): void {
		$result = $this->control->setTranslator(new class implements Translator {
			/**
			 * @param  mixed  $message
			 * @param  mixed  ...$parameters
			 */
			public function translate($message, ...$parameters): string {
				return '';
			}
		});

		Assert::type(AbstractControl::class, $result);
		Assert::type(Translator::class, $result->getTranslator());
	}

	protected function render(): string {
		\ob_start();
		$this->control->render();
		$result = \ob_get_clean();
		return $result !== false ? $result : '';
	}
}

(new AbstractControlTest())->run();