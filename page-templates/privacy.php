<?php
/**
 * Template Name: Privacy Policy
 */

get_header();

global $post;
?>

<div class="privacy">
    <div class="container">
        <div class="privacy-intro section-intro">
            </div>
        <div class="privacy-content section-content">
            <h1 class="privacy-title">Privacy Policy</h1>
            <?php the_content(); ?>
        </div>
    </div>
</div>

<?php
get_footer();
