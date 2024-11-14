<?php

namespace Rexgama\DBMaster\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Rexgama\DBMaster\Services\SchemaManager;
use Rexgama\DBMaster\Models\DynamicSchema;

class SchemaManagerTest extends TestCase
{
    protected $schemaManager;

    protected function setUp(): void
    {
        parent::setUp();
        $this->schemaManager = new SchemaManager();
    }

    public function testMapColumnTypeToFormField()
    {
        $method = new \ReflectionMethod(SchemaManager::class, 'mapColumnTypeToFormField');
        $method->setAccessible(true);

        $this->assertEquals('text', $method->invoke($this->schemaManager, 'string'));
        $this->assertEquals('textarea', $method->invoke($this->schemaManager, 'text'));
        $this->assertEquals('number', $method->invoke($this->schemaManager, 'integer'));
        $this->assertEquals('checkbox', $method->invoke($this->schemaManager, 'boolean'));
        $this->assertEquals('date', $method->invoke($this->schemaManager, 'date'));
    }
}