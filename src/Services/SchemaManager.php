<?php

namespace Rexgama\DBMaster\Services;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Rexgama\DBMaster\Models\DynamicSchema;

class SchemaManager
{
    public function addColumn($tableName, $columnDefinition)
    {
        Schema::table($tableName, function (Blueprint $table) use ($columnDefinition) {
            $type = $columnDefinition['type'];
            $name = $columnDefinition['name'];
            
            switch ($type) {
                case 'string':
                    $table->string($name);
                    break;
                case 'integer':
                    $table->integer($name);
                    break;
                case 'text':
                    $table->text($name);
                    break;
                // Add more types as needed
            }
        });

        $schema = DynamicSchema::where('table_name', $tableName)->first();
        $definition = $schema->schema_definition;
        $definition['columns'][] = $columnDefinition;
        $schema->schema_definition = $definition;
        $schema->save();
    }

    public function generateForm($tableName)
    {
        $schema = DynamicSchema::where('table_name', $tableName)->first();
        return $this->buildFormFromSchema($schema->schema_definition);
    }

    private function buildFormFromSchema($schemaDefinition)
    {
        $form = [];
        foreach ($schemaDefinition['columns'] as $column) {
            $form[] = [
                'type' => $this->mapColumnTypeToFormField($column['type']),
                'name' => $column['name'],
                'label' => ucfirst(str_replace('_', ' ', $column['name'])),
                'rules' => $column['validation'] ?? []
            ];
        }
        return $form;
    }

    private function mapColumnTypeToFormField($columnType)
    {
        $mapping = [
            'string' => 'text',
            'text' => 'textarea',
            'integer' => 'number',
            'boolean' => 'checkbox',
            'date' => 'date',
        ];

        return $mapping[$columnType] ?? 'text';
    }
}