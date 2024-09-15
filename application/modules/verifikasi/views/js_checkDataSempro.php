<script src="https://unpkg.com/quagga/dist/quagga.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

        $('#barcodeForm').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: baseURL + 'verifikasi/Verifikasisempro/check_barcode',
                type: 'POST',
                data: formData,
                success: function(response) {
                    $('#result').html(response);
                },
                error: function(xhr, status, error) {
                    $('#result').html('<div class="alert alert-danger">Terjadi kesalahan: ' + error + '</div>');
                }
            });
        });
    });
</script>