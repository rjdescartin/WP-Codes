### Use this for other features like sliders and lightbox

1. Copy the CSS files and put them under the css folder in your Theme folder.
2. Copy the JS files and put them under your Theme folder's js folder.
3. Add these references to your footer.php file below the jQuery script tag.

```html
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/fancybox.css" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/slick.css" />
 
<script src="<?php bloginfo('template_url'); ?>/js/fancybox.js"></script> 
<script src="<?php bloginfo('template_url'); ?>/js/slick.min.js"></script> 
```
**REFERENCES:**

- Fancybox: https://fancyapps.com/fancybox/
- Slick Slider: https://kenwheeler.github.io/slick/
