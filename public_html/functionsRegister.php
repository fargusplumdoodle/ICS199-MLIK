<?php
function checkNameReg($name){
	if ( ! preg_match('/^\w*$/i', $name, $match) || $name == ''){
		return false;
	} else {
		return true;
	}
}

function checkEmailReg($email){
		if ( ! preg_match('/^(\w|\.)+@(\w|\.)+\.[a-z]+$/i', $email, $match) || $email == ''){

			return false;

		} else {
			return true;	
		}
}
function checkForUser($email) {
    //first check that cart contains item
    $dbc = getConnection();
    $query = 'SELECT * FROM ICS199Group07_dev.CUSTOMERS WHERE email = \'' . $email . '\'';

    $r = @mysqli_query($dbc, $query);
    //checking results
    if (mysqli_num_rows($r) == 0) {

        return true;
    } else {
        return false;
    }
}

function checkPostReg($postal){

         //function by Roshan Bhattara(http://roshanbh.com.np)

         if(preg_match("/^([a-ceghj-npr-tv-z]){1}[0-9]{1}[a-ceghj-npr-tv-z]{1}[0-9]{1}[a-ceghj-npr-tv-z]{1}[0-9]{1}$/i",$postal)) {

            return TRUE;

        } else {

            return FALSE;

        }

}
function checkPassReg($pass1, $pass2){
	//checking to see if they are the same
	if ($pass1 != $pass2){
		return array("valid"=>false, "error"=>'Passwords do not match');
	}
	
	//checking password validity
	if (  checkNameReg($pass1) && checkNameReg($pass2)){
	
		return array("valid"=>true, "error"=>'IT WORKED!');
	}

	return array("valid"=>false, "error"=>'Passwords invalid');
	
}

?>
