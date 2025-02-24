<?php 
// Add this script to footer.php to handle redirections after successful form submissions 
// using Contact Form 7's 'wpcf7mailsent' event.

<script>
  document.addEventListener('wpcf7mailsent', function(event) {
    
    // Redirect after form submission
    if (event.detail.contactFormId == 'CF7_FORM_ID') {
      location.href = '<?php echo get_permalink(PAGE_ID); ?>';
    }

  }, false);
</script>

?>
