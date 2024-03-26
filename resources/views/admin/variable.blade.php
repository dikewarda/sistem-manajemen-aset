@extends('layout.main')
@section('title', 'Variabel')
@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Variabel</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Admin</li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Health Index</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <!-- Add Variable modal -->
    <div class="modal fade" id="addVariableColumn" tabindex="-1" role="dialog" aria-labelledby="addVariableLabel" aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog" role="document">
            <form action="{{ route('add.variable')}}" method="POST">
                <div class="modal-content">
                    <div class="modal-header p-2 px-3" style="background-color: #012970;">
                        <h5 class="modal-title text-center" id="addVariableLabel" style="color: #fff;">Tambah Variabel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body justify-content-center p-3 mb-0">
                        @csrf
                        <div id="formCont">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="variable_name" id="floatingName" placeholder="Nama Variabel" required>
                                <label for="floatingName">Nama Variabel</label>
                            </div>
                            <p class="my-2"><em>Pilih untuk menyertakan kolom:</em></p>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="gridCheck1" name="column[]" value="variable">
                                <label class="form-check-label" for="gridCheck1">
                                    variable
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="gridCheck2" name="column[]" value="value">
                                <label class="form-check-label" for="gridCheck2">
                                    value
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="gridCheck3" name="column[]" value="min">
                                <label class="form-check-label" for="gridCheck3">
                                    min
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="gridCheck4" name="column[]" value="max">
                                <label class="form-check-label" for="gridCheck4">
                                    max
                                </label>
                            </div>
                            <p class="mt-2 mb-1"><em>Tambah kolom:</em></p>
                            <div class="addForm mb-2 d-flex align-items-center">
                                <input type="text" name="column[]" class="form-control input-data me-1" id="floatingInput" placeholder="nama kolom">
                                <!-- <label for="floatingInput">nama kolom</label> -->
                                <div class="dropdown me-1">
                                    <select id="floatingInput" name="tipe[]" class="form-control col-md-3">
                                        <option value="">-Tipe Data-</option>
                                        <option value="string">Teks Singkat</option>
                                        <option value="integer">Angka</option>
                                        <option value="date">Tanggal</option>
                                        <option value="time">Waktu</option>
                                        <option value="double">Desimal</option>
                                        <option value="boolean">OK/NOT OK</option>
                                        <option value="text">Teks Panjang</option>
                                    </select>
                                </div>
                                <button type="button" class="btn btn-warning" style="height: 38px;" onclick="addColumn()"><i class="bi bi-plus"></i></button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary py-1 px-2 mt-3" style="background-color: #012970;">Simpan</button>
                        <button type="button" class="btn btn-secondary py-1 px-2 mt-3" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Variable modal -->
    <div class="modal fade" id="editVariableModal" tabindex="-1" role="dialog" aria-labelledby="editVariableLabel" aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog" role="document">
            <form action="{{ route('edit.variable')}}" id="EditVariableForm" method="POST">
                <div class="modal-content">
                    <div class="modal-header p-2 px-3" style="background-color: #012970;">
                        <h5 class="modal-title text-center" id="editVariableLabel" style="color: #fff;">Tambah Variabel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body justify-content-center p-3 mb-0">
                        @csrf
                        <div id="formEditColumn">
                            <input type="hidden" name="var_id" id="varId">
                            <div class="form-floating">
                                <input type="hidden" name="old_variable_name" id="oldVariableName">
                                <input type="text" class="form-control" name="variable_name" id="variableName" placeholder="Nama Variabel" required>
                                <label for="variableName">Nama Variabel</label>
                            </div>
                            <p class="my-2"><em>Daftar kolom:</em></p>
                            <input type="hidden" name="old_column_name[]" class="oldColumnName">
                            <input type="hidden" name="new_column_name[]" class="newColumnName">
                            <ul id="columnList" class="list-group list-group-flush">
                            </ul>
                            <p class="mt-2 mb-1"><em>Tambah kolom:</em></p>
                            <div class="editForm mb-2 d-flex align-items-center">
                                <input type="text" name="columns[]" class="form-control input-data me-1" id="floatingEdit" placeholder="nama kolom">
                                <div class="dropdown me-1">
                                    <select id="floatingEdit" name="types[]" class="form-control col-md-3">
                                        <option value="">-Tipe Data-</option>
                                        <option value="string">Teks Singkat</option>
                                        <option value="integer">Angka</option>
                                        <option value="date">Tanggal</option>
                                        <option value="time">Waktu</option>
                                        <option value="double">Desimal</option>
                                        <option value="boolean">OK/NOT OK</option>
                                        <option value="text">Teks Panjang</option>
                                    </select>
                                </div>
                                <button type="button" class="btn btn-warning" style="height: 38px;" onclick="addEditColumn()"><i class="bi bi-plus"></i></button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary py-1 px-2 mt-3" style="background-color: #012970;">Simpan</button>
                        <button type="button" class="btn btn-secondary py-1 px-2 mt-3" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <!-- Variables List -->
                <div class="row">
                    @php
                    $icons = ['bi bi-puzzle', 'bi bi-gear-wide-connected', 'bi bi-box-seam', 'bi bi-archive'];
                    $color = ['sales-card', 'revenue-card', 'customers-card', 'product-card'];
                    $iconIndex = 0;
                    @endphp
                    @foreach($variable as $var)
                    <div class="col-xxl-3 col-md-3 col-3">
                        <!-- <a href="#" class="card-link"> -->
                        <div class="card info-card {{ $color[$iconIndex] }}">
                            <div class="card-body">
                                <h5 class="card-title d-flex justify-content-between align-items-center">{{ $var->variable }}<i class="bx bxs-trash-alt delete-icon" data-variable-name="{{ $var->variable }}" style="cursor: pointer;"></i></h5>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="{{ $icons[$iconIndex] }}"></i>
                                        </div>
                                        <div class="ps-3">
                                            <span style="font-size: 10px;color: #899bbd;">TOTAL DATA:</span>
                                            <h6>{{ $var->jumlah_data }}</h6>
                                        </div>
                                    </div>
                                    <div>
                                        <i class="ri-edit-2-fill edit-icon" style="cursor: pointer;" onclick="openEditModal('{{ $var->id }}', '{{ $var->variable }}')"></i>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- </a> -->
                    </div>
                    @php
                    $iconIndex = ($iconIndex + 1) % count($icons);
                    @endphp
                    @endforeach
                    <div class="col-xxl-3 col-md-3 col-3 d-flex align-items-center">
                        <div class="card" style="border-radius: 30px;">
                            <button type="button" class="btn btn-light btn-lg rounded-pill" data-bs-toggle="modal" data-bs-target="#addVariableColumn"><i class="bi bi-plus-lg"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Daftar Variabel</h5>

                        <ul class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
                            @foreach ($data as $index => $tableName)
                            <li class="nav-item flex-fill" role="presentation">
                                <button class="nav-link w-100 {{ $index === 0 ? 'active' : '' }}" id="tab{{ $index }}" data-bs-toggle="tab" data-bs-target="#content{{ $index }}" type="button" role="tab" aria-controls="content{{ $index }}" aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                    {{ $index }}
                                </button>
                            </li>
                            @endforeach
                        </ul>

                        <div class="tab-content pt-2" id="myTabjustifiedContent">
                            @foreach ($data as $index => $table)
                            <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" id="content{{ $index }}" role="tabpanel" aria-labelledby="tab{{ $index }}">
                                <div class="table-wrapper">
                                    <table class="table table-hover table-responsive text-center">
                                        <thead style="z-index: 4;">
                                            <tr class="align-middle">
                                                @foreach ($table['columns'] as $column)
                                                @if ($column !== 'created_at' && $column !== 'updated_at')
                                                <th>{{ $column }}</th>
                                                @endif
                                                @endforeach
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (empty($table['rows']))
                                            <tr>
                                                <td colspan="{{ count($table['columns']) }}">No data available for {{ $index }}.</td>
                                            </tr>
                                            @else
                                            @foreach ($table['rows'] as $row)
                                            <tr>
                                                @foreach ($row as $column => $value)
                                                @if ($column !== 'created_at' && $column !== 'updated_at')
                                                <td>{{ $value }}</td>
                                                @endif
                                                @endforeach
                                                <td>
                                                    <button class="btn btn-warning btn-sm"><i class="bi bi-pencil-fill"></i></button>
                                                    <button class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endforeach
                            <!-- <button type="button" class="btn btn-light btn-lg rounded-pill addData" data-bs-toggle="modal" data-bs-target="#addData" id="addDataButton"><i class="bi bi-plus-lg"></i></button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

