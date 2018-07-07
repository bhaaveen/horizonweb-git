<?php
class MB_Conditional_Logic
{
	public function __construct()
	{
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
	}

	/**
	 * Enqueue Conditional Logic script and pass conditional logic values to it
	 * 
	 * @param  String $hook Page
	 * 
	 * @return void
	 */
	public function enqueue( $hook )
	{
		// Only apply for Post New / Edit Post screen
		if ( ! in_array( $hook, array( 'post.php', 'post-new.php' ) ) )
			return;

		$conditions 		= $this->get_all_conditions();

		wp_register_script( 'conditional-logic', MBC_JS_URL . 'conditional-logic.js', array(), '1.0.0', true );
		wp_localize_script( 'conditional-logic', 'conditions', $conditions );	
		wp_enqueue_script( 'conditional-logic' );
	}

	/**
	 * Get all attached conditional logic on fields or meta boxes
	 * 
	 * @return Mixed All attached conditional logic
	 */
	public function get_all_conditions()
	{
		$meta_boxes 		= apply_filters( 'rwmb_meta_boxes', array() );
		$outside_conditions = apply_filters( 'rwmb_outside_conditions', array() );

		$conditions = array();

		foreach ( $meta_boxes as $meta_box )
		{
			if ( ! empty( $meta_box['id'] ) ) 
			{
				$selector = $meta_box['id'];

				if ( ! empty( $meta_box['visible'] ) )
					$conditions[$selector]['visible'] 	= $this->parse_condition( $meta_box['visible'] );

				if ( ! empty( $meta_box['hidden'] ) )
					$conditions[$selector]['hidden'] 	= $this->parse_condition( $meta_box['hidden'] );
			}

			if ( ! empty( $meta_box['fields'] ) )
			{
				foreach ( $meta_box['fields'] as $field )
				{
					if ( ! empty( $field['id'] ) ) 
					{
						$selector = $field['id'];

						if ( ! empty( $field['visible'] ) )
							$conditions[$selector]['visible'] 	=  $this->parse_condition( $field['visible'] );

						if ( ! empty( $field['hidden'] ) )
							$conditions[$selector]['hidden'] 	=  $this->parse_condition( $field['hidden'] );
					}

					// Group
					if ( ! empty( $field['fields'] ) )
					{
						foreach ( $field['fields'] as $sub_field )
						{
							if ( empty( $sub_field['id'] ) ) 
								continue;

							$selector = $sub_field['id'];

							if ( ! empty( $sub_field['visible'] ) )
								$conditions[$selector]['visible'] 	=  $this->parse_condition( $sub_field['visible'] );

							if ( ! empty( $sub_field['hidden'] ) )
								$conditions[$selector]['hidden'] 	=  $this->parse_condition( $sub_field['hidden'] );
						}
					}
				}
			}
		}

		foreach ( $outside_conditions as $field_id => $field_conditions )
		{
			if ( empty( $field_id ) ) 
				continue;

			if ( ! empty( $field_conditions['visible'] ) )
				$conditions[$field_id]['visible'] = $this->parse_condition( $field_conditions['visible'] );

			if ( ! empty( $field_conditions['hidden'] ) )
				$conditions[$field_id]['hidden'] = $this->parse_condition( $field_conditions['hidden'] );
		}

		return $conditions;	
	}

	/**
	 * Parse various style of a collection to JS readable
	 * 
	 * @param  Mixed $condition Condition
	 * 
	 * @return Array
	 */
	public function parse_condition( $condition )
	{
		if ( ! is_array( $condition ) ) 
			return;

		$relation = ( isset( $condition['relation'] ) && in_array( $condition['relation'], array('and', 'or') ) ) 
					? $condition['relation'] : 'and';

		$when = array();

		if ( isset( $condition['when'] ) && is_array( $condition['when'] ) )
		{
			foreach ( $condition['when'] as $criteria )
			{
				if ( is_array( $criteria ) )
				{
					$when[] = $this->normalize_criteria( $criteria );
				}
				else 
				{
					$when[] = $this->normalize_criteria( $condition['when'] );
					break;
				}
			}
		}
		else
		{
			foreach ( $condition as $criteria )
			{
				if ( is_array( $criteria ) )
				{
					$when[] = $this->normalize_criteria( $criteria );
				}
				else 
				{
					$when[] = $this->normalize_criteria( $condition );
					break;
				}
			}
		}

		return compact( 'when', 'relation' );
	}

	/**
	 * If criteria has different format than normally, reformat it
	 * 
	 * @param  array $criteria Criteria to be formatted
	 * @return array Criteria after formatted
	 */
	public function normalize_criteria( $criteria )
	{
		if ( count( $criteria ) === 2 )
			$criteria = array($criteria[0], '=', $criteria[1]);

		return $criteria;
	}
}