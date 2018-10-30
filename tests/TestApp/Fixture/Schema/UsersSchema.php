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
namespace Phauthentic\DbunitFixture\Test\TestApp\Fixture\Schema;

use Phauthentic\DbunitFixture\SchemaInterface;
use PDO;

/**
 * UsersSchema
 */
class UsersSchema implements SchemaInterface
{
    /**
     * @var string
     */
    static private $sql =
        "CREATE TABLE IF NOT EXISTS users (
            id INT(11),
            username VARCHAR(128),
            password VARCHAR(128),
            created TIMESTAMP,
            updated TIMESTAMP,
            PRIMARY KEY (id)
        );";

    /**
     * {@inheritDoc}
     */
    public static function create(PDO $pdo): void
    {
        $pdo->query(static::$sql);
    }
}