</main>

<script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
<script>
    var formContainer = document.getElementById('formCont');

    function addColumn() {
        var newContainer = document.createElement('div');
        newContainer.className = 'addForm mb-2 d-flex align-items-center';

        var newField = document.createElement('input');
        newField.setAttribute('type', 'text');
        newField.setAttribute('name', 'column[]');
        newField.setAttribute('class', 'form-control input-data  me-1');
        newField.setAttribute('id', 'floatingInput');
        newField.setAttribute('placeholder', 'Nama Kolom');
        newContainer.appendChild(newField);

        var newDiv = document.createElement('div');
        newDiv.setAttribute('class', 'dropdown me-1');

        var newDropdown = document.createElement('select');
        newDropdown.setAttribute('id', 'floatingInput');
        newDropdown.setAttribute('name', 'tipe[]');
        newDropdown.setAttribute('class', 'form-control col-md-3');

        var options = [{
                value: "",
                label: "-Tipe Data-"
            },
            {
                value: "string",
                label: "Teks Singkat"
            },
            {
                value: "integer",
                label: "Angka"
            },
            {
                value: "date",
                label: "Tanggal"
            },
            {
                value: "time",
                label: "Waktu"
            },
            {
                value: "float",
                label: "Desimal"
            },
            {
                value: "boolean",
                label: "OK/NOT OK"
            },
            {
                value: "text",
                label: "Teks Panjang"
            }
        ];

        for (var i = 0; i < options.length; i++) {
            var option = document.createElement('option');
            option.value = options[i].value;
            option.text = options[i].label;
            newDropdown.appendChild(option);
        }
        newDiv.appendChild(newDropdown);
        newContainer.appendChild(newDiv);

        var newButton = document.createElement('button');
        newButton.setAttribute('type', 'button');
        newButton.setAttribute('class', 'btn btn-secondary');
        newButton.setAttribute('style', 'height: 38px;');
        newButton.innerHTML = '<i class="bi bi-x-lg"></i>';
        newButton.setAttribute('onclick', 'remove()');
        newContainer.appendChild(newButton);

        formContainer.appendChild(newContainer);
    }

    function remove() {
        var input_tags = formContainer.querySelectorAll('.addForm');
        if (input_tags.length > 1) {
            formContainer.removeChild(input_tags[(input_tags.length) - 1]);
        }
    }
