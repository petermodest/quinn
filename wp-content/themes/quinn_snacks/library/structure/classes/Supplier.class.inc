<?
	class Supplier extends Post {
		
		var $location_convert = array();
		
		public function __construct( $post = false, $load = true ) {
			if( $post && $load ) $this->load( $post, 1 );
		}
		
		public function load( $post, $taxes = true ) {
			parent::load( $post, $taxes );
			foreach( $this->locations as $location ) :
				if( isset( $location->location->address ) ) :
					$this->location_convert[] = str_replace( ', United States', '', $location->location->address );
				endif;
			endforeach;
			$this->location_name = implode( ' / ', $this->location_convert );
		}
				
	}