<?php 

# Custom Comments

function ibid_custom_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    
     if ( 'div' == $args['style'] ) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'div';
        $add_below = 'div-comment';
    }
?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
    <div id="comment-<?php comment_ID(); ?>" class="comment">
            <div class="comment-author col-md-1 vcard comment_author col-avatar">
                <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, 130 ); ?>
            </div>
        <?php if ( $comment->comment_approved == '0' ) : ?>
            <em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.','ibid' ); ?></em>
        <?php endif; ?>

        <div class="comment-meta col-md-11 commentmetadata col-comment-body comment_body relative">
            <div class="row">
                <?php printf( '<div class="author_name col-md-5">%s</div>', get_comment_author_link() ); ?>
                <span class="reply_button col-md-7 text-right">
                    <?php printf( '%1$s at %2$s', get_comment_date(),  get_comment_time() ); ?>
                </span>
            </div>
            <?php comment_text(); ?>
            <span class="reply_button1 text-left">
                <?php edit_comment_link( esc_html__( 'Edit', 'ibid' ), '  ', '' ); ?>
                <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </span>
        </div>
        <div class="clearfix"></div>
    </div>
<?php } 

function ibid_pingback( $comment, $args, $depth ) {
        ?>
        <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
            <p><?php esc_html_e( 'Pingback:', 'ibid'); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( 'Edit', 'ibid' ), '<span class="edit-link">', '</span>'); ?></p>
        <?php
        
 } ?>