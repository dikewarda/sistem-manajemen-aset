@extends('layout.main')
@section('title', 'Health Index Calculator')
@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Health Index Calculator</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Admin</li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Health Index Calculator</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-6">
                <!-- Oil Quality Factor -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Oil Quality Factor<span> (click field to input value)</span></h5>
                        <div class="col-12">
                            <div class="form-floating">
                                <select class="form-select mb-3" id="floatingSelect" aria-label="Floating label select example">
                                    <option selected>Open to select formula</option>
                                    @foreach ($formulas as $formula)
                                    <option value="{{ $formula->formula }}">{{ $formula->name }}</option>
                                    @endforeach
                                </select>
                                <label for="floatingSelect">Formula</label>
                            </div>
                        </div>

                        <form class="row g-3" id="calculateForm" action="{{ route('calculate.oil.factors')}}" method="POST">
                            @csrf
                            <div id="parametersSection"></div>
                            <div id="resultSection" class="mt-0"></div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form>

                    </div>
                </div>

                <!-- DGA -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Dissolved Gas Analysis<span> (click field to input value)</span></h5>

                        <!-- Vertical Form -->
                        <form class="row g-3">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="acethylene" name="acethylene" placeholder="Input Here ..">
                                    <label for="acethylene" class="form-label">ACETHYLENE</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="carbon_dioxida" name="carbon_dioxida" placeholder="Input Here ..">
                                    <label for="carbon_dioxida" class="form-label">CARBON DIOXIDA</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="carbon_monoxida" name="carbon_monoxida" placeholder="Input Here ..">
                                    <label for="carbon_monoxida" class="form-label">CARBON MONOXIDA</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="ethane" name="ethane" placeholder="Input Here ..">
                                    <label for="ethane" class="form-label">ETHANE</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="ethylene" name="ethylene" placeholder="Input Here ..">
                                    <label for="ethylene" class="form-label">ETHYLENE</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="hidrogen" name="hidrogen" placeholder="Input Here ..">
                                    <label for="hidrogen" class="form-label">HIDROGEN</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="methane" name="methane" placeholder="Input Here ..">
                                    <label for="methane" class="form-label">METHANE</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="nitrogen" name="nitrogen" placeholder="Input Here ..">
                                    <label for="nitrogen" class="form-label">NITROGEN</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="oksigen" name="oksigen" placeholder="Input Here ..">
                                    <label for="oksigen" class="form-label">OKSIGEN</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="tdcg" name="tdcg" placeholder="Input Here ..">
                                    <label for="tdcg" class="form-label">TDCG</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="result" name="result" placeholder="Input Here ..">
                                    <label for="result" class="form-label">Result</label>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form><!-- Vertical Form -->

                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <!-- Paper Condition Factor -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Paper Condition Factor<span> (click field to input value)</span></h5>

                        <!-- Vertical Form -->
                        <form class="row g-3">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="age" name="age" placeholder="Input Here ..">
                                    <label for="age" class="form-label">Age (year)</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="dpest" name="dpest" placeholder="Input Here ..">
                                    <label for="dpest" class="form-label">DP estimated (2FAL)</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="co" name="co" placeholder="Input Here ..">
                                    <label for="co" class="form-label">CO (ppm)</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="co2" name="co2" placeholder="Input Here ..">
                                    <label for="co2" class="form-label">CO2 (ppm)</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="co2/co" name="co2/co" placeholder="Input Here ..">
                                    <label for="co2/co" class="form-label">CO2/CO</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="result" name="result" placeholder="Input Here ..">
                                    <label for="result" class="form-label">Result</label>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form><!-- Vertical Form -->

                    </div>
                </div>

                <!-- Final Health Index -->
            </div>
        </div>
        </div>
    </section>

</main>

<script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#calculateForm').hide();

        $('#floatingSelect').change(function() {
            var selectedFormula = $(this).val();
            $.ajax({
                type: "POST",
                url: "{{ url('select-formula') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    selectFormula: selectedFormula,
                },
                success: function(response) {
                    $('#parametersSection').html(response);
                    $('#calculateForm').show();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('calculateForm');

        form.addEventListener('submit', function(event) {
            event.preventDefault();

            fetch(form.action, {
                    method: form.method,
                    body: new FormData(form)
                })
                .then(response => response.text()) // Mengambil teks dari respons
                .then(html => {
                    document.getElementById('resultSection').innerHTML = html;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    });
</script>
@endsection