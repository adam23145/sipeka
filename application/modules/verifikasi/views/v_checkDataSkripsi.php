<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4>Verifikasi Data Skripsi</h4>
        </div>
        <div class="card-body">
            <form id="barcodeForm" method="POST">
                <input type="hidden" name="token" id="token" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <div class="form-group">
                    <label for="barcode">Barcode:</label>
                    <input type="text" id="barcode" name="barcode" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Check</button>
                <button type="button" id="startScanButton" class="btn btn-secondary">Start Scanner</button>
            </form>
            <br></br>
            <div id="result" class="mt-3"></div>
            <script src="<?php echo base_url();?>public/qrScript.js"></script>
            <div style="text-align: center;">
                <div id="reader" style="width: 500px; display: none;"></div>
                <script>
                    const html5Qrcode = new Html5Qrcode('reader');

                    const qrCodeSuccessCallback = (decodedText, decodedResult) => {
                        if (decodedText) {
                            // Masukkan hasil pemindaian ke input teks
                            document.getElementById('barcode').value = decodedText;
                            Swal.fire({
                                title: 'Scanned Result',
                                text: decodedText,
                                confirmButtonText: 'OK'
                            });
                            html5Qrcode.stop();
                        }
                    };

                    const config = {
                        fps: 10,
                        qrbox: {
                            width: 250,
                            height: 250
                        }
                    };

                    document.getElementById('startScanButton').addEventListener('click', () => {
                        document.getElementById('reader').style.display = 'block';
                        html5Qrcode.start({
                                facingMode: "environment"
                            }, config, qrCodeSuccessCallback)
                            .catch((err) => {
                                Swal.fire({
                                    title: 'Error',
                                    text: `Failed to start scanning: ${err}`,
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            });
                    });
                </script>
            </div>
        </div>
    </div>
</div>
