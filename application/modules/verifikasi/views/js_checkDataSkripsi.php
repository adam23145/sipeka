<script src="https://unpkg.com/quagga/dist/quagga.min.js"></script>
<script type="text/javascript">
    $('#startScanner').click(function() {
        $('#scannerContainer').show();
        Quagga.init({
            inputStream: {
                name: "Live",
                type: "LiveStream",
                target: document.querySelector('#scanner'),
            },
            decoder: {
                readers: ["code_128_reader", "ean_reader", "ean_8_reader", "upc_reader", "upc_e_reader", "code_39_reader"]
            }
        }, function(err) {
            if (err) {
                console.error(err);
                $('#result').html('<div class="alert alert-danger">Terjadi kesalahan dalam memulai pemindai: ' + err.message + '</div>');
                return;
            }
            Quagga.start();
        });

        Quagga.onDetected(function(data) {
            $('#barcode').val(data.codeResult.code);
            $('#barcodeForm').submit();
            Quagga.stop();
            $('#scannerContainer').hide();
        });
    });
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
</script>