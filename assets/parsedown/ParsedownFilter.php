<?php
	#
	#
	# ParsedownFilter
	#
	# An extension for Parsedown ( http://parsedown.org ) and ParsedownExtra ( https://github.com/erusev/parsedown-extra )
	#
	# Written by Christopher Andrews ( http://arduino.land/ )
	# Released under GPL & MIT licenses.
	#



	class ParsedownFilter extends ParsedownExtra{

		private $tagCallback;

		function __construct( $tag_Callback ){
			$this->tagCallback = $tag_Callback;
		}


		protected function element(array $Element){

			if( isset( $this->tagCallback ) ){

				if( is_array( $Element ) ){

					if( is_string( $Element[ 'name' ] ) ){

						$strf = $this->tagCallback;
						$result = $strf( $Element );

						if( $result === false ){
							//Remove tag.
						}
					}
				}
			}
			//Return result using modified values.
			return parent::element( $Element );
		}
	};
	/*
	class ParsedownFilterExtra extends ParsedownExtra{

		private $tagCallback;

		function __construct( $tag_Callback ){
			$this->tagCallback = $tag_Callback;
		}


		protected function element(array $Element){

			if( isset( $this->tagCallback ) ){

				if( is_array( $Element ) ){

					if( is_string( $Element[ 'name' ] ) ){

						$strf = $this->tagCallback;
						$result = $strf( $Element );

						if( $result === false ){
							//Remove tag.
						}
					}
				}
			}
			//Return result using modified values.
			return parent::element( $Element );
		}
	};	*/
?>
