With this modification, you can now use the style attribute in your shortcode, like this:

```html
[button href="#" style="primary"]Primary Button[/button]
```

This will produce the following output:

```html
<a href="#" class="button button-primary">Primary Button</a>
```

And if you don't specify the style attribute, the button will have the default class:

```html
[button href="#" style=""]Default Button[/button]
```

This will produce:

```html
<a href="#" class="button">Default Button</a>
```

Now, you have the flexibility to add different styles to your buttons using the style attribute in the shortcode.
