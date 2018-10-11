<?php
/**
 * teacher Post Type: Single Post View
 *
 * @package    Pineland teachers
 * @author     Cap Web Solutions
 * @copyright  2017 Matt Ryan 
 *
 */
namespace CapWeb\Pineland\PinelandTeachers;
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

//* Remove the author box on single posts HTML5 Themes
remove_action( 'genesis_after_entry', 'genesis_do_author_box_single', 8 );

//* Force full-width-content layout setting
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//* Remove the breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

// add_action( 'genesis_entry_header', 'pineland_teacher_info', 10 );

add_action( 'genesis_entry_header', __NAMESPACE__ . '\pineland_teacher_info', 10 );

function pineland_teacher_info() {

	global $post;
	$post_id = get_the_ID( $post->ID ); 
	// $teacher_profile = get_the_content( $post_id );
	$teacher_featured_img = '';
	if( has_post_thumbnail( $post_id ) ) {
		$teacher_featured_img = genesis_get_image( 
			array( 
				'format' => 'html', 
				'size' => 'pineland-teacher-image', 
				'attr' => array( 'class' => 'teacher-image' ) 
				) 
			);
	}
	$teacher_phone = get_post_meta( $post_id, '_pineland_teacher_phone', true );
	$teacher_email = get_post_meta( $post_id, '_pineland_teacher_email', true );

	// Build output string
	$teacher_content = '<div class="teacher-contact-wrap">';
	if( !empty( $teacher_featured_img ) ) { 
		$teacher_content .= sprintf('<span class="alignright teacher-image">%s</span>', $teacher_featured_img ); 
	}
	// $teacher_content .= sprintf('<div class="teacher-profile">%s</div>', $teacher_profile );
	
	$teacher_or = ' ';
	if( !empty( $teacher_phone ) ) { 
		$teacher_content .= sprintf('Contact: <a href="tel:+1-%s"><span class="teacher-phone">%s</span></a>', $teacher_phone, $teacher_phone ); 
		$teacher_or = ', or ';
	}
	if( !empty( $teacher_email ) ) { 
		$teacher_content .= sprintf('%sEmail: <a href="mailto:%s"><span class="teacher-email">%s</span></a>', $teacher_or, $teacher_email, $teacher_email ); 
	}
	$teacher_content .= '</div>';  // close teacher-wrap

	printf( '<article class="teacher-entry">%s</article>', $teacher_content  );


}

genesis();