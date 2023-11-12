<div class="row">
    <div class="col-12">
        <x-card>
            <div class="row">
                <div class="col">
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
                <div class="col-2">
                    <button class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#exampleModal"><i
                            class="fas fa-filter"></i> Filter Laporan @if ($filter_counter > 0)
                            <span class="badge bg-info">{{ $filter_counter }}</span>
                        @endif
                    </button>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <x-form>
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Filter Laporan</h5>
                                    <button type="button" class="btn-close" data-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <input type="hidden" name="selected_status"
                                            value="{{ $filter['selected_status'] }}">

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
            </div>
        </x-card>
    </div>
</div>
