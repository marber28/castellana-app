@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">Buscar Seguimiento</div>
                <div class="card-body">
                    <form id="search" method="POST" action="{{ route('search') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="number" class="col-md-4 col-form-label text-md-right">Nro.:</label>

                            <div class="col-md-6">
                                <input id="number" type="number" class="form-control @error('number') is-invalid @enderror" name="number" value="{{ old('number') }}" required autocomplete="number" autofocus>

                                @error('number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Buscar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Datos de Seguimiento</div>
                <div class="card-body">
                    @if ($tracking)
                	<div class="result">
                        {{$tracking->number}}
                        <ul class="list-inline row">
                            @foreach ($tracking->statuses as $istatus)
                            <li class="col"><span class="badge badge-success px-4">{{$istatus->name}}</span></li>
                            @endforeach
                        </ul>
                    </div>
                    @else
                	<p class="text-muted mb-0 not-results">No se encontró seguimiento.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
