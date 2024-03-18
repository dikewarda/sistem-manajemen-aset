@extends('layout.main')
@section('title', 'Kustom Rumus')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Users</li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div>

    <!-- Add Formula modal -->
    <div class="modal fade" id="addFormulaModal" tabindex="-1" role="dialog" aria-labelledby="addFormulaLabel" aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog modal-lg" role="document">
            <form action="{{ route('add.formula')}}" method="POST">
                <div class="modal-content">
                    <div class="modal-header p-2 px-3" style="background-color: #012970;">
                        <h5 class="modal-title text-center" id="addFormulaLabel" style="color: #fff;">Tambah Formula</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body justify-content-center p-3 mb-0">
                        @csrf
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="inputFormulaName" class="form-label">Masukkan Nama Rumus:</label>
                                <input type="text" class="form-control" name="formula_name" id="inputFormulaName" required>
                                <label for="inputName" class="form-label">Masukkan Rumus:</label>
                                <textarea class="form-control" name="formula" id="inputName" required></textarea>
                                <button class="btn btn-outline-secondary rounded-pill btn-sm px-1 py-0" type="button" id="clearInput" style="display: none;">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                            <div class="row" id="dataList">
                                @foreach($data as $key => $values)
                                <div class="col-sm-6 col-md-4">
                                    <p class="mt-2 mb-1">{{ $key }}</p>
                                    <div>
                                        @foreach($values as $value)
                                        <button type="button" class="btn btn-outline-primary btn-sm mb-1 dataItem">{{ $value }}</button>
                                        @endforeach
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary py-1 px-2 mt-3" style="background-color: #012970;">Simpan</button>
                        <button type="button" class="btn btn-secondary py-1 px-2 mt-3" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Formula Modal -->
    <div class="modal" id="editFormulaModal" tabindex="-1" aria-labelledby="editFormulaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header p-2 px-3" style="background-color: #012970;">
                    <h5 class="modal-title text-center" id="editFormulaModalLabel" style="color: #fff;">Edit Formula</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body justify-content-center p-3 mb-0">
                    <form action="{{ route('edit.formula') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-12">
                                <input type="hidden" name="formula_id" id="formulaId">
                                <label for="editFormulaName" class="form-label">Nama Rumus</label>
                                <input type="text" class="form-control" id="editFormulaName" name="edit_formula_name" required>
                                <label for="editFormula" class="form-label">Rumus</label>
                                <textarea class="form-control" id="editFormula" name="edit_formula" required></textarea>
                                <button class="btn btn-outline-secondary rounded-pill btn-sm px-1 py-0" type="button" id="clearEdit" style="display: block;">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                            <div class="row" id="dataList">
                                @foreach($data as $key => $values)
                                <div class="col-sm-6 col-md-4">
                                    <p class="mt-2 mb-1">{{ $key }}</p>
                                    <div>
                                        @foreach($values as $value)
                                        <button type="button" class="btn btn-outline-primary btn-sm mb-1 dataEdit">{{ $value }}</button>
                                        @endforeach
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary py-1 px-2 mt-3" style="background-color: #012970;">Simpan</button>
                        <button type="button" class="btn btn-secondary py-1 px-2 mt-3" data-bs-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex justify-content-between align-items-center mb-0">
                            <h5 class="card-title p-0 m-0">Daftar Formula</h5>
                            <button type="button" class="btn btn-outline-primary addButton" data-bs-toggle="modal" data-bs-target="#addFormulaModal">
                                <i class="bi bi-plus-circle"></i>
                            </button>
                        </div>
                        <!-- <h5 class="card-title"> </h5> -->
                        <ul class="list-group" id="formulaList">
                            @if ($formulas->isEmpty())
                            <p>No formulas available.</p>
                            @else
                            <ul class="list-group" id="formulaList">
                                @foreach ($formulas as $formula)
                                <li class="list-group-item d-flex justify-content-between align-items-center" onclick="fetchFormulaDetails('{{ $formula->name }}')">
                                    {{ $formula->name }}
                                    <i class="bx bxs-trash-alt delete-icon" data-formula-id="{{ $formula->id }}" style="cursor: pointer;"></i>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <div class="card" id="formulaCard" style="display: none;">
                    <div class="card-header py-0 ps-3 d-flex justify-content-between align-items-center" style="border-color: #fff;">
                        <h5 class="card-title mb-0" id="formulaTitle"></h5>
                        <i class="ri-edit-2-fill edit-icon" style="color: #000; cursor: pointer;" onclick="openEditModal('{{ $formula->id }}', '{{ $formula->name }}')"></i>
                    </div>
                    <div class="card-body">
                        <div id="formulaDetails"></div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>
