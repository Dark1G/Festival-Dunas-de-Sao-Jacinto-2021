@extends('admin.layouts.admin')

@section('styles')
    <link href="/dashboard/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">{{ $sessao->evento->nome }} - Dia {{ $sessao->dia }}</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>E-mail</th>
                        <th>BI/CC ou Passaporte</th>
                        <th>Acompanhante</th>
                        <th>Check-in</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>E-mail</th>
                        <th>BI/CC ou Passaporte</th>
                        <th>Acompanhante</th>
                        <th>Check-in</th>
                    </tr>
                </tfoot>
                <tbody>                 
                    @foreach($inscritos as $inscrito)
                    <tr>
                        <td>{{ $inscrito->nome }}</td>
                        <td>{{ $inscrito->email }}</td>
                        <td>{{ $inscrito->documento_id }}</td>
                        <td>{{ $inscrito->acompanhante()->wherePivot('sessao_id', $sessao->id)->pluck('nome')->join(',') }}</td>
                        <td>
                            <div class="form-check text-center">
                                <input data-action="{{ route('update.incritos', ['sessao' => $inscrito->pivot->sessao_id, 'inscrito' => $inscrito->id]) }}" class="form-check-input form-check-session" type="checkbox" {{$inscrito->pivot->checkin ? 'checked' : ''  }} id="flexCheckChecked">
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="/dashboard/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/dashboard/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/dashboard/js/demo/datatables-demo.js"></script>
@endsection