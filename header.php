<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package yakult
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

    <?php wp_body_open(); ?>

    <div id="page" class="site">

        <header>

            <!-- Mobile Header (visible below 820px) -->
            <div class="mobile-header">
                <div class="wrap mobile-header__inner">
                    <div class="mobile-header__logo">
                        <a href="<?php echo home_url('/'); ?>" aria-label="Go to homepage">
                            <?php
                            $theme_uri = get_template_directory_uri();
                            $logo_src_mobile = is_front_page()
                                ? $theme_uri . '/assets/images/common/logo_footer.png'
                                : $theme_uri . '/assets/images/common/white_logo.png';
                            ?>
                            <img class="logo" src="<?php echo esc_url($logo_src_mobile); ?>" alt="BuyMyProperty Logo">
                        </a>
                    </div>
                    <div class="d_flex g_1"> <a href="<?php echo home_url(); ?>" class="btn btn-white">Get an Offer</a>
                        <button class="menu-toggle" role="button" aria-label="Open menu"
                            aria-controls="mobile-navigation" aria-expanded="false" type="button">
                            <svg width="18" height="19" viewBox="0 0 18 19" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="2" cy="2.5" r="2" fill="#222222" />
                                <circle cx="9" cy="2.5" r="2" fill="#222222" />
                                <circle cx="16" cy="2.5" r="2" fill="#222222" />
                                <circle cx="2" cy="9.5" r="2" fill="#222222" />
                                <circle cx="9" cy="9.5" r="2" fill="#222222" />
                                <circle cx="16" cy="9.5" r="2" fill="#222222" />
                                <circle cx="2" cy="16.5" r="2" fill="#222222" />
                                <circle cx="9" cy="16.5" r="2" fill="#222222" />
                                <circle cx="16" cy="16.5" r="2" fill="#222222" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div class="site-header <?php echo !is_front_page() ? 'not-home-page' : ''; ?>">
                <div class="container_header_top">
                    <div class="site-header__top wrap">
                        <div class="site-header__contact">
                            <?php if (get_field('h_email_id', 'option')): ?>
                                <a href="mailto:<?php echo get_field('h_email_id', 'option'); ?>" class="contact-link">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M1.34952 4.8632C1.34952 3.7878 2.29435 2.91602 3.45986 2.91602H14.5392C15.7047 2.91602 16.6495 3.7878 16.6495 4.8632V13.1387C16.6495 14.2141 15.7047 15.0859 14.5392 15.0859H3.45986C2.29435 15.0859 1.34952 14.2141 1.34952 13.1387V4.8632Z"
                                            stroke="#016C51" stroke-width="1.4" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M2.1416 3.64648L9.00022 9.24463L15.8588 3.64648" stroke="#016C51"
                                            stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>

                                    <?php echo get_field('h_email_id', 'option'); ?>
                                </a>
                            <?php endif; ?>
                            <?php if (get_field('h_phone_number', 'option')): ?>
                                <a href="tel:<?php echo get_field('h_phone_number', 'option'); ?>" class="contact-link">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M5.91428 1.7998H3.10908C2.38609 1.7998 1.79999 2.3859 1.79999 3.10889C1.79999 10.3388 7.66099 16.1998 14.8909 16.1998C15.6139 16.1998 16.2 15.6137 16.2 14.8907V12.0855L13.1143 10.0284L11.5142 11.6284C11.2364 11.9063 10.821 11.9927 10.4719 11.8124C9.87968 11.5064 8.91865 10.9316 7.97143 10.0284C7.00155 9.10358 6.43329 8.1071 6.14808 7.50419C5.98824 7.16624 6.08078 6.77616 6.34511 6.51182L7.97143 4.88552L5.91428 1.7998Z"
                                            stroke="#016C51" stroke-width="1.35" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    <?php echo get_field('h_phone_number', 'option'); ?>
                                </a>
                            <?php endif; ?>
                        </div>

                        <nav class="site-header__nav">
                            <?php if (have_rows('top_navigation_menus', 'option')): ?>
                                <?php
                                $count = 0;
                                $total = count(get_field('top_navigation_menus', 'option'));
                                ?>
                                <?php while (have_rows('top_navigation_menus', 'option')):
                                    the_row();
                                    $link = get_sub_field('top_page_url'); // returns array: url, title, target
                                    if ($link):
                                        $url = $link['url'];
                                        $title = $link['title'];
                                        $target = $link['target'] ? $link['target'] : '_self';
                                        ?>
                                        <a href="<?php echo esc_url($url); ?>" target="<?php echo esc_attr($target); ?>">
                                            <?php echo esc_html($title); ?>
                                        </a>
                                        <?php $count++; ?>
                                        <?php if ($count < $total): ?>
                                            <span>|</span>
                                        <?php endif; ?>
                                        <?php
                                    endif;
                                endwhile; ?>
                            <?php endif; ?>
                        </nav>

                    </div>
                </div>

                <div class="site-header__bottom wrap">
                    <div class="site-header__logo">
                        <?php if (get_field('h_logo', 'option')): ?>
                            <a href="<?php echo esc_url(home_url('/')); ?>">
                                <img class="logo" src="<?php echo get_field('h_logo', 'option')['url']; ?>"
                                    alt="BuyMyProperty Logo">
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="site-header__actions">
                        <?php if (get_field('h_button', 'option')): ?>
                            <a href="<?php echo get_field('h_button', 'option')['url']; ?>"
                                class="btn btn-white"><?php echo get_field('h_button', 'option')['title']; ?></a>
                        <?php endif; ?>
                        <div class="menu-toggle">
                            <svg width="18" height="19" viewBox="0 0 18 19" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="2" cy="2.5" r="2" fill="#222222" />
                                <circle cx="9" cy="2.5" r="2" fill="#222222" />
                                <circle cx="16" cy="2.5" r="2" fill="#222222" />
                                <circle cx="2" cy="9.5" r="2" fill="#222222" />
                                <circle cx="9" cy="9.5" r="2" fill="#222222" />
                                <circle cx="16" cy="9.5" r="2" fill="#222222" />
                                <circle cx="2" cy="16.5" r="2" fill="#222222" />
                                <circle cx="9" cy="16.5" r="2" fill="#222222" />
                                <circle cx="16" cy="16.5" r="2" fill="#222222" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>



            <div class="buymy-nav">
                <div class="site-header <?php echo !is_front_page() ? 'not-home-page' : ''; ?>">
                    <div class="container_header_top">
                        <div class="site-header__top wrap">
                            <div class="site-header__contact">
                                <?php if (get_field('h_email_id', 'option')): ?>
                                    <a href="mailto:<?php echo get_field('h_email_id', 'option'); ?>" class="contact-link">
                                        <svg width="15" height="12" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M1.34952 4.8632C1.34952 3.7878 2.29435 2.91602 3.45986 2.91602H14.5392C15.7047 2.91602 16.6495 3.7878 16.6495 4.8632V13.1387C16.6495 14.2141 15.7047 15.0859 14.5392 15.0859H3.45986C2.29435 15.0859 1.34952 14.2141 1.34952 13.1387V4.8632Z"
                                                stroke="#016C51" stroke-width="1.4" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M2.1416 3.64648L9.00022 9.24463L15.8588 3.64648" stroke="#016C51"
                                                stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>

                                        <?php echo get_field('h_email_id', 'option'); ?>
                                    </a>
                                <?php endif; ?>
                                <?php if (get_field('h_phone_number', 'option')): ?>
                                    <a href="tel:<?php echo get_field('h_phone_number', 'option'); ?>" class="contact-link">
                                        <svg width="14" height="14" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M5.91428 1.7998H3.10908C2.38609 1.7998 1.79999 2.3859 1.79999 3.10889C1.79999 10.3388 7.66099 16.1998 14.8909 16.1998C15.6139 16.1998 16.2 15.6137 16.2 14.8907V12.0855L13.1143 10.0284L11.5142 11.6284C11.2364 11.9063 10.821 11.9927 10.4719 11.8124C9.87968 11.5064 8.91865 10.9316 7.97143 10.0284C7.00155 9.10358 6.43329 8.1071 6.14808 7.50419C5.98824 7.16624 6.08078 6.77616 6.34511 6.51182L7.97143 4.88552L5.91428 1.7998Z"
                                                stroke="#016C51" stroke-width="1.35" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                        <?php echo get_field('h_phone_number', 'option'); ?>
                                    </a>
                                <?php endif; ?>
                            </div>

                            <nav class="site-header__nav">
                                <?php if (have_rows('top_navigation_menus', 'option')): ?>
                                    <?php
                                    $count = 0;
                                    $total = count(get_field('top_navigation_menus', 'option'));
                                    ?>
                                    <?php while (have_rows('top_navigation_menus', 'option')):
                                        the_row();
                                        $link = get_sub_field('top_page_url'); // returns array: url, title, target
                                        if ($link):
                                            $url = $link['url'];
                                            $title = $link['title'];
                                            $target = $link['target'] ? $link['target'] : '_self';
                                            ?>
                                            <a href="<?php echo esc_url($url); ?>" target="<?php echo esc_attr($target); ?>">
                                                <?php echo esc_html($title); ?>
                                            </a>
                                            <?php $count++; ?>
                                            <?php if ($count < $total): ?>
                                                <span>|</span>
                                            <?php endif; ?>
                                            <?php
                                        endif;
                                    endwhile; ?>
                                <?php endif; ?>
                            </nav>


                        </div>
                    </div>

                    <div class="site-header__bottom wrap">
                        <div class="site-header__logo">
                            <?php if (get_field('h_logo', 'option')): ?>
                                <a href="<?php echo esc_url(home_url('/')); ?>">
                                    <img class="logo" src="<?php echo get_field('h_logo', 'option')['url']; ?>"
                                        alt="BuyMyProperty Logo"></a>
                            <?php endif; ?>
                        </div>
                        <div class="site-header__actions">
                            <?php if (get_field('h_button', 'option')): ?>
                                <a href="<?php echo get_field('h_button', 'option')['url']; ?>"
                                    class="btn btn-white"><?php echo get_field('h_button', 'option')['title']; ?></a>
                            <?php endif; ?>
                            <div class="menu-toggle">
                                <svg width="18" height="19" viewBox="0 0 18 19" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="16" cy="2.5" r="2" transform="rotate(90 16 2.5)" fill="#222222" />
                                    <circle cx="16" cy="16.5" r="2" transform="rotate(90 16 16.5)" fill="#222222" />
                                    <circle cx="9" cy="9.5" r="2" transform="rotate(90 9 9.5)" fill="#222222" />
                                    <circle cx="2" cy="2.5" r="2" transform="rotate(90 2 2.5)" fill="#222222" />
                                    <circle cx="2" cy="16.5" r="2" transform="rotate(90 2 16.5)" fill="#222222" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="main-content wrap">
                    <?php if (have_rows('h_main_menus_', 'option')): ?>
                        <ul class="main-nav">
                            <?php
                            $count = 1;
                            while (have_rows('h_main_menus_', 'option')):
                                the_row();
                                $menu_link = get_sub_field('h_menu_links');
                                $is_dropdown = get_sub_field('is_drop_down');
                                ?>
                                <li class="nav-item <?php echo $is_dropdown ? 'has-dropdown' : ''; ?>">
                                    <a href="<?php echo esc_url($menu_link['url']); ?>" class="nav-link">
                                        <span class="nav-text <?php echo $is_dropdown ? 'arrow' : ''; ?>">
                                            <?php echo esc_html($menu_link['title']); ?>
                                        </span>
                                        <span class="nav-number">
                                            <?php echo sprintf('%02d', $count); ?>.
                                        </span>
                                    </a>

                                    <?php if ($is_dropdown && have_rows('h_sub_menus')): ?>
                                        <div class="submenu">
                                            <?php while (have_rows('h_sub_menus')):
                                                the_row();
                                                $sub_link = get_sub_field('h_sub_menu'); ?>
                                                <div class="submenu-item">
                                                    <a href="<?php echo esc_url($sub_link['url']); ?>">
                                                        <?php echo esc_html($sub_link['title']); ?>
                                                    </a>
                                                </div>
                                            <?php endwhile; ?>
                                        </div>
                                    <?php endif; ?>
                                </li>
                                <?php
                                $count++;
                            endwhile;
                            ?>
                        </ul>
                    <?php endif; ?>

                    <?php if (have_rows('social_links', 'option')): ?>

                        <div class="header-social">
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


                    <div class="right-section">
                        <div class="footer-cta-content">
                            <h3 class="heading-medium-accent text-accent font-medium">
                                <?php echo get_field('h_box_title', 'option'); ?>
                            </h3>
                            <?php if (get_field('h_box_link', 'option')): ?>
                                <a href="<?php echo get_field('h_box_link', 'option')['url']; ?>"
                                    class="btn-primary footer-cta-btn">
                                    <?php echo get_field('h_box_link', 'option')['title']; ?>
                                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.88452 0.880798L9.19988 5.00001L4.88452 9.11922" stroke="white"
                                            stroke-width="1.28571" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M9.2 4.99994L0.800049 4.99994" stroke="white" stroke-width="1.28571"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                            <?php endif; ?>
                        </div>

                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/footer/nav_decor.svg"
                            alt="<?php bloginfo('name'); ?>" class="nav-decor">
                    </div>
                </div>
            </div>
        </header>

        <!-- <div id="content" class="site-content"> -->