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

use PDO;
use PHPUnit\DbUnit\DataSet\IDataSet;

/**
 * FixtureInterface
 */
interface FixtureInterface
{
    /**
     * This method is used for initializing tables for this fixture.
     *
     * @param PDO $pdo PDO instance.
     * @return void
     */
    public function createSchema(PDO $pdo): void;

    /**
     * Returns IDataSet instance for this fixture..
     *
     * @return IDataSet
     */
    public function getDataSet(): IDataSet;
}
