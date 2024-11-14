@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>DBMaster Schema Manager</h2>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h3>Available Schemas</h3>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Table Name</th>
                                        <th>Columns</th>
                                        <th>API Enabled</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($schemas as $schema)
                                    <tr>
                                        <td>{{ $schema->table_name }}</td>
                                        <td>{{ count($schema->schema_definition['columns'] ?? []) }}</td>
                                        <td>{{ $schema->api_enabled ? 'Yes' : 'No' }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary" onclick="showAddColumnModal('{{ $schema->table_name }}')">
                                                Add Column
                                            </button>
                                            <button class="btn btn-sm btn-info" onclick="generateForm('{{ $schema->table_name }}')">
                                                Generate Form
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Column Modal -->
<div class="modal fade" id="addColumnModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Column</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addColumnForm">
                    <div class="form-group">
                        <label>Column Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label>Column Type</label>
                        <select class="form-control" name="type" required>
                            <option value="string">String</option>
                            <option value="integer">Integer</option>
                            <option value="text">Text</option>
                            <option value="boolean">Boolean</option>
                            <option value="date">Date</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="submitAddColumn()">Add Column</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
let currentTable = '';

function showAddColumnModal(tableName) {
    currentTable = tableName;
    $('#addColumnModal').modal('show');
}

function submitAddColumn() {
    const form = document.getElementById('addColumnForm');
    const formData = new FormData(form);
    
    fetch(`/dbmaster/schema/${currentTable}/column`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify(Object.fromEntries(formData))
    })
    .then(response => response.json())
    .then(data => {
        $('#addColumnModal').modal('hide');
        window.location.reload();
    })
    .catch(error => console.error('Error:', error));
}

function generateForm(tableName) {
    fetch(`/dbmaster/schema/${tableName}/form`)
        .then(response => response.json())
        .then(data => {
            // Handle the form definition
            console.log('Form generated:', data);
        })
        .catch(error => console.error('Error:', error));
}
</script>
@endpush