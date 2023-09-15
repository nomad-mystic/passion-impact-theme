<?php

$resources_api_key = get_field('resources_api_key', 'option');
$resources_map = get_field('resources_map', 'option');

//die(var_dump($resources_map['resources_map_sites']));

$resources_map_sites = isset($resources_map['resources_map_sites']) ? htmlentities(json_encode($resources_map['resources_map_sites'])) : '';

// @todo Update ACF Link is caps

//die(var_dump($resources_map_sites));

?>

<section>
    <div class="google-map">
        <google-map google-key="<?php echo isset($resources_api_key) ? $resources_api_key : ''; ?>" map-sites="<?php echo (string) $resources_map_sites; ?>">
<!--            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2796.63845868179!2d-122.61215198444143!3d45.49722477910127!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5495a065e35d7537%3A0xa4c08ced4c947438!2s5106%20SE%20Powell%20Blvd%20%231200%2C%20Portland%2C%20OR%2097206!5e0!3m2!1sen!2sus!4v1604820291482!5m2!1sen!2sus" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>-->
        </google-map>
    </div>
</section>
