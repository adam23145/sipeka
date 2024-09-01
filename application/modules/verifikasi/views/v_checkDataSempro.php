<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4>Verifikasi Data Sempro</h4>
        </div>
        <div class="card-body">
            <form id="barcodeForm" method="POST">
                <input type="hidden" name="token" id="token" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <div class="form-group">
                    <label for="barcode">Barcode:</label>
                    <input type="text" id="barcode" name="barcode" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Check</button>
                <button type="button" id="startScanner" class="btn btn-secondary">Start Scanner</button>
            </form>
            <div id="result" class="mt-3"></div>
            <div id="scannerContainer" class="mt-3" style="display:none;">
                <div id="scanner" style="width:100%; border:1px solid #ddd;"></div>
            </div>
        </div>
    </div>
</div>