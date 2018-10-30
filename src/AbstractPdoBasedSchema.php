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

/**
 * Abstract Schema
 */
abstract class AbstractPdoBasedSchema implements SchemaInterface
{
	/**
	 * @var string
	 */
	protected $sql;

	/**
	 * @var \PDO
	 */
	protected $pdo;

	public function __construct(PDO $pdo)
	{
		$this->pdo = $pdo;
	}

	/**
	 * {@inheritDoc}
	 */
	public function create(): void
	{
		$this->pdo->query($this->sql);
	}
}