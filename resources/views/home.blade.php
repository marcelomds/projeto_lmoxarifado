@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h2 class="m-0 text-dark">Movimentação Almoxarifado</h2>
@stop

@section('content')
    @include('sweetalert::alert')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">Últimos Registros</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <a href="{{ Route::current()->uri() }}" type="button" class="btn btn-tool">
                            <i class="fas fa-sync"></i>
                        </a>
                        <a href="{{ route('movements.exportExcel') }}" class="btn btn-info" title="Exportar Registros">
                            <i class="fas fa-file-export"></i>
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="d-flex justify-content-between m-2">
                        <div>
                            <button type="button"
                                    class="btn btn-primary"
                                    data-toggle="modal"
                                    data-target="#myModal">Novo Registro <i class="fa fa-plus"></i></button>
                        </div>

                        <div>
                            <button type="button"
                                    class="btn btn-primary"
                                    data-toggle="modal"
                                    data-target="#mySearchModal">Pesquisar <i class="fa fa-search"></i></button>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Registrar Movimentação</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('movement.store') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="collaborator_id">Colaborador:</label>
                                            <select class="form-control" id="collaborator_id" name="collaborator_id" required>
                                                <option value="" selected disabled>-- Selecione --</option>
                                                @forelse($collaborators as $collaborator)
                                                    <option value="{{ $collaborator->id }}">{{ $collaborator->name }}</option>
                                                @empty
                                                    <option value="">Não há registros</option>
                                                @endforelse
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="material_id">Material:</label>
                                            <select class="form-control" id="material_id" name="material_id" required>
                                                <option value="" selected disabled>-- Selecione --</option>
                                                @forelse($materials as $material)
                                                    <option value="{{ $material->id }}">{{ $material->name }}</option>
                                                @empty
                                                    <option value="">Não há registros</option>
                                                @endforelse
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="quantity">Quantidade:</label>
                                            <input type="number"
                                                   class="form-control"
                                                   id="quantity"
                                                   required
                                                   min="1"
                                                   name="quantity">
                                        </div>

                                        <div class="form-group">
                                            <label for="date">Data:</label>
                                            <input type="datetime-local"
                                                   class="form-control"
                                                   id="date"
                                                   required
                                                   name="date">
                                        </div>

                                        <div class="form-group">
                                            <label for="type">Tipo:</label>
                                            <select class="form-control" id="type" name="type" required>
                                                <option value="" selected disabled>-- Selecione --</option>
                                                <option value="out">Retirada</option>
                                                <option value="in">Devolução</option>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-primary">Salvar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Seacrh Modal -->
                    <div class="modal fade" id="mySearchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Filtrar Movimentação</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('home') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="collaborator_id">Colaborador:</label>
                                            <select class="form-control" id="collaborator_id" name="collaborator_id">
                                                <option value="" selected disabled>-- Selecione --</option>
                                                @forelse($collaborators as $collaborator)
                                                    <option value="{{ $collaborator->id }}">{{ $collaborator->name }}</option>
                                                @empty
                                                    <option value="">Não há registros</option>
                                                @endforelse
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="material_id">Material:</label>
                                            <select class="form-control" id="material_id" name="material_id">
                                                <option value="" selected disabled>-- Selecione --</option>
                                                @forelse($materials as $material)
                                                    <option value="{{ $material->id }}">{{ $material->name }}</option>
                                                @empty
                                                    <option value="">Não há registros</option>
                                                @endforelse
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="date_start">Data Inicial:</label>
                                            <input type="date"
                                                   class="form-control"
                                                   id="date_start"
                                                   name="date_start">
                                        </div>

                                        <div class="form-group">
                                            <label for="date_end">Data Final:</label>
                                            <input type="date"
                                                   class="form-control"
                                                   id="date_end"
                                                   name="date_end">
                                        </div>

                                        <div class="form-group">
                                            <label for="type">Tipo:</label>
                                            <select class="form-control" id="type" name="type">
                                                <option value="" selected disabled>-- Selecione --</option>
                                                <option value="out">Retirada</option>
                                                <option value="in">Devolução</option>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-primary">Pesquisar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Colaborador</th>
                                <th>Cargo</th>
                                <th>Tipo</th>
                                <th>Material</th>
                                <th>Quantidade</th>
                                <th>Data</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($stockMovements as $movement)
                                <tr>
                                    <td>{{ $movement->id }}</td>
                                    @if($movement->collaborator_is_active == 1)
                                        <td>{{ $movement->collaborator_name }}</td>
                                    @else
                                        <td>{{ $movement->collaborator_name }}
                                            <span class="badge badge-danger">Bloqueado</span>
                                        </td>
                                    @endif
                                    <td>{{ $movement->office_name }}</td>
                                    <td>
                                        @if($movement->type == 'out')
                                            <span class="badge badge-danger">Retirada</span>
                                        @else
                                            <span class="badge badge-success">Devolução</span>
                                        @endif
                                    </td>
                                    <td>{{ $movement->material_name }}</td>
                                    <td>{{ $movement->quantity }}</td>
                                    <td>{{ date('d/m/Y - H:i', strtotime($movement->date)) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">Não há registros</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@stop
