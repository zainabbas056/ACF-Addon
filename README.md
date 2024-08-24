# ACF Addon with Flexible Content and Repeated Fields

This WordPress plugin extends the functionality of Advanced Custom Fields (ACF) by introducing custom flexible content and repeated fields using WordPress's built-in functions. The plugin is designed to enhance content management capabilities, allowing for more dynamic and customizable layouts.

## Features

- **Flexible Content Fields**: Create dynamic content layouts with ease using flexible content fields.
- **Repeated Fields**: Add repeating groups of fields to enhance data entry and management.
- **WordPress Integration**: Leverages WordPress's built-in functions for seamless integration and performance.
- **Custom Widgets**: Extend WPBakery widgets with additional features (if applicable).

## Requirements

- WordPress 5.0 or higher
- Advanced Custom Fields (ACF) Pro
- WPBakery Page Builder (optional)

## Installation

1. **Upload the Plugin**: 
   - Download the plugin from this repository.
   - Upload the plugin files to the `/wp-content/plugins/` directory, or install the plugin through the WordPress plugins screen directly.

2. **Activate the Plugin**: 
   - Activate the plugin through the 'Plugins' screen in WordPress.

3. **Setup ACF Fields**: 
   - Navigate to the ACF settings in your WordPress dashboard.
   - Create flexible content fields and repeated fields as needed.
   - Use the built-in WordPress functions provided by this plugin to customize your fields.

## Usage

### Creating Flexible Content Layouts

1. **Add a Flexible Content Field**:
   - Go to ACF and create a new field group.
   - Add a flexible content field and define the layouts you want.

2. **Use in Template**:
   - In your theme template file, use the following code to display the flexible content:

    ```php
    if( have_rows('your_flexible_content_field') ):
        while( have_rows('your_flexible_content_field') ): the_row();
            // Your code to display each layout goes here
        endwhile;
    endif;
    ```

### Adding Repeated Fields

1. **Add Repeater Field**:
   - In ACF, add a repeater field to your field group.
   - Define the subfields that will be repeated.

2. **Use in Template**:
   - In your theme template file, use the following code to loop through repeated fields:

    ```php
    if( have_rows('your_repeater_field') ):
        while( have_rows('your_repeater_field') ): the_row();
            // Your code to display each repeated item goes here
        endwhile;
    endif;
    ```

## Customization

This plugin is designed to be easily extendable. You can add your custom field types, modify the output, or integrate it with other plugins to suit your needs.

## Contributing

Contributions are welcome! Please open an issue or submit a pull request to help improve this plugin.

## License

This plugin is licensed under the [MIT License](LICENSE.md).
