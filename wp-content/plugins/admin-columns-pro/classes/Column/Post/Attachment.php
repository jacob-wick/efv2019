<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @since 4.0
 */
class ACP_Column_Post_Attachment extends AC_Column_Post_Attachment
	implements ACP_Column_EditingInterface, ACP_Column_SortingInterface, ACP_Export_Column {

	public function sorting() {
		return new ACP_Sorting_Model( $this );
	}

	public function editing() {
		return new ACP_Editing_Model_Post_Attachment( $this );
	}

	public function export() {
		return new ACP_Export_Model_Post_Attachment( $this );
	}

}
