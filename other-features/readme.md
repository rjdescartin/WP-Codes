1. Copy the CSS files and put it under the css folder in your Theme folder.
2. Copy the JS files and put it under the js folder in your Theme folder.
3. Add these reference to your footer.php file below the jquery script tag.

<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/fancybox.css" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/slick.css" />
 
<script src="<?php bloginfo('template_url'); ?>/js/fancybox.js"></script> 
<script src="<?php bloginfo('template_url'); ?>/js/slick.min.js"></script> 
