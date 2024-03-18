@extends('layout.main')
@section('title', 'Data Trafo')
@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Data Trafo</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Admin</li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Data Trafo</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Trafo<span> (click field to input value)</span></h5>

                        <form class="row g-3" action="{{ route('calculate.oil.factors')}}" method="POST">
                            @csrf
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="TRF" name="TRF" placeholder="input here .." require>
                                    <label for="TRF" class="form-label">Trafo ID</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="pembangkit" name="pembangkit" placeholder="input here .." require>
                                    <label for="pembangkit" class="form-label">Pembangkit</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="manufacturer" name="manufacturer" placeholder="input here .." require>
                                    <label for="manufacturer" class="form-label">Manufacturer</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="serialNumber" name="serialNumber" placeholder="input here .." require>
                                    <label for="serialNumber" class="form-label">Serial Number</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="tahunOperasi" name="tahunOperasi" placeholder="input here .." require>
                                    <label for="tahunOperasi" class="form-label">Tahun Operasi</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="ratingDaya" name="ratingDaya" placeholder="Input Here ..">
                                    <label for="ratingDaya" class="form-label">Rating Daya (MVA)</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="voltageClass" name="voltageClass" placeholder="Input Here ..">
                                    <label for="voltageClass" class="form-label">Voltage Class</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="oilBrand" name="oilBrand" placeholder="Input Here ..">
                                    <label for="oilBrand" class="form-label">Oil Brand</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="samplePoint" name="samplePoint" placeholder="Input Here ..">
                                    <label for="samplePoint" class="form-label">Sample Point</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="tanggalSampling" name="tanggalSampling" placeholder="Input Here ..">
                                    <label for="tanggalSampling" class="form-label">Tanggal Sampling</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="labPengujian" name="labPengujian" placeholder="Input Here ..">
                                    <label for="labPengujian" class="form-label">Lab Pengujian</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="inhibitedUnhibited" name="inhibitedUnhibited" placeholder="Input Here ..">
                                    <label for="inhibitedUnhibited" class="form-label">Inhibited/Unhibited</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="kraftTUP" name="kraftTUP" placeholder="Input Here ..">
                                    <label for="kraftTUP" class="form-label">Kraft/TUP</label>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

</main>
@endsection