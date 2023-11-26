<div>
    <div class="card mb-4 shadow rounded-lg ">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="input-group">
                        <input type="text" id="table-search" class="form-control bg-light" placeholder="Cari"
                            aria-label="cari data" aria-describedby="button-cari">
                        <button id="table-search-clear-button" class="btn btn-outline-secondary" type="button">
                            <i class="fas fa-times"></i>
                        </button>
                        <button id="table-search-button" class="btn btn-success" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                @if (!$nofilter)
                    <div class="col-2">
                        <button class="btn btn-outline-primary btn-block" data-toggle="modal"
                            data-target="#exampleModal"><i class="fas fa-filter"></i> Filter @if (isset($filter_counter) > 0)
                                <span class="badge bg-info">{{ $filter_counter }}</span>
                            @endif
                        </button>
                    </div>
                @endif
            </div>

            @if (!$nofilter)
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <x-form>
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Filter</h5>
                                    <button type="button" class="btn-close" data-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{ $filter_content }}
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
            @endif
        </div>
    </div>
    <x-card>
        <div class="table-responsive">
            <div class="d-flex justify-content-center" id="table-loading">
                <div class="spinner-border" role="status" style="position:absolute;margin-top:105px">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <table id="myTable" class="display table table-striped table-hover" style="width:100%">
                {{ $table_content }}
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
