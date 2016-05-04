<?
	class Batch extends Post {
		
		var $selected;
		var $snacks;
		var $cache_ingredients = array();
		var $cache_suppliers = array();
		var $blocks = array();
		var $map_overlays = array();
	
		var $state_colors = array(
			  '#BDD632' => array( 'WA', 'IA', 'VA' ),
			  '#F7B419' => array( 'OR', 'MI', 'LA', 'PA' ),
			  '#D9E141' => array( 'CA', 'WY', 'MO', 'NC', 'NH' ),
			  '#11C0EA' => array( 'NV', 'SD', 'WI', 'KY', 'AL', 'NY', 'RI' ),
			  '#ED1A7C' => array( 'MT', 'TX' ),
			  '#43BEAA' => array( 'UT', 'OH', 'MD' ),
			  '#1BB24B' => array( 'AZ', 'TN', 'MA' ),
			  '#3C82C4' => array( 'ID', 'ND', 'CO', 'GA', 'ME', 'DE' ),
			  '#EE2C24' => array( 'NM', 'MN', 'VT' ),
			  '#EE215C' => array( 'IL', 'WV' ),
			  '#98A73A' => array( 'NE', 'OK', 'NJ' ),
			  '#F9E808' => array( 'AR', 'KS', 'CT' ),
			  '#DA3593' => array( 'FL', 'SC' ),
			  '#F68922' => array( 'IN' ),
			  '#F16729' => array( 'MS' ),
			  'transparent' => array( 'HI', 'AK' )
		);

		public function __construct( $post = false, $load = true ) {
			if( $post && $load ) $this->load( $post, 1 );
		}

		public function load( $post, $taxes = true ) {
			parent::load( $post, $taxes );
			$this->prepare_blocks();
		}

		public function prepare_blocks() {
			$this->batch_loop = $this->snacks;
			$this->snacks = array();
			if( is_array( $this->batch_loop ) || is_object( $this->batch_loop ) ) :
				foreach( $this->batch_loop as $snack ) :
					if( ( isset( $_GET['flavor'] ) && $snack->snack->ID == $_GET['flavor'] ) || ! isset( $_GET['flavor'] ) ) :
						$this->snacks[$snack->snack->ID] = new Flavor( $snack->snack );

						if( isset( $snack->map_overlay->url ) ) :
							$this->map_overlays[] = $snack->map_overlay->url;
						elseif( isset( $this->snacks[$snack->snack->ID]->map_overlay->url ) ) :
							$this->map_overlays[] = $this->snacks[$snack->snack->ID]->map_overlay->url;
						endif;
	
						foreach( $snack->ingredients as $ingredient ) :
							if( is_object( $ingredient->supplier ) || is_array( $ingredient->supplier ) ) :
								foreach( $ingredient->supplier as $supplier ) :
									$this->set_block( $supplier, $ingredient->ingredient );
								endforeach;
							endif;
						endforeach;
					endif;
				endforeach;
			endif;
		}

		public function set_block( $supplier, $ingredient ) {
			$ingredient = $this->set_ingredient( $ingredient );
			$supplier = $this->set_supplier( $supplier );
			$key = $supplier->ID . '-' . $ingredient->term_id;
			if( ! array_key_exists( $key, $this->blocks ) && ! isset( $ingredient->inactive[0] ) ) :
				$this->blocks[$key] = (object) array(
					'supplier_id'	=> $supplier->ID,
					'ingredient_id'	=> $ingredient->term_id,
					'image'			=> isset( $supplier->featured->uri ) ? $supplier->featured->uri : $ingredient->bg_image,
					'website'		=> isset( $supplier->website ) ? $supplier->website : false,
					'icon'			=> $ingredient->icon,
					'color'			=> $ingredient->color ? $ingredient->color : $this->get_block_color( $supplier->locations ),
					'title'			=> $ingredient->name,
					'supplier'		=> $supplier->post_title,
					'location'		=> $supplier->location_name,
					'deep'			=> $supplier->layers_deep,
					'overview'		=> $supplier->short_description ? $supplier->short_description : $ingredient->description,
					'permalink'		=> $supplier->permalink,
					'link'			=> isset( $supplier->link->{0} ) ? 1 : 0,
					'link_text'		=> $supplier->link_text ? $supplier->link_text : 'See The Farm',
					'location_text'	=> $ingredient->grown_in_text ? $ingredient->grown_in_text : 'Grown In'
				);
			endif;
		}

		public function get_all_suppliers() {
			$suppliers = new WP_Query(
				array(
					'post_type' 		=> 'supplier',
					'posts_per_page'	=> -1,
					'tax_query'			=> array(
						array(
							'taxonomy'	=> 'supplier_type',
							'terms'		=> array( 32 )
						)
					)
				)	
			);
			foreach( $suppliers->posts as $supplier ) : 
				$supplier = new Supplier( $supplier );
				foreach( $supplier->taxonomies->ingredient as $ingredient ) :
					$this->set_block( $supplier, $ingredient );
				endforeach; 
			endforeach;
		}

		public function set_ingredient( $ingredient ) {
			if( is_numeric( $ingredient ) && array_key_exists( $ingredient, $this->cache_ingredients ) ) :
				return $this->cache_ingredients[$ingredient];
			elseif( isset( $ingredient->ID ) && array_key_exists( $ingredient->ID, $this->cache_suppliers ) ) :
				return $this->cache_ingredients[$ingredient->ID];
			elseif( is_numeric( $ingredient ) ) :
				$ingredient = get_term( $ingredient, 'ingredient' );
			endif;

			$ingredient->inactive = get_field( 'ingredient_inactive', 'ingredient_' . $ingredient->term_id );
			$ingredient->icon = get_field( 'ingredient_icon', 'ingredient_' . $ingredient->term_id );
			$ingredient->bg_image = get_field( 'ingredient_image', 'ingredient_' . $ingredient->term_id );
			$ingredient->color = get_field( 'ingredient_background_color', 'ingredient_' . $ingredient->term_id );
			$ingredient->grown_in_text = get_field( 'ingredient_grown_in', 'ingredient_' . $ingredient->term_id );

			$ingredient->icon = $ingredient->icon ? $ingredient->icon['url'] : '/wp-content/uploads/2016/04/generic_ingredient_icon.png';
			$ingredient->bg_image = $ingredient->bg_image ? $ingredient->bg_image['url'] : '/wp-content/uploads/2016/04/generic_ingredient_image.jpg';
			if( ! $ingredient->color ) $ingredient->color = false;//'#3c82c4';
			$this->cache_ingredients[ $ingredient->term_id ] = $ingredient;
			return $ingredient;
		}

		public function set_supplier( $supplier ) {
			if( is_numeric( $supplier ) && array_key_exists( $supplier, $this->cache_suppliers ) ) :
				return $this->cache_suppliers[$supplier];
			elseif( isset( $supplier->ID ) && array_key_exists( $supplier->ID, $this->cache_suppliers ) ) :
				return $this->cache_suppliers[$supplier->ID];
			elseif( is_numeric( $supplier ) ) :
				$supplier = new Supplier( $supplier );
			endif;
			$this->cache_suppliers[ $supplier->ID ] = $supplier;
			return $supplier;
		}

		public function get_block_color( $locations ) {
			foreach( $locations as $location ) :
				foreach( ( explode( ' ', ( str_replace( array( ',' ), '', $location->location->address ) ) ) ) as $section ) :
					if( strlen( $section ) == 2 ) :
						$section = strtoupper( $section );
						foreach( $this->state_colors as $color => $states ) :
							if( in_array( $section, $states ) ) :
								return $color;
							endif;
						endforeach;
					endif;
				endforeach;
			endforeach;
			return '#3c82c4';
		}
	}