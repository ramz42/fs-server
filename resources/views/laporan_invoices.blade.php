{{-- form input --}}
<div class="row justify-content-center d-md-flex h-100" style="padding: 5%">
    <hr>
    <div style="padding: 2%">
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th scope="col" style="text-align: center">No</th>
                    <th scope="col" style="text-align: center">Tanggal</th>
                    <th scope="col" style="text-align: center">No Invoice</th>
                    <th scope="col" style="text-align: center">Code</th>
                    <th scope="col" style="text-align: center">Paket</th>
                    <th scope="col" style="text-align: center">Customer</th>
                    <th scope="col" style="text-align: center">Email</th>
                    <th scope="col" style="text-align: center">No Telp</th>
                    <th scope="col" style="text-align: center">Harga</th>
                    <th scope="col" style="text-align: center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row" style="text-align: center">1</th>
                    <td style="text-align: center">Mark</td>
                    <td style="text-align: center">Mark</td>
                    <td style="text-align: center">Mark</td>
                    <td style="text-align: center">Mark</td>
                    <td style="text-align: center">Mark</td>
                    <td style="text-align: center">Mark</td>
                    <td style="text-align: center">Mark</td>
                    <td style="text-align: center">Mark</td>
                    <td style="text-align: center"><svg type="button" data-bs-toggle="modal"
                            data-bs-target="#exampleModal" xmlns="http://www.w3.org/2000/svg" width="16"
                            height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                            <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1" />
                            <path
                                d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1" />
                        </svg></td>
                </tr>
                <tr>
                    <th scope="row" style="text-align: center">2</th>
                    <td style="text-align: center">Mark</td>
                    <td style="text-align: center">Mark</td>
                    <td style="text-align: center">Mark</td>
                    <td style="text-align: center">Mark</td>
                    <td style="text-align: center">Mark</td>
                    <td style="text-align: center">Mark</td>
                    <td style="text-align: center">Mark</td>
                    <td style="text-align: center">Mark</td>
                    <td style="text-align: center"><svg type="button" data-bs-toggle="modal"
                            data-bs-target="#exampleModal" xmlns="http://www.w3.org/2000/svg" width="16"
                            height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                            <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1" />
                            <path
                                d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1" />
                        </svg></td>
                </tr>
                <tr>
                <tr>
                    <th scope="row"></th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="font-weight: bold; text-align: center">Total</td>
                    <td style="font-weight: bold; font-style:italic; text-align: center">@Total Harga</td>
                </tr>
                </tr>
            </tbody>
        </table>
    </div>
    <hr>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Invoice</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div style="padding: 4%;">Ingin Print Invoice Ini ?</div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button> --}}
                    <button type="button" class="btn btn-secondary">Print</button>
                </div>
            </div>
        </div>
    </div>
</div>
