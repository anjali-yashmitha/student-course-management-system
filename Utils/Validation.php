<?php

class Validation
{
	static function clean($str)
	{
		$str = trim($str);
		$str = stripcslashes($str);
		$str = htmlspecialchars($str);
		return $str;
	}

	static function name($str)
	{
		# Letters Only 
		$name_regex = "/^([a-zA-Z' ]+)$/";
		if (preg_match($name_regex, $str))
			return true;
		else
			return false;
	}
	static function username($str)
	{
		// Allow usernames 3-20 characters long
		// Must start with letter
		// Can contain letters, numbers, underscore
		$username_regex = "/^[A-Za-z][A-Za-z0-9_]{2,19}$/";

		if (empty($str)) {
			return ["valid" => false, "error" => "Username cannot be empty"];
		}

		if (strlen($str) < 3) {
			return ["valid" => false, "error" => "Username must be at least 3 characters long"];
		}

		if (strlen($str) > 20) {
			return ["valid" => false, "error" => "Username cannot be longer than 20 characters"];
		}

		if (!preg_match($username_regex, $str)) {
			return ["valid" => false, "error" => "Username must start with a letter and can only contain letters, numbers, and underscore"];
		}

		return ["valid" => true, "error" => null];
	}
	static function email($str)
	{
		if (filter_var($str, FILTER_VALIDATE_EMAIL))
			return true;
		else
			return false;
	}
	static function password($str)
	{
		/*
					 -> Has minimum 4 characters in length. Adjust it by modifying {4,}

					-> At least one uppercase English letter. (?=.*?[A-Z])
					 At least one lowercase English letter.  (?=.*?[a-z])
					-> At least one digit. (?=.*?[0-9])
					-> At least one special character, (?=.*?[#?!@$%^&*-])
					
					
					*/

		// $password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{4,}$/"; 

		// if (preg_match($password_regex, $str)) 
		if (!empty($str))
			return true;
		else
			return false;
		// else return false;
	}
	static function match($str1, $str2)
	{
		if ($str1 === $str2)
			return true;
		else
			return false;
	}

}