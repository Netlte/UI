<?php declare(strict_types = 1);

namespace Netlte\UI\Tests\Cases\Unit;

use Netlte\UI\BaseContainer;
use Nette\Application\UI\Control;
use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ . '/../../bootstrap.php';

class BaseContainerTest extends TestCase {

	public const CONTROL_NAME = 'testing';

	public BaseContainer $container;

	public function prepareTests(): void {
		$this->container = new BaseContainer();
		$control = new class extends Control {
			public function render(): void {
				echo 'test';
			}
		};
		$this->container->addComponent($control, self::CONTROL_NAME);
	}


	public function testRenderableControl(): void {
		$this->prepareTests();

		\ob_start();
		$this->container->render();
		$result = \ob_get_clean();

		Assert::equal('test', $result);

		$this->container->hideComponent(self::CONTROL_NAME);

		\ob_start();
		$this->container->render();
		$result = \ob_get_clean();

		Assert::equal('', $result);


		$this->container->showComponent(self::CONTROL_NAME);

		\ob_start();
		$this->container->render();
		$result = \ob_get_clean();

		Assert::equal('test', $result);
	}

	public function testNonRenderableControl(): void {
		$this->prepareTests();
		$this->container->removeComponent($this->container->getComponent(self::CONTROL_NAME));
		$control = new class extends Control {
		};
		$this->container->addComponent($control, self::CONTROL_NAME);

		\ob_start();
		$this->container->render();
		$result = \ob_get_clean();

		Assert::equal('', $result);
	}

}

(new BaseContainerTest())->run();