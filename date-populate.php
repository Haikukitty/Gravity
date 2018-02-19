<?php



add_filter('gform_pre_render', 'ups');
 
//Note: when changing drop down values, we also need to use the gform_pre_validation so that the new values are available when validating the field.
add_filter( 'gform_pre_validation', 'ups' );
 
//Note: when changing drop down values, we also need to use the gform_admin_pre_render so that the right values are displayed when editing the entry.
add_filter( 'gform_admin_pre_render', 'ups' );
 
//Note: this will allow for the labels to be used during the submission process in case values are enabled
add_filter( 'gform_pre_submission_filter', 'ups' );
 
function ups( $form ) {
	
	$upss = array('1/5/2018','1/12/2018','1/19/2018','1/26/2018','2/2/2018','2/9/2018','2/16/2018','2/23/2018','3/2/2018','3/9/2018','3/16/2018','3/23/2018','3/30/2018','4/6/2018','4/13/2018','4/20/2018','4/27/2018','5/4/2018','5/11/2018','5/18/2018','5/25/2018','6/1/2018','6/8/2018','6/15/2018','6/22/2018','6/29/2018','7/6/2018','7/13/2018','7/20/2018','7/27/2018','8/3/2018','8/10/2018','8/17/2018','8/24/2018','8/31/2018','9/7/2018','9/14/2018','9/21/2018','9/28/2018','10/5/2018','10/12/2018','10/19/2018','10/26/2018','11/2/2018','11/9/2018','11/16/2018','11/23/2018','11/30/2018','12/7/2018','12/14/2018','12/21/2018','12/28/2018');

	$dtups = new DateTime();
	$dtups->modify('+3 day');

 
    if ( $form['title'] != "Delivery" ) return $form;
 
    foreach ( $form['fields'] as &$field ) {
        if ( $field->type != 'select' || strpos( $field->cssClass, 'ups' ) === false ) {
            continue;
        };
 
        // you can add additional parameters here to alter the posts that are retrieved
        // more info: http://codex.wordpress.org/Template_Tags/get_posts
	
		
		foreach ($upss as $ups){

        $converted_date = DateTime::createFromFormat('n/j/Y', $ups);

    		if ($converted_date >= $dtups){
				

				
				//$converted_date->format('l, n/j/Y');

        	$newupss[]=$ups; 
			}
			//$result = count($newaas);


			$formups = implode("','", $newupss);

}
		
        // update 'Not listed Here' to whatever you'd like the instructive option to be
        $choices = array(array('text' => 'Select Date', 'value' => 0 ));
 
        foreach ( $newupss as $newups ) {
            $choices[] = array( 'text' => $newups, 'value' => $newups, 'isSelected' => false );
        }
 
        $field['choices'] = $choices;
    }
    return $form;
}

?>