<?php
/**
 * Template Name: Blog
 * 
 * The template for displaying the Blog page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package buy-my-property
 */

get_header();
?>

<main id="primary" class="site-main mt_default">

   <?php get_template_part( 'template-parts/banner' ); ?>

<section class="blog_top_section wrap pt_100 pb_85">
    <div class="section-header">
        <h2 class="heading-medium-primary">
            <?php echo esc_html(get_field('bg_main_title')); ?>
        </h2>
        <p class="text-body-center section-subtitle">
            <?php echo esc_html(get_field('bg_description')); ?>
        </p>
    </div>

    <?php 
    $featured_post = get_field('featured_blog'); // ACF Post Object
    if( $featured_post ): 
        $post_id = $featured_post->ID;

        // Featured image logic
        $custom_img = get_field('featured_image', $post_id); // custom ACF image
        if( $custom_img ){
            $image_url = esc_url($custom_img['url']);
            $image_alt = esc_attr($custom_img['alt']);
        } else {
            $image_id = get_post_thumbnail_id($post_id);
            $image_url = wp_get_attachment_image_url($image_id, 'full');
            $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
        }

        // Category (first category only)
        $categories = get_the_category($post_id);
        $category_name = $categories ? $categories[0]->name : '';
    ?>
     <a href="<?php echo get_permalink($post_id); ?>">
    <div class="blog-featured-card">
        <div class="blog-card-image">
            <?php if($image_url): ?>
                <img src="<?php echo $image_url; ?>" alt="<?php echo $image_alt ?: get_the_title($post_id); ?>" loading="lazy">
            <?php endif; ?>
        </div>
        <div class="blog-card-content">
            <div class="blog-card-meta">
                <?php if($category_name): ?>
                    <span class="badge bg-off-black"><?php echo esc_html($category_name); ?></span>
                <?php endif; ?>
                <span class="badge bg-off-white"><?php echo get_the_date('M d, Y', $post_id); ?></span>
            </div>
            <h3 class="blog-card-title">
               
                    <?php echo get_the_title($post_id); ?>
               
            </h3>
            <p class="blog-card-description">
                <?php echo wp_trim_words(get_the_excerpt($post_id), 20); ?>
            </p>
        </div>
    </div>
     </a>
    
    <?php endif; ?>
</section>


 <section class="latest_articles_section wrap pb_100">
    <div class="section-header">
        <h2 class="heading-medium-primary">
            <?php echo esc_html(get_field('blog_listing_title')); ?>
        </h2>

        <div class="article-filter-tabs">
            <?php
            // Get all categories
            $categories = get_categories(array(
                'orderby' => 'name',
                'order'   => 'ASC',
            ));

            // "All" button
            echo '<button class="filter-tab active" data-filter="all">All</button>';

            foreach ($categories as $category) {
                printf(
                    '<button class="filter-tab" data-filter="%1$s">%2$s</button>',
                    esc_attr($category->slug),
                    esc_html($category->name)
                );
            }
            ?>
        </div>
    </div>

    <div class="articles-grid">
        <?php
        // Query latest 6 posts
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => 6,
            'post_status'    => 'publish',
        );
        $latest_posts = new WP_Query($args);

        if ($latest_posts->have_posts()) :
            while ($latest_posts->have_posts()) : $latest_posts->the_post();

                $post_id = get_the_ID();

                // Featured Image (fallback if no thumbnail)
                if (has_post_thumbnail($post_id)) {
                    $image_url = get_the_post_thumbnail_url($post_id, 'medium_large');
                    $image_alt = get_post_meta(get_post_thumbnail_id($post_id), '_wp_attachment_image_alt', true) ?: get_the_title($post_id);
                } else {
                    $image_url = get_template_directory_uri() . '/assets/images/blog/default.png';
                    $image_alt = get_the_title($post_id);
                }

                // Category (first category only)
                $post_cats = get_the_category($post_id);
                $category_slug = $post_cats ? $post_cats[0]->slug : '';
                $category_name = $post_cats ? $post_cats[0]->name : 'Uncategorized';
        ?>
            <article class="article-card" data-category="<?php echo esc_attr($category_slug); ?>">
                <div class="article-image">
                    <a href="<?php the_permalink(); ?>">
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>" loading="lazy">
                    </a>
                </div>
                <div class="article-content">
                    <div class="article-meta">
                        <span class="badge bg-off-black"><?php echo esc_html($category_name); ?></span>
                        <span class="badge bg-off-white"><?php echo get_the_date('M d, Y', $post_id); ?></span>
                    </div>
                    <h3 class="article-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    <p class="article-description">
                        <?php echo wp_trim_words(get_the_excerpt($post_id), 20); ?>
                    </p>
                </div>
            </article>
        <?php
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p>No articles found.</p>';
        endif;
        ?>
    </div>
</section>


</main>

<?php get_footer(); ?>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const filterTabs = document.querySelectorAll(".filter-tab");
    const articles = document.querySelectorAll(".article-card");

    filterTabs.forEach(tab => {
        tab.addEventListener("click", function () {
            // remove active class
            filterTabs.forEach(t => t.classList.remove("active"));
            this.classList.add("active");

            const filter = this.getAttribute("data-filter");

            articles.forEach(article => {
                if (filter === "all" || article.getAttribute("data-category") === filter) {
                    article.style.display = "block";
                } else {
                    article.style.display = "none";
                }
            });
        });
    });
});
</script>