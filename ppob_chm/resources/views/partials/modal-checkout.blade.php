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

              <!-- Hidden input untuk identifikasi jenis layanan -->
              <input type="hidden" id="jenisLayanan" name="jenisLayanan" value="pulsa">

              <div class="d-grid mt-4">
                  <button type="button" class="btn btn-success" id="btnBayarModal">Bayar</button>
              </div>
          </div>
      </div>
  </div>
</div>


<!-- Script untuk menangani tombol Bayar -->
<script>
 document.getElementById('btnBayarModal')?.addEventListener('click', function () {
    const form = document.getElementById('formPembelian');
    if (!form) return alert('Form tidak ditemukan');

    const jenisLayanan = document.getElementById('jenisLayanan')?.value;

    if (jenisLayanan === 'paket') {
        form.action = "{{ route('pembelian.paket.store') }}";
    } else {
        form.action = "{{ route('pembelian.pulsa.store') }}";
    }

    form.submit();
});

  </script>
  
