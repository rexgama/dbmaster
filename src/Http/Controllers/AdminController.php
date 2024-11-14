<?php

namespace Rexgama\DBMaster\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Rexgama\DBMaster\Services\SchemaManager;
use Rexgama\DBMaster\Models\DynamicSchema;

class AdminController extends Controller
{
    protected $schemaManager;

    public function __construct(SchemaManager $schemaManager)
    {
        $this->schemaManager = $schemaManager;
    }

    public function index()
    {
        $schemas = DynamicSchema::all();
        return view('dbmaster::index', compact('schemas'));
    }

    public function addColumn(Request $request, $tableName)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'type' => 'required|string|in:string,integer,text,boolean,date',
            'validation' => 'nullable|array'
        ]);

        $this->schemaManager->addColumn($tableName, $validated);

        return response()->json(['message' => 'Column added successfully']);
    }

    public function generateForm($tableName)
    {
        $form = $this->schemaManager->generateForm($tableName);
        return response()->json($form);
    }
}