<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class AC_Settings_Column_Taxonomy extends AC_Settings_Column {

	/**
	 * @var string
	 */
	private $taxonomy;

	protected function define_options() {
		return array( 'taxonomy' );
	}

	/**
	 * @return AC_View
	 */
	public function create_view() {
		$taxonomy = $this->create_element( 'select', 'taxonomy' );
		$taxonomy->set_no_result( __( 'No taxonomies available.', 'codepress-admin-columns' ) )
		         ->set_options( ac_helper()->taxonomy->get_taxonomy_selection_options( $this->column->get_post_type() ) )
		         ->set_attribute( 'data-label', 'update' )
		         ->set_attribute( 'data-refresh', 'column' );

		return new AC_View( array(
			'setting' => $taxonomy,
			'label'   => __( 'Taxonomy', 'codepress-admin-columns' ),
		) );
	}

	/**
	 * @return string
	 */
	public function get_taxonomy() {
		return $this->taxonomy;
	}

	/**
	 * @param string $taxonomy
	 *
	 * @return bool
	 */
	public function set_taxonomy( $taxonomy ) {
		$this->taxonomy = $taxonomy;

		return true;
	}

}
