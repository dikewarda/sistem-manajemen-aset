@extends('layout.main')
@section('title', 'Create Users')
@section('content')
    <div class="container">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex">
                <h6 class="m-0 font-weight-bold text-primary">
                    {{ __('Create Data') }}
                </h6>
                <div class="ml-auto">
                    <a href="{{ route('user.index') }}" class="btn btn-primary">
                        <span class="icon text-white-50">
                            <i class="fa fa-arrow-left"></i>
                        </span>
                        <span class="text">{{ __('Back') }}</span>
                    </a>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input class="form-control" type="text" id="name" name="name"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="nip">NIP</label>
                                <input class="form-control" type="text" id="nip" name="nip"
                                    value="{{ old('nip') }}">
                                @error('nip')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input class="form-control" type="text" id="email" name="email" autocomplete="off"
                                    value="">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="dept_id">Department</label>
                                <select name="dept_id" id="dept_id" class="form-control">
                                    <option selected disabled>Pilih</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">
                                            {{ $department->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('dept_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role_id" id="role" class="form-control">
                                    <option value="" selected disabled>Pilih</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <label for="permission">Permission</label>
                            <div class="form-group border rounded p-2">
                                @foreach ($permissions as $permission)
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input"
                                            id="permission{{ $permission->id }}" name="permission[]"
                                            value="{{ $permission->id }}">
                                        <label class="custom-control-label checkbox-label"
                                            for="permission{{ $permission->id }}">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                @endforeach
                                @error('permission')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <input class="form-control" type="password" id="password" name="password" autocomplete="new-password">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="form-group pt-4">
                        <button class="btn btn-primary" type="submit" name="submit">{{ __('Create') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection