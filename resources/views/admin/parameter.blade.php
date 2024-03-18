@extends('layout.main')
@section('title', 'Parameter')
@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Parameter</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Admin</li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Parameter</li>
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

                        <form class="row g-3" action="{{ route('calculate.oil.factors')}}" method="POST">
                            @csrf
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="bdv" name="bdv" placeholder="input here .." require>
                                    <label for="bdv" class="form-label">Break Down Voltage (kV)</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="waterContent" name="waterContent" placeholder="input here .." require>
                                    <label for="waterContent" class="form-label">Water Content (ppm)</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="acidity" name="acidity" placeholder="input here .." require>
                                    <label for="acidity" class="form-label">Acidity (MgKOH/mg)</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="tension" name="tension" placeholder="input here .." require>
                                    <label for="tension" class="form-label">Interfacial Tension (Dyne/cm)</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="colorScale" name="colorScale" placeholder="input here .." require>
                                    <label for="colorScale" class="form-label">Color Scale</label>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
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
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
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
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
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
@endsection