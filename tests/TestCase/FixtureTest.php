<?php
declare(strict_types=1);
/**
 * Copyright (c) Phauthentic (https://github.com/Phauthentic)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Phauthentic (https://github.com/Phauthentic)
 * @link          https://github.com/Phauthentic
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
namespace Phauthentic\DbunitFixture;

use Phauthentic\DbunitFixture\SchemaInterface;
use PDO;
use Phauthentic\DbunitFixture\Test\TestApp\Fixture\UsersFixture;
use PHPUnit\DbUnit\DataSet\IDataSet;
use PHPUnit\DbUnit\DataSet\YamlDataSet;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * Abstract Fixture
 */
class FixtureTest extends FixturizedTestCase
{

	public function testFixtureCreation() {
		$fixture = new UsersFixture();

		$result = $fixture->getDataSet();
		$this->assertInstanceOf(IDataSet::class, $result);

		$result = $fixture->createSchema($this->getPDO());
	}

	/**
	 * This method should create a fixture fot this test.
	 *
	 * @return FixtureInterface
	 */
	protected function createFixture(): FixtureInterface {
		return new UsersFixture();
	}
}