</script>
<script>
    var formEditContainer = document.getElementById('formEditColumn');

    function addEditColumn() {
        var newEditContainer = document.createElement('div');
        newEditContainer.className = 'editForm mb-2 d-flex align-items-center';

        var newEditField = document.createElement('input');
        newEditField.setAttribute('type', 'text');
        newEditField.setAttribute('name', 'columns[]');
        newEditField.setAttribute('class', 'form-control input-data  me-1');
        newEditField.setAttribute('id', 'floatingEdit');
        newEditField.setAttribute('placeholder', 'Nama Kolom');
        newEditContainer.appendChild(newEditField);

        var newEditDiv = document.createElement('div');
        newEditDiv.setAttribute('class', 'dropdown me-1');

        var newEditDropdown = document.createElement('select');
        newEditDropdown.setAttribute('id', 'floatingEdit');
        newEditDropdown.setAttribute('name', 'types[]');
        newEditDropdown.setAttribute('class', 'form-control col-md-3');

        var editOptions = [{
                value: "",
                label: "-Tipe Data-"
            },
            {
                value: "string",
                label: "Teks Singkat"
            },
            {
                value: "integer",
                label: "Angka"
            },
            {
                value: "date",
                label: "Tanggal"
            },
            {
                value: "time",
                label: "Waktu"
            },
            {
                value: "float",
                label: "Desimal"
            },
            {
                value: "boolean",
                label: "OK/NOT OK"
            },
            {
                value: "text",
                label: "Teks Panjang"
            }
        ];

        for (var i = 0; i < editOptions.length; i++) {
            var option = document.createElement('option');
            option.value = editOptions[i].value;
            option.text = editOptions[i].label;
            newEditDropdown.appendChild(option);
        }
        newEditDiv.appendChild(newEditDropdown);
        newEditContainer.appendChild(newEditDiv);

        var newEditButton = document.createElement('button');
        newEditButton.setAttribute('type', 'button');
        newEditButton.setAttribute('class', 'btn btn-secondary');
        newEditButton.setAttribute('style', 'height: 38px;');
        newEditButton.innerHTML = '<i class="bi bi-x-lg"></i>';
        newEditButton.setAttribute('onclick', 'removeColumn()');
        newEditContainer.appendChild(newEditButton);

        formEditContainer.appendChild(newEditContainer);
    }

    function removeColumn() {
        var edit_tags = formEditContainer.querySelectorAll('.editForm');
        if (edit_tags.length > 1) {
            formEditContainer.removeChild(edit_tags[(edit_tags.length) - 1]);
        }
    }
