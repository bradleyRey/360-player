<?php
    $importedFile = get_field('csv_file');
    $file = get_attached_file( $importedFile['id'] );
	$array = $fields = array();
	$i = 0;
	if ( ( $handle = fopen( $file, "r" ) ) !== FALSE ) {
		while ( ( $row = fgetcsv( $handle, 4096)) !== FALSE) {
			if ( empty( $fields ) ) {
				$fields = $row;
				continue;
			}
			foreach ($row as $k=>$value) {
				$array[$i][$fields[$k]] = $value;
			}
			$i++;
		}
		if ( ! feof( $handle ) ) {
			echo "Error: unexpected fgets() fail\n";
		}
		fclose( $handle );
        //var_dump( $array );
	}
    foreach ( $array as $key => $single ) :
        $value = $single['Std_ID'];
        if ( $value === $_GET['id'] ):
            $id = $single;
//    var_dump($id['Course']);
//    die;
        endif;
    endforeach;
?>
