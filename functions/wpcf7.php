<?php 
// Add this script to footer.php to handle redirections after successful form submissions 
// using Contact Form 7's 'wpcf7mailsent' event.

<script>
  document.addEventListener('wpcf7mailsent', function(event) {
    
    // Redirect after form submission
    if (event.detail.contactFormId === 'CF7_FORM_ID') {
      location.href = '<?php echo get_permalink(PAGE_ID); ?>';
    }

  }, false);
</script>

//Remove <p> Tag From Contact Form 7
add_filter('wpcf7_autop_or_not', '__return_false');

?>
