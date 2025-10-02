Default Shortcode:

```html
[accordion label="Accordion Title"]Accordion Description[/accordion]
```
Set the accordion to open by default
```html
[accordion label="Accordion Title" active="true"]Accordion Description[/accordion]
```

This will produce the following output:

```html
<button class="accordion">Accordion Title</button>
<div class="panel">
    <div class="panel-content">Accordion Description</div>
</div>
```
