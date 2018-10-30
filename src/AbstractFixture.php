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
use PHPUnit\DbUnit\DataSet\IDataSet;
use PHPUnit\DbUnit\DataSet\YamlDataSet;
use RuntimeException;

/**
 * Abstract Fixture
 */
abstract class AbstractFixture implements FixtureInterface
{
    /**
     * @var string|null
     */
    protected $dataFile;

    /**
     * @var string|null
     */
    protected $schemaClass;

    /**
     * {@inheritDoc}
     */
    public function createSchema(PDO $pdo): void
    {
        if (empty($this->schemaClass)) {
            $ds = DIRECTORY_SEPARATOR;
            $fqcn = get_class($this);
            $fqcnWithoutFixtureSuffix = $this->schemaClass = substr($fqcn, 0, -7);
            $className = $this->schemaClass = substr($fqcnWithoutFixtureSuffix, strrpos($fqcnWithoutFixtureSuffix, '\\') + 1);
            $this->schemaClass = substr($fqcnWithoutFixtureSuffix, 0, -1 * abs(strlen($className))) . 'Schema' . $ds . $className . 'Schema';
        }

        if (!class_exists($this->schemaClass)) {
            throw new RuntimeException(stprintf(
                'Schema class `%s` for fixture `%s` does not exist',
                $this->schemaClass,
                get_class($this)
            ));
        }

        $class = $this->schemaClass;
        $class::create($pdo);
    }

    /**
     * Returns a path to the file with data set.
     *
     * @param string $name Filename.
     * @return string
     */
    protected function getFile(): string
    {
        return $this->dataFile;
    }

    protected function dataFileExists($dataFile): void
    {
        if (!file_exists($dataFile)) {
            throw new RuntimeException(sprintf(
                'Could not load data for fixture `%s` from `%s`',
                get_class($this),
                $dataFile
            ));
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getDataSet(): IDataSet
    {
        $file = $this->getFile();
        $this->dataFileExists($file);

        return new YamlDataSet($file);
    }
}
