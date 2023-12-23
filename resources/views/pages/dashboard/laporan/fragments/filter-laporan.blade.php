<div class="row">
    <div class="col-12">
        <x-card>
            <div class="row">
                <div class="col-8">
                    <div class="input-group">
                        <input type="text" id="laporan-search" class="form-control bg-light" placeholder="Cari laporan"
                            aria-label="cari laporan" aria-describedby="button-cari-laporan">
                        <button id="laporan-clear-search-button" class="btn btn-outline-secondary" type="button">
                            <i class="fas fa-times"></i>
                        </button>
                        <button id="laporan-search-button" class="btn btn-success" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <div class="col">
                    <div class="d-inline-flex">
                        <button class="btn btn-outline-primary mr-2" data-toggle="modal" data-target="#modalFilter"><i
                                class="fas fa-filter"></i> Filter Laporan @if ($filter_counter > 0)
                                <span class="badge bg-info">{{ $filter_counter }}</span>
                            @endif
                        </button>
                        <button class="btn btn-outline-primary" data-toggle="modal" data-target="#modalDownload"><i
                                class="fas fa-file-excel"></i> Download Laporan
                        </button>
                    </div>
                </div>

                <!-- Modal Filter -->
                <div class="modal fade" id="modalFilter" tabindex="-1" aria-labelledby="modalFilterLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <x-form>
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalFilterLabel">Filter Laporan</h5>
                                    <button type="button" class="btn-close" data-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <input type="hidden" name="selected_status"
                                            value="{{ $filter['selected_status'] }}">
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="status-jalan" class="form-label">Tahun Laporan</label>
                                                <select class="form-control mb-2 mr-sm-2" name="selected_year">
                                                    @foreach ($list_of_data['years'] as $year)
                                                        <option
                                                            {{ $year['value'] == $filter['selected_year'] ? 'selected' : '' }}
                                                            value="{{ $year['value'] }}">
                                                            {{ $year['label'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label for="status-jalan" class="form-label">Bulan Laporan</label>
                                                <select class="form-control mb-2 mr-sm-2" name="selected_month">
                                                    @foreach ($list_of_data['months'] as $month)
                                                        <option
                                                            {{ $month['value'] == $filter['selected_month'] ? 'selected' : '' }}
                                                            value="{{ $month['value'] }}">
                                                            {{ $month['label'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="kasus-jalan" class="form-label">Kasus Jalan</label>
                                        <select class="form-control mb-2 mr-sm-2" name="selected_kasus">
                                            @foreach ($list_of_data['types'] as $kasus)
                                                <option
                                                    {{ $kasus['value'] == $filter['selected_kasus'] ? 'selected' : '' }}
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
                                    <button type="button" class="btn btn-outline-secondary"
                                        data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </div>
                        </x-form>
                    </div>
                </div>

                <!-- Modal Download -->
                <div class="modal fade" id="modalDownload" tabindex="-1" aria-labelledby="modalDownloadLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <x-form action="laporan/download" method="get">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalDownloadLabel">Download Laporan</h5>
                                    <button type="button" class="btn-close" data-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <input type="hidden" name="selected_status"
                                            value="{{ $filter['selected_status'] }}">

                                        <div class="row">
                                            <div class="col-6">
                                                <label for="status-jalan" class="form-label">Tahun Laporan</label>
                                                <select class="form-control mb-2 mr-sm-2" name="selected_year">
                                                    @foreach ($list_of_data['years'] as $year)
                                                        <option
                                                            {{ $year['value'] == $filter['selected_year'] ? 'selected' : '' }}
                                                            value="{{ $year['value'] }}">
                                                            {{ $year['label'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label for="status-jalan" class="form-label">Bulan Laporan</label>
                                                <select class="form-control mb-2 mr-sm-2" name="selected_month">
                                                    @foreach ($list_of_data['months'] as $month)
                                                        <option
                                                            {{ $month['value'] == $filter['selected_month'] ? 'selected' : '' }}
                                                            value="{{ $month['value'] }}">
                                                            {{ $month['label'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="kasus-jalan" class="form-label">Kasus Jalan</label>
                                        <select class="form-control mb-2 mr-sm-2" name="selected_kasus">
                                            @foreach ($list_of_data['types'] as $kasus)
                                                <option
                                                    {{ $kasus['value'] == $filter['selected_kasus'] ? 'selected' : '' }}
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
                                    <div class="mb-3">
                                        <div class="form-check form-switch" style="margin-left:1em" >
                                            <input class="form-check-input" type="checkbox" role="switch" name="with_image" id="with_image" checked>
                                            <label class="form-check-label" for="with_image">Sertakan Gambar</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary"
                                        data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary"><i
                                class="fas fa-file-excel"></i> Download</button>
                                </div>
                            </div>
                        </x-form>
                    </div>
                </div>
            </div>
        </x-card>
    </div>
</div>
