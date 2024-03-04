<footer class="footer"> © 2019-<?php echo date('Y');?> Doj. All rights reserved.</footer>
<!-- Include SweetAlert library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- Reusable JavaScript function for SweetAlert confirmation -->
<script>
  function showConfirmation(message, callback) {
    Swal.fire({
      title: 'Are you sure?',
      text: message,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        // Call the callback function if confirmation is true
        callback();
      }
    });
  }
</script>
<script>
    // Fade out all alert messages after 2 seconds
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 2000);
</script>