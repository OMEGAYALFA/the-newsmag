<?php
/**
 * Template part for displaying gallery post format.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package The NewsMag
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php do_action('the_newsmag_before_post_content'); ?>
    
    <?php if (get_post_gallery()) : ?>
        <ul id="gallery-slider" class="gallery-slider">
            <?php
            $output = '';
            $galleries = get_post_gallery($post, false);
            $attachment_ids = explode(",", $galleries['ids']);
            $i = 1;
            foreach ($attachment_ids as $attachment_id) {
                // displaying the attached image of gallery
                $link = wp_get_attachment_image($attachment_id, 'the-newsmag-featured-large-thumbnail');
                $output .= '<li class="slider-images">' . $link . '</li>';
                $i++;
            }
            echo $output;
            ?>
        </ul>
    <?php endif; ?>

    <div class="post-header-wrapper clear">
        <?php if ('post' === get_post_type()) : ?>
            <div class="category-links">
                <?php the_newsmag_colored_category(); ?>
            </div><!-- .entry-meta -->
        <?php endif; ?>

        <?php if (('post' === get_post_type() && !is_single() && !post_password_required()) && (comments_open() || get_comments_number())) : ?>
            <a href="<?php esc_url(comments_link()); ?>" class="entry-meta-comments">
                <?php
                printf(_nx('<i class="fa fa-comment"></i> 1', '<i class="fa fa-comment"></i> %1$s', get_comments_number(), 'comments title', 'the-newsmag'), number_format_i18n(get_comments_number()));
                ?>
            </a>
        <?php endif; ?>
    </div>

    <header class="entry-header">
        <?php
        if (is_single()) {
            the_title('<h1 class="entry-title">', '</h1>');
        } else {
            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
        }

        if ('post' === get_post_type()) :
            ?>
            <div class="entry-meta">
                <?php the_newsmag_posted_on(); ?>
            </div><!-- .entry-meta -->
        <?php endif;
        ?>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php
        if (is_single()) :
            the_content();
        else :
            the_excerpt(); // displaying excerpt for the archive pages
        endif;

        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'the-newsmag'),
            'after' => '</div>',
        ));
        ?>

        <?php if (!is_single() && !is_sticky()) : ?>
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                <?php
                printf(
                        /* translators: %s: Name of current post. */
                        wp_kses('<button type="button" class="btn continue-more-link">' . __('Read More <i class="fa fa-arrow-circle-o-right"></i>', 'the-newsmag') . '</button> %s', array('i' => array('class' => array()), 'button' => array('class' => array(), 'type' => array()))), the_title('<span class="screen-reader-text">"', '"</span>', false)
                );
                ?>
            </a>
        <?php endif; ?>
    </div><!-- .entry-content -->

    <?php if (is_single()) : ?>
        <footer class="entry-footer">
            <?php the_newsmag_entry_footer(); ?>
        </footer><!-- .entry-footer -->
    <?php endif; ?>

    <?php do_action('the_newsmag_after_post_content'); ?>
</article><!-- #post-## -->
