@extends('layouts.app')

@section('content')
    <div class="container mt-4">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-header">Add Pig</div>

            <div class="card-body">
                <form action="{{ route('pigs.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label>Weight (kg)</label>
                        <input type="number" name="weight" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option>Healthy</option>
                            <option>Sick</option>
                            <option>Sold</option>
                            <option>Dead</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Type</label>
                        <select name="type" class="form-control">
                            <option>Sow</option>
                            <option>Boar</option>
                            <option>Piglet</option>
                            <option>Fattening Pig</option>
                        </select>
                    </div>

                    <button class="btn btn-success">Add Pig</button>
                </form>
            </div>
        </div>
    </div>
@endsection
