<!-- Modal Checkout -->
<div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded shadow-sm">
            <div class="modal-body">
                <h5 class="mb-3">
                    <i data-feather="smartphone" class="text-success me-2"></i>
                    <strong>Checkout</strong>
                </h5>

                <div class="border-top pt-3 mb-3">
                    <p class="mb-1">Jenis Layanan</p>
                    <p><strong id="modalJenis">-</strong></p>

                    <p class="mb-1">Nomor</p>
                    <p><strong id="modalNomor">-</strong></p>

                    <p class="mb-1">Harga</p>
                    <p class="text-danger fw-bold" id="modalHarga">Rp 0</p>

                    <p class="mb-1">Pembayaran</p>
                    <p><strong id="modalPembayaran">-</strong></p>
                </div>

                <h6 class="border-top pt-3 mb-2">Ringkasan Pembayaran</h6>
                <div class="d-flex justify-content-between">
                    <span>Subtotal Tagihan</span><span id="modalSubtotal">Rp 0</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Diskon</span><span>Rp 0</span>
                </div>
                <div class="d-flex justify-content-between fw-bold">
                    <span>Total Tagihan</span><span id="modalTotal">Rp 0</span>
                </div>

                <div class="d-grid mt-4">
                    <button type="button" class="btn btn-success" id="btnBayarModal">Bayar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Pembelian Berhasil -->
<div class="modal fade" id="modalBerhasil" tabindex="-1" aria-labelledby="modalBerhasilLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center p-4">
      <div class="modal-body">
        <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" fill="none" stroke="#28a745" stroke-width="4" viewBox="0 0 24 24">
          <circle cx="12" cy="12" r="10" stroke="#28a745" fill="none"/>
          <path d="M8 12l2.5 2.5L16 9" stroke="#28a745" fill="none"/>
        </svg>
        <h5 class="fw-bold mt-4">Pembelian Berhasil</h5>
        <button type="button" class="btn btn-success mt-3" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
