@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">Seguimiento</div>
                <div class="card-body">
                    <form method="POST" class="form-register" action="{{ route('seguimiento.index') }}">
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

                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">Estado</label>

                            <div class="col-md-6">
                                <select id="status" type="status" class="form-control @error('status') is-invalid @enderror" name="status" >
                                	<option value="">Elegir estado</option>
                                	@foreach ($statuses as $status)
                                	<option value="{{$status->id}}">{{$status->name}}</option>
                                	@endforeach
                                </select>

                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="reference" class="col-md-4 col-form-label text-md-right">Referencia</label>

                            <div class="col-md-6">
                                <input id="reference" type="reference" class="form-control @error('reference') is-invalid @enderror" name="reference" required autocomplete="current-reference">

                                @error('reference')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Registrar
                                </button>
                            </div>
                        </div>
                    </form>
                    <form method="POST" class="form-update" style="display: none;" action="{{ route('seguimiento.update') }}">
                        @csrf
                        <input id="upidtracking" type="text" hidden name="tracking_id" value="">
                        <div class="form-group row">
                            <label for="number" class="col-md-4 col-form-label text-md-right">Nro.:</label>

                            <div class="col-md-6">
                                <input id="upnumber" type="number" class="form-control @error('number') is-invalid @enderror" name="number" value="{{ old('number') }}" required autocomplete="number" autofocus>

                                @error('number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">Estado</label>

                            <div class="col-md-6">
                                <select id="upstatus" type="status" class="form-control @error('status') is-invalid @enderror" name="status" >
                                    <option value="">Elegir estado</option>
                                    @foreach ($statuses as $status)
                                    <option value="{{$status->id}}">{{$status->name}}</option>
                                    @endforeach
                                </select>

                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="reference" class="col-md-4 col-form-label text-md-right">Referencia</label>

                            <div class="col-md-6">
                                <input id="upreference" type="reference" class="form-control @error('reference') is-invalid @enderror" name="reference" required autocomplete="current-reference">

                                @error('reference')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="button" class="btn btn-secondary btn-cancel-edit">
                                    Cancelar
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    Actualizar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Listado de Seguimiento</div>
                <div class="card-body">
                	@if ($trackings->count())
                	<ul class="list-inline tracking-list">
                		@foreach ($trackings as $tracking)
            			<li class="item my-3 bg-light px-3 py-2" data-number="{{$tracking->number}}" data-reference="{{$tracking->reference}}" data-id="{{$tracking->id}}">
                            <p class="mb-0"><span class="tr-number">{{$tracking->number}}</span> <button class="btn btn-primary btn-sm float-right" type="button">Modificar</button></p>
                            <p class="mb-0">Estados:</p>
                            <ul class="list-inline row">
                                @foreach ($tracking->statuses as $istatus)
                                    <li class="col"><span class="badge badge-success px-4">{{$istatus->name}}</span></li>
                                @endforeach
                            </ul>
                        </li>
                		@endforeach
                	</ul>
                	@else
                	<p class="text-muted mb-0">No hay seguimientos.</p>
                	@endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="modalChangeStatus">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cambiar estado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <p class="text my-3 body-title">¿Seguro desea actualizar el estado de <strong></strong>"?</p>
        <select id="mstatus" type="status" class="form-control @error('status') is-invalid @enderror" name="status" required="">
            <option value="">Elegir estado</option>
            @foreach ($statuses as $status)
            <option value="{{$status->id}}" data-code="{{$status->code}}">{{$status->name}}</option>
            @endforeach
        </select>
      </div>
      <div class="modal-footer justify-content-center">
        <button class="btn btn-secondary" data-dismiss="modal" type="button">Cancelar</button>
        <button class="btn btn-primary btn-confirm" data-dismiss="modal" type="button" data-id=""><i class="fal fa-trash"></i> Actualizar</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>
    $('.tracking-list .btn').click(function (event) {
        var item = $(this).closest('.item');
        var number = item.data('number');
        var reference = item.data('reference');
        var id = item.data('id');
        //$('#modalChangeStatus .body-title strong').text(number);
        //$('.btn-confirm').data('id', $(this).data('id'));
        $('.form-register').hide();
        $('.form-update').show();
        $('.form-update #upnumber').val(number);
        $('.form-update #upreference').val(reference);
        $('.form-update #upidtracking').val(id);
    })
    $('.btn-confirm').on('click', function (event) {
      if($('#mstatus').val().length && $(this).data('id').length) {

      }
    })

    $('.btn-cancel-edit').on('click', function (event) {
        $('.form-register').show();
        $('.form-update').hide();
        $('.form-update input').val('');
        $('.form-update select').val('');
    })

    /*$('.btn-confirm').click(function(event) {
        event.preventDefault();
        var btn = $(this);
        if (btn.data('id').length == 0 || $('#mstatus').val().length) {
            return;
        }
        $.ajax({
            type: "post",
            url: "/ordenes/" + btn.data('otid') + "/eliminar",
            data: {
                _token: '{{csrf_token()}}',
            },
            beforeSend: function(data) {

            },
            success: function(response) {
                if (response.success) {
                    var data = $.parseJSON(response.data);
                    if (data.enabled == 0) {
                        enabledots.ajax.reload();
                        disapprovedots.ajax.reload();
                        $('#modalDelOT').modal('hide');
                    }
                }
            },
            error: function(request, status, error) {
                var data = jQuery.parseJSON(request.responseText);
                console.log(data);
            }
        });
    })*/
</script>
{{-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script>
    var dLanguage = {
      "sProcessing":     "Procesando...",
      "sLengthMenu":     "Mostrar _MENU_ registros",
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ningún dato disponible en esta tabla",
      "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix":    "",
      "sSearch":         "Buscar:",
      "sUrl":            "",
      "sInfoThousands":  ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
    }
    $('#tablas').DataTable({
      language: dLanguage
    });
</script> --}}
@endsection