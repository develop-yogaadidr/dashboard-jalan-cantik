<div class="table-responsive">
    <div class="d-flex justify-content-center" id="table-loading">
        <div class="spinner-border" role="status" style="position:absolute;margin-top:105px">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <div class="form-row align-items-center">
        <div class="col-auto">
            <label class="sr-only" for="table-search">Name</label>
            <input type="text" class="form-control mb-2" id="table-search" placeholder="Cari">
        </div>
        <div id="table-button-container" class="col-auto">
            <button type="button" id="table-search-button" class="btn btn-primary mb-2"><i class="fas fa-fw fa-search"></i> Cari</button>
            <button type="button" id="table-detail-button" class="btn btn-info mb-2 table-action-button" disabled
                style="display:none"><i class="fas fa-fw fa-eye"></i> Detail</button>
        </div>
    </div>
    <table id="{{ $id }}" class="display table table-striped table-hover" style="width:100%">
        {{ $slot }}
    </table>

    <div id="table-pagination">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><button class="page-link ">Previous</button></li>
                <li class="page-item"><button class="page-link ">...</button></li>
                <li class="page-item"><button class="page-link ">Next</button></li>
            </ul>
        </nav>
    </div>
</div>
