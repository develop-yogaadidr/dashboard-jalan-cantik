@extends('layouts.app')

@section('content')
    <div class="container pt-5 pb-5">
        <div class="title text-center mb-5">
            <h2>{{ $title }}</h2>
        </div>
        <x-card>
            <div class="row">
                <div class="col">
                    <div class="input-group">
                        <input type="text" id="table-search" class="form-control bg-light" placeholder="Cari laporan"
                            aria-label="cari laporan" aria-describedby="button-cari-laporan">
                        <button id="table-search-clear-button" class="btn btn-outline-secondary" type="button">
                            <i class="fas fa-times"></i>
                        </button>
                        <button id="table-search-button" class="btn btn-success" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <div class="col-2">
                    <button class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#exampleModal"><i
                            class="fas fa-filter"></i> Filter Laporan @if (isset($filter_counter) > 0)
                            <span class="badge bg-info">{{ $filter_counter }}</span>
                        @endif
                    </button>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <x-form>
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Filter Laporan</h5>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="status-jalan" class="form-label">Tahun Laporan</label>
                                    <select class="form-control mb-2 mr-sm-2" name="selected_year">
                                        @foreach ($list_of_data['years'] as $year)
                                            <option {{ $year['value'] == $filter['selected_year'] ? 'selected' : '' }}
                                                value="{{ $year['value'] }}">
                                                {{ $year['label'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Status Laporan</label>
                                    <select class="form-control mb-2 mr-sm-2" name="selected_status">
                                        @foreach ($list_of_data['statuses'] as $year)
                                            <option {{ $year['value'] == $filter['selected_status'] ? 'selected' : '' }}
                                                value="{{ $year['value'] }}">
                                                {{ $year['label'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="kasus-jalan" class="form-label">Kasus Jalan</label>
                                    <select class="form-control mb-2 mr-sm-2" name="selected_kasus">
                                        @foreach ($list_of_data['types'] as $kasus)
                                            <option {{ $kasus['value'] == $filter['selected_kasus'] ? 'selected' : '' }}
                                                value="{{ $kasus['value'] }}">
                                                {{ $kasus['label'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="status-jalan" class="form-label">Status Jalan</label>
                                    <select class="form-control mb-2 mr-sm-2" name="selected_status_jalan">
                                        @foreach ($list_of_data['status_jalan'] as $status_jalan)
                                            <option
                                                {{ $status_jalan['value'] == $filter['selected_status_jalan'] ? 'selected' : '' }}
                                                value="{{ $status_jalan['value'] }}">
                                                {{ $status_jalan['label'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="kota-kabupaten" class="form-label">BPJ</label>
                                    <select class="form-control mb-2 mr-sm-2" name="selected_wilayah">
                                        <option value="all">Semua BPJ</option>
                                        @foreach ($list_of_data['wilayah'] as $wilayah)
                                            <option {{ $wilayah->id == $filter['selected_wilayah'] ? 'selected' : '' }}
                                                value="{{ $wilayah->id }}">
                                                {{ $wilayah->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="kota-kabupaten" class="form-label">Kota / Kabupaten</label>
                                    <select class="form-control mb-2 mr-sm-2" name="selected_city">
                                        <option value="all">Semua Kota/Kabupaten</option>
                                        @foreach ($list_of_data['cities'] as $city)
                                            <option {{ $city->id == $filter['selected_city'] ? 'selected' : '' }}
                                                value="{{ $city->id }}">
                                                {{ $city->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </x-form>
                </div>
            </div>
        </x-card>

        <x-card title="Daftar Laporan">
            <div class="table-responsive">
                <div class="d-flex justify-content-center" id="table-loading">
                    <div class="spinner-border" role="status" style="position:absolute;margin-top:105px">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <table id="myTable" class="display table table-striped table-hover" style="width:100%">
                    <thead>
                        <th>No</th>
                        <th>Pelapor</th>
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>Kab/Kota</th>
                        <th>Status</th>
                        <th>Detail</th>
                    </thead>
                    <tbody></tbody>
                </table>
                <div class="row">
                    <div class="col" id="table-pagination">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item"><button class="page-link ">Previous</button></li>
                                <li class="page-item"><button class="page-link ">...</button></li>
                                <li class="page-item"><button class="page-link ">Next</button></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col text-right" id="table-information">
                    </div>
                </div>
            </div>
        </x-card>
    </div>
    <script>
        $(document).ready(function() {
            
        })
    </script>
@endsection
