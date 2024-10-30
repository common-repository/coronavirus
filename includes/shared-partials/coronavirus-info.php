<article class="panel" style="max-width: 220px; background-color: <?php echo esc_attr(get_option('general_background_color')); ?>;">
  <p class="panel-heading" style="color: <?php echo esc_attr(get_option('header_text_color')); ?>; background-color: <?php echo esc_attr(get_option('header_background_color')); ?>;">
    <!-- Display flag if display_flag option is checked AND if its not displaying global data to prevent an image without src -->
    <?php if (get_option('display_flag') === 'on' && !empty($country_data->country)) :?><img src="<?php echo esc_url($country_data->countryInfo->flag); ?>" style="width: 35px; margin-right: 6px;"><?php endif;?>
    <?php echo empty($country_data->country) ? __('Globally', 'coronavirus') : esc_html__($country_data->country, 'coronavirus'); ?>
  </p>
  <div>
  <?php if (!empty($corona_data_options) && !empty($country_data)): ?>
    <?php foreach ($corona_data_options as $key => $option) : $string = preg_replace('/[A-Z]/', ' $0', $key); ?>
      <!-- Get substring of the key to see if the first word is today. If it is we switch the first and last second word so we can omit hard coding key : value pairs-->
      <?php if ($option === 'on') : ?>
          <?php if (substr($key, 0, 5) !== 'today') : ?>
              <label class="panel-block" style="border-color: <?php echo esc_attr(get_option('border_color')); ?>; color: <?php echo esc_attr(get_option('general_text_color')); ?>!important;"><?php echo ucfirst(strtolower($string)) . ": " . esc_html__($country_data->$key); ?></label>
            <?php elseif (substr($key, 0, 5) === 'today') : $pieces = preg_split('/(?=[A-Z])/',$key); ?>
              <label class="panel-block" style="border-color: <?php echo esc_attr(get_option('border_color')); ?>; color: <?php echo esc_attr(get_option('general_text_color')); ?>!important;"><?php echo ucfirst($pieces[1]) . ' ' . strtolower($pieces[0]) . ": " . $country_data->$key; ?></label>
          <?php endif ?>
      <?php endif; ?>
    <?php endforeach; ?>
  <?php endif; ?>
  </div>
</article>