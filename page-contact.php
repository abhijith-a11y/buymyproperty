<?php
/**
 * Template Name: Contact Us
 * 
 * The template for displaying the Contact Us page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package buy-my-property
 */

get_header();
?>

<main id="primary" class="site-main mt_default">

    <?php get_template_part('template-parts/banner'); ?>

    <section class="contact_form_section pt_100 pb_100">
        <div class="contact-container">
            <!-- Section Header -->
            <div class="section-header">
                <h2 class="heading-medium-primary"><?php echo get_field('c_main_title'); ?></h2>
                <p class="text-body-center section-subtitle">
                    <?php echo get_field('c_sub_description'); ?>
                </p>
            </div>

            <!-- Contact Content -->
            <div class="wrap contact-content pt_70 pb_100">
                <!-- Left Side - Contact Info -->
                <div class="contact-info-section">
                    <h3 class="contact-info-title"><?php echo get_field('form_title'); ?></h3>
                    <p class="contact-info-description text-body-regular">
                        <?php echo get_field('form_description'); ?>
                    </p>

                    <div class="contact-details">
                        <?php
                        $contact_details = get_field('contact_details');
                        if ($contact_details):
                            foreach ($contact_details as $detail):
                                $detail_label = $detail['contact_title'];
                                $detail_value = $detail['contact_description'];
                                ?>
                                <div class="contact-detail-item">
                                    <h4 class="detail-label"><?php echo esc_html($detail_label); ?></h4>
                                    <p class="detail-value detail-highlight jj"><?php echo $detail_value; ?></p>
                                </div>
                                <?php
                            endforeach;
                        endif;
                        ?>
                    </div>

                    <!-- Social Media Links -->
                    <?php if (have_rows('social_links', 'option')): ?>
                        <div class="contact-social">
                            <?php while (have_rows('social_links', 'option')):
                                the_row();
                                $url = get_sub_field('social_url');
                                $icon_url = get_sub_field('icon'); // directly gets image URL
                                ?>
                                <a href="<?php echo esc_url($url); ?>" class="social-link" target="_blank" rel="noopener"
                                    aria-label="<?php echo esc_attr($url); ?>">
                                    <img src="<?php echo $icon_url['url']; ?>" alt="Social Icon" />
                                </a>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>


                </div>

                <!-- Right Side - Contact Form -->
                <div class="contact-form-section ">
                    <div class="offer-form-container">
                        <div class="offer-form" id="propertyOfferForm">
                            <?php echo do_shortcode('[contact-form-7 id="b0a148c" title="Contact form"]'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="map_section">
        <div class="map-container">
            <div class="container">
                <!-- Snazzy Maps Implementation -->
                <div class="google-map">
                    <div id="snazzy-map" class="snazzy-map-container"></div>
                </div>

                <!-- Google Maps API Script -->
                <?php
                $map_title = get_field('map_title');
                $map_address = get_field('map_address');
                $latitude = get_field('latitude');
                $longitude = get_field('longitude');

                $map_lat = $latitude ? floatval($latitude) : 25.2048;
                $map_lng = $longitude ? floatval($longitude) : 55.2708;
                $map_title = esc_js($map_title);
                $map_address = esc_js($map_address);
                ?>
                <script>
                    function initSnazzyMap() {
                        // Dynamic coordinates from ACF fields
                        var officeLocation = {
                            lat: <?php echo $map_lat; ?>,
                            lng: <?php echo $map_lng; ?>
                        };

                        // Snazzy Maps Style - Clean and minimal
                        var snazzyMapStyles = [
                            {
                                "featureType": "all",
                                "elementType": "labels.text.fill",
                                "stylers": [
                                    { "color": "#555555" },
                                    { "lightness": 40 }
                                ]
                            },
                            {
                                "featureType": "all",
                                "elementType": "labels.text.stroke",
                                // "stylers": [{"color": "#ffffff"}, {"weight": 3}]
                                "stylers": [
                                    { "visibility": "off" }   // remove strong outline
                                ]
                            },
                            {
                                "featureType": "all",
                                "elementType": "labels.icon",
                                "stylers": [{ "visibility": "off" }]
                            },
                            {
                                "featureType": "landscape",
                                "elementType": "geometry",
                                "stylers": [{ "color": "#f2f2f2" }]
                            },
                            {
                                "featureType": "poi",
                                "elementType": "geometry",
                                "stylers": [{ "color": "#e6e6e6" }]
                            },
                            {
                                "featureType": "road",
                                "elementType": "geometry",
                                "stylers": [{ "color": "#ffffff" }]
                            },
                            {
                                "featureType": "road.highway",
                                "elementType": "geometry.stroke",
                                "stylers": [{ "color": "#dcdcdc" }]
                            },
                            {
                                "featureType": "water",
                                "elementType": "geometry",
                                "stylers": [{ "color": "#c9c9c9" }]
                            }
                        ];

                        // Map options
                        var mapOptions = {
                            zoom: 9,
                            center: officeLocation,
                            styles: snazzyMapStyles,
                            disableDefaultUI: true,
                            zoomControl: true
                        };

                        // Create map
                        var map = new google.maps.Map(document.getElementById('snazzy-map'), mapOptions);

                        // Create info window content
                        var infoWindowContent = '<div style="padding: 10px; max-width: 250px;">' +
                            '<h4 style="margin: 0 0 8px 0; color: #016C51; font-size: 16px;"><?php echo $map_title; ?></h4>' +
                            '<p style="margin: 0; color: #333; font-size: 14px; line-height: 1.4;"><?php echo $map_address; ?></p>' +
                            '</div>';

                        // Create info window
                        var infoWindow = new google.maps.InfoWindow({
                            content: infoWindowContent
                        });

                        // Custom marker
                        var marker = new google.maps.Marker({
                            position: officeLocation,
                            map: map,
                            title: '<?php echo $map_title; ?>',
                            icon: {
                                url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(
                                    '<svg width="36" height="46" viewBox="0 0 36 46" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18 0C13.2278 0.00543531 8.65254 1.91115 5.27806 5.29906C1.90357 8.68696 0.00541377 13.2804 0 18.0716C0 33.5352 16.3636 45.2139 17.0611 45.7027C17.3363 45.8962 17.6641 46 18 46C18.3359 46 18.6637 45.8962 18.9389 45.7027C19.6364 45.2139 36 33.5352 36 18.0716C35.9946 13.2804 34.0964 8.68696 30.7219 5.29906C27.3475 1.91115 22.7722 0.00543531 18 0ZM18 11.5001C19.2946 11.5001 20.5601 11.8855 21.6365 12.6076C22.7129 13.3297 23.5518 14.356 24.0472 15.5568C24.5426 16.7576 24.6722 18.0789 24.4197 19.3536C24.1671 20.6284 23.5437 21.7993 22.6283 22.7184C21.7129 23.6374 20.5466 24.2633 19.277 24.5168C18.0073 24.7704 16.6912 24.6403 15.4952 24.1429C14.2991 23.6455 13.2769 22.8032 12.5577 21.7225C11.8384 20.6419 11.4545 19.3713 11.4545 18.0716C11.4545 16.3287 12.1442 14.6573 13.3717 13.4249C14.5992 12.1925 16.264 11.5001 18 11.5001Z" fill="#016C51"/></svg>'
                                ),
                                scaledSize: new google.maps.Size(30, 30),
                                anchor: new google.maps.Point(15, 15)
                            }
                        });

                        // Add click event listener to marker
                        marker.addListener('click', function () {
                            infoWindow.open(map, marker);
                        });
                    }
                </script>

                <!-- Load Google Maps API -->
                <script async defer
                    src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCaWcgwHmig2q4SmrOXzGuPmf1PP5g-iao&callback=initSnazzyMap">
                </script>
                <!-- <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCaWcgwHmig2q4SmrOXzGuPmf1PP5g-iao&callback=initialize"></script> -->

            </div>
        </div>
    </section>


</main>

<?php get_footer(); ?>