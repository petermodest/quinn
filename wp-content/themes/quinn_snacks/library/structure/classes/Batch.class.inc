<?
	class Batch extends Post {
		
		var $selected;
		var $snacks;
		var $cache_ingredients = array();
		var $cache_suppliers = array();
		var $blocks = array();
		var $map_overlays = array();
		
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
			foreach( $this->batch_loop as $snack ) :
				if( ( isset( $_GET['flavor'] ) && $snack->snack->ID == $_GET['flavor'] ) || ! isset( $_GET['flavor'] ) ) :
					$this->snacks[$snack->snack->ID] = new Flavor( $snack->snack );
					
					if( isset( $snack->map_overlay->url ) ) :
						$map_overlays[] = $snack->map_overlay->url;
					elseif( isset( $this->snacks[$snack->snack->ID]->url ) ) :
						$map_overlays[] = $this->snacks[$snack->snack->ID]->url;
					endif;

					foreach( $snack->ingredients as $ingredient ) :
						foreach( $ingredient->supplier as $supplier ) :
							$this->set_block( $supplier, $ingredient->ingredient );
						endforeach;
					endforeach;
				endif;
			endforeach;			
		}
		
		public function set_block( $supplier, $ingredient ) {
			$ingredient = $this->set_ingredient( $ingredient );
			$supplier = $this->set_supplier( $supplier );
			$key = $supplier->ID . '-' . $ingredient->term_id;
			if( ! array_key_exists( $key, $this->blocks ) ) :
				$this->blocks[$key] = (object) array(
					'supplier_id'	=> $supplier->ID,
					'ingredient_id'	=> $ingredient->term_id,
					'image'			=> isset( $supplier->featured->url ) ? $supplier->featured : $ingredient->bg_image,
					'website'		=> isset( $supplier->website ) ? $supplier->website : false,
					'icon'			=> $ingredient->icon,
					'color'			=> $ingredient->color,
					'title'			=> $ingredient->name,
					'supplier'		=> $supplier->post_title,
					'location'		=> $supplier->location_name,
					'deep'			=> $supplier->layers_deep,
					'overview'		=> $supplier->short_description,
					'permalink'		=> $supplier->permalink,
					'link'			=> isset( $supplier->link->{0} ) ? 1 : 0
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
			$ingredient->icon = get_field( 'ingredient_icon', 'ingredient_' . $ingredient->term_id );
			$ingredient->bg_image = get_field( 'ingredient_image', 'ingredient_' . $ingredient->term_id );
			$ingredient->color = get_field( 'ingredient_background_color', 'ingredient_' . $ingredient->term_id );
			$ingredient->icon = $ingredient->icon ? $ingredient->icon['url'] : '/wp-content/uploads/2016/04/generic_ingredient_icon.png';
			$ingredient->bg_image = $ingredient->bg_image ? $ingredient->bg_image['url'] : '/wp-content/uploads/2016/04/generic_ingredient_image.jpg';
			if( ! $ingredient->color ) $ingredient->color = '#3c82c4';
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
				
	}