<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://mikezuidhoek.com/
 * @since      1.0.0
 *
 * @package    Coronavirus
 * @subpackage Coronavirus/admin/partials
 */

/**
 * If you want to add a new value from the API add a new element like this: $keyInApi => $Display value
 */
$checkbox_ids = [
    'cases' => __('Total cases', 'coronavirus'), 
    'todayCases' => __('Today\'s cases', 'coronavirus'),
    'deaths' => __('Total deaths', 'coronavirus'),
    'todayDeaths' => __('Today\'s deaths', 'coronavirus'),
    'recovered' => __('Recovered', 'coronavirus'),
    'active' => __('Active cases', 'coronavirus'),
    'critical' => __('Critical', 'coronavirus'),
    'casesPerOneMillion' => __('Cases per one million', 'coronavirus'),
    'deathsPerOneMillion' => __('Deaths per one million', 'coronavirus'),
    'tests' => __('Tests', 'coronavirus'),
    'testsPerOneMillion' => __('Tests per one million', 'coronavirus')
];

$this->save_settings($checkbox_ids);
$country_data = $this->shared_functionality->get_corona_data('usa');
$corona_data_options = get_option('corona_data_options');
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="container-fluid">
    <h1 class="font-weight-bold"><?php _e('Coronavirus Settings', 'coronavirus'); ?></h1>

    <form class="mb-3 mt-2" action="" method="POST">
        <div class="row">
            <?php wp_nonce_field('submit-settings'); ?>
            <div class="col-12 col-md-6 col-xl-4">
                <h4><?php _e('Modify the widgets color', 'coronavirus'); ?></h4>
                <div class="form-group">
                    <label for="header-background-color"><?php _e('Header Background Color', 'coronavirus'); ?></label>
                    <input type="color" name="header-background-color" id="header-background-color" value="<?php echo empty(get_option('header_background_color')) ? '#F7F7F7': esc_attr(get_option('header_background_color')); ?>">
                </div>
                <div class="form-group">
                    <label for="header-text-color"><?php _e('Header Text Color', 'coronavirus'); ?></label>
                    <input type="color" name="header-text-color" id="header-text-color" value="<?php echo esc_attr(get_option('header_text_color')); ?>">
                </div>
                <div class="form-group">
                    <label for="general-background-color"><?php _e('General Background Color', 'coronavirus'); ?></label>
                    <input type="color" name="general-background-color" id="general-background-color" value="<?php echo empty(get_option('general_background_color')) ? '#FFFFFF': esc_attr(get_option('general_background_color')); ?>">
                </div>
                <div class="form-group">
                    <label for="general-text-color"><?php _e('Text Color', 'coronavirus'); ?></label>
                    <input type="color" name="general-text-color" id="general-text-color" value="<?php echo esc_attr(get_option('general_text_color')); ?>">
                </div>
                <div class="form-group">
                    <label for="border-color"><?php _e('Seperator color', 'coronavirus'); ?></label>
                    <input type="color" name="border-color" id="border-color" value="<?php echo empty(get_option('border_color')) ? '#ededed': esc_attr(get_option('border_color')); ?>">
                </div>
            </div>

            <div class="form-group col-12 col-md-6 col-xl-4">
                <h4><?php _e('Choose what information to display', 'coronavirus'); ?></h4>
                <?php foreach ($checkbox_ids as $id => $display_value) : ?>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($id); ?>" <?php if (!empty($corona_data_options) && $corona_data_options[$id] === 'on') echo 'checked'; ?>>
                        <label class="custom-control-label" for="<?php echo esc_attr($id); ?>"><?php echo $display_value; ?></label>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>

        <div class="row">
            <div class="form-group col-12 col-md-6 col-xl-4">
                <h4><?php _e('Additional settings', 'coronavirus'); ?></h4>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="display-flag" name="display-flag" <?php if (get_option('display_flag') === 'on') echo 'checked'; ?>>
                        <label class="custom-control-label" for="display-flag">Display country flag</label>
                    </div>
            </div>
        </div>
        <div class="btn-group">
            <button type="submit" class="btn btn-success" name="save-settings"><?php _e('Save', 'coronavirus'); ?></button>       
            <button type="submit" class="btn btn-danger" name="reset-settings"><?php _e('Reset to default config', 'coronavirus'); ?></button>       
        </div>
    </form>

    <div class="row">
        <div class="col-12 col-xl-3 mb-5 mb-xl-0">
            <?php require_once dirname(plugin_dir_path( dirname( __FILE__ ) )) . '/includes/shared-partials/coronavirus-info.php'; ?>
        </div>
        <div class="col-12 col-xl-5 ml-auto">

            <h1>How to add the widget?</h1>
            <p>To add the widget on your site put the shortcode &#40Including the surrounding brackets&#41; in a post or page its text. See the picture for an example &#40Click to enlarge&#41. 
                If you still need more info please see <a href="https://www.wpbeginner.com/wp-tutorials/how-to-add-a-shortcode-in-wordpress/" target="_blank">this guide </a> for a detailed explanation.

            </p>

            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Description</th>
                    <th scope="col"  style="width: 250px">Shortcode</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">Display global data</th>
                    <td>[coronavirus]</td>
                    </tr>
                    <tr>
                    <th scope="row">Display data by country <small class="text-muted">quotation marks are mandatory, country name is not case sensitive</small></th>
                    <td>[coronavirus country="usa"]</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="col-12 col-xl-4 my-auto">
            <a href="https://i.gyazo.com/3cd44e40660bef39d3e6f86fcb7f1b63.png" target="_blank">
                <img src="https://i.gyazo.com/3cd44e40660bef39d3e6f86fcb7f1b63.png" class="img-fluid p-2 bg-secondary">
            </a>
        </div>
    </div>

    <div class=" row mt-3">
        
    </div>
</div>