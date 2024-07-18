<script type="text/javascript">
    $(document).ready(function() {
        $('#form-submtitle').submit(function(e) {
            e.preventDefault(); // Prevent the form from submitting traditionally

            $.ajax({
                url: "<?php echo site_url('form/form_publikasi/submit'); ?>",
                method: "POST",
                data: $(this).serialize(), // Serialize form data correctly
                dataType: 'json', // Expect JSON response from server
                success: function(data) {
                    if (data.status) {
                        alert('Data berhasil disimpan'); // Show success message

                        // Clear the form after successful submission
                        $('#form-submtitle')[0].reset();

                        // Optionally, you can redirect or refresh the page
                        // window.location.href = 'new_page_url'; // Redirect to a new page
                        // window.location.reload(); // Refresh current page
                    } else {
                        alert('Data gagal disimpan'); // Show error message if status is false
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error); // Log any errors to the console for debugging
                    alert('Terjadi kesalahan saat menyimpan data'); // Display a generic error message
                }
            });
        });
    });
</script>
