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
		$this->control = new class extends AbstractControl {};
	}

	public function testSettersAndGetters(): void {

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

		$result = $this->control->setTemplateFile(__FILE__);
		Assert::type(AbstractControl::class, $result);
		Assert::equal(__FILE__, $result->getTemplateFile());
	}
}

(new AbstractControlTest())->run();