<script>
    function fetchFormulaDetails(name) {
        const selectedFormula = @json($formulas->keyBy('name')->toArray())[name];

        const formulaTitle = document.getElementById('formulaTitle');
        formulaTitle.innerHTML = '';
        const formulaDetails = document.getElementById('formulaDetails');
        formulaDetails.innerHTML = '';

        if (selectedFormula) {
            formulaTitle.textContent = selectedFormula.name;
            formulaCard.style.display = 'block';
            const formulaContent = document.createElement('p');
            formulaContent.textContent = selectedFormula.formula.replace(/,/g, ' ');

            formulaDetails.appendChild(formulaContent);
        } else {
            const errorMessage = document.createElement('p');
            errorMessage.textContent = 'Formula not found.';
            formulaDetails.appendChild(errorMessage);
        }
    }
</script>
<script>
    const dataItems = document.querySelectorAll('.dataItem');
    const inputName = document.getElementById('inputName');
    const clearInputButton = document.getElementById('clearInput');

    dataItems.forEach(item => {
        item.addEventListener('click', () => {
            const value = item.textContent.trim();
            const currentValue = inputName.value.trim();
            if (currentValue !== '') {
                inputName.value = `${currentValue} ${value}`;
            } else {
                inputName.value = value;
            }
            clearInputButton.style.display = 'block';
        });
    });

    clearInputButton.addEventListener('click', () => {
        inputName.value = '';
        clearInputButton.style.display = 'none';
    });

    inputName.addEventListener('input', () => {
        clearInputButton.style.display = inputName.value.trim() !== '' ? 'block' : 'none';
    });
</script>
<script>
    function openEditModal(id, name) {
        const selectedFormula = @json($formulas->keyBy('id')->toArray())[id];

        if (selectedFormula) {
            document.getElementById('formulaId').value = id;
            document.getElementById('editFormulaName').value = name;
            document.getElementById('editFormula').value = selectedFormula.formula.replace(/,/g, ' ');

            const editFormulaModal = new bootstrap.Modal(document.getElementById('editFormulaModal'));
            editFormulaModal.show();
        } else {
            console.error('Formula not found.');
        }
    }

    const dataEdits = document.querySelectorAll('.dataEdit');
    const editFormula = document.getElementById('editFormula');
    const clearEditButton = document.getElementById('clearEdit');

    dataEdits.forEach(item => {
        item.addEventListener('click', () => {
            const value = item.textContent.trim();
            const currentValue = editFormula.value.trim();
            if (currentValue !== '') {
                editFormula.value = `${currentValue} ${value}`;
            } else {
                editFormula.value = value;
            }
        });
    });

    clearEditButton.addEventListener('click', () => {
        editFormula.value = '';
        clearEditButton.style.display = 'none';
    });

    editFormula.addEventListener('input', () => {
        clearEditButton.style.display = editFormula.value.trim() !== '' ? 'block' : 'none';
    });
</script>
<script>
    const deleteIcons = document.querySelectorAll('.delete-icon');
    deleteIcons.forEach(icon => {
        icon.addEventListener('click', function() {
            const formulaId = icon.getAttribute('data-formula-id');
            const formulaName = icon.parentElement.textContent.trim();
            if (confirm(`Apakah Anda yakin ingin menghapus formula "${formulaName}"?`)) {
                deleteFormula(formulaId);
            }
        });
    });

    function deleteFormula(formulaId) {
        fetch(`/delete-formula/${formulaId}`, {
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

@endsection