</script>
<script>
    const deleteIcons = document.querySelectorAll('.delete-icon');
    deleteIcons.forEach(icon => {
        icon.addEventListener('click', function() {
            const variableName = icon.getAttribute('data-variable-name');
            if (confirm(`Apakah Anda yakin ingin menghapus variabel "${variableName}"?`)) {
                deleteFormula(variableName);
            }
        });
    });

    function deleteFormula(variableName) {
        fetch(`/delete-variable/${variableName}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => {
                if (response.ok) {
                    console.log('Formula berhasil dihapus');
                } else {
                    console.error('Gagal menghapus formula');
                }
                location.reload();
            })
            .catch(error => {
                console.error('Terjadi kesalahan:', error);
            });
    }
</script>
<script>
    function openEditModal(id, name) {
        const editVariableModal = new bootstrap.Modal(document.getElementById('editVariableModal'));
        editVariableModal.show();
        document.getElementById('varId').value = id;
        document.getElementById('variableName').value = name;
        document.getElementById('oldVariableName').value = name;

        fetch('/get-columns/' + name)
            .then(response => response.json())
            .then(data => {
                const columnList = document.getElementById('columnList');
                columnList.innerHTML = '';
                data.columns.forEach(column => {
                    if (['id', 'variable', 'min', 'max', 'value'].indexOf(column) === -1) {
                        const li = document.createElement('li');
                        li.className = 'list-group-item d-flex justify-content-between align-items-center';
                        li.setAttribute('data-column', column);
                        const columnNameDiv = document.createElement('div');
                        columnNameDiv.textContent = column;

                        const editDeleteDiv = document.createElement('div');

                        const editIcon = document.createElement('i');
                        editIcon.className = 'bi bi-pencil-fill me-2';
                        editIcon.style.cursor = 'pointer';
                        editIcon.onclick = function() {
                            editColumn(column);
                        };
                        editDeleteDiv.appendChild(editIcon);

                        const deleteIcon = document.createElement('i');
                        deleteIcon.className = 'bi bi-trash-fill';
                        deleteIcon.style.cursor = 'pointer';
                        deleteIcon.onclick = function() {
                            deleteColumn(column);
                        };
                        editDeleteDiv.appendChild(deleteIcon);

                        li.appendChild(columnNameDiv);
                        li.appendChild(editDeleteDiv);

                        columnList.appendChild(li);
                    } else {
                        const li = document.createElement('li');
                        li.className = 'list-group-item d-flex justify-content-between align-items-center';
                        li.setAttribute('data-column', column);
                        const columnNameDiv = document.createElement('div');
                        columnNameDiv.textContent = column;

                        const editDeleteDiv = document.createElement('div');

                        const deleteIcon = document.createElement('i');
                        deleteIcon.className = 'bi bi-trash-fill';
                        deleteIcon.style.cursor = 'pointer';
                        deleteIcon.onclick = function() {
                            deleteColumn(column);
                        };
                        editDeleteDiv.appendChild(deleteIcon);

                        li.appendChild(columnNameDiv);
                        li.appendChild(editDeleteDiv);

                        columnList.appendChild(li);
                    }
                });
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function editColumn(column) {
        const columnNameDiv = document.querySelector(`#columnList [data-column="${column}"] div`);
        const originalColumnName = columnNameDiv.textContent;

        const inputElement = document.createElement('input');
        inputElement.type = 'text';
        inputElement.className = 'form-control';
        inputElement.value = originalColumnName;

        columnNameDiv.innerHTML = '';
        columnNameDiv.appendChild(inputElement);
        inputElement.focus();

        const editIcon = columnNameDiv.parentNode.querySelector('.bi-pencil-fill');
        editIcon.className = 'bi bi-check-circle-fill me-2';
        editIcon.onclick = function() {
            saveEdit(column, originalColumnName, inputElement.value);
        };
    }

    function saveEdit(column, originalName, newName) {
        const columnNameDiv = document.querySelector(`#columnList [data-column="${column}"] div`);
        columnNameDiv.textContent = newName;

        const oldInput = document.querySelector(`.oldColumnName`);
        const newInput = document.querySelector(`.newColumnName`);

        if (oldInput && newInput) {
            oldInput.value = originalName;
            newInput.value = newName;
        }

        const editIcon = columnNameDiv.parentNode.querySelector('.bi-check-circle-fill');
        editIcon.className = 'bi bi-pencil-fill me-2';
        editIcon.onclick = function() {
            editColumn(column);
        };
    }

    document.getElementById('EditVariableForm').addEventListener('submit', function(event) {
        const editIcons = document.querySelectorAll('.bi-check-circle-fill');
        if (editIcons.length > 0) {
            event.preventDefault(); 
            alert('Harap simpan perubahan sebelum mengirimkan formulir.');
        }
    });

    function deleteColumn(column) {
        alert('Delete ' + column);
    }
</script>
<script>
    $(document).ready(function() {
        $('.tab-pane').on('show.bs.tab', function(e) {
            var tabId = $(e.target).attr('id').replace('content', '');
            $('#addDataButton').data('tab-index', tabId);
        });

        $('#addDataButton').on('click', function() {
            var tabIndex = $(this).data('tab-index');
            var activeTabData = data[tabIndex];
            console.log(activeTabData);
        });
    });
</script>
@endsection