Find Date in String
=======================

Function to find a date in a string using Regular Expression


### Usage

	$string = "This building was cleaned on the 8th of October 2006 after a huge storm."
	$date = find_date( $string );

	// Return:
	array(
		'day'	=> 08,
		'month'	=> 10,
		'year'	=> 2006
	);


### Other examples:

* 01/01/2012 will return > 01-01-2012
* 30-12-11 will return > 30-12-2011
* 1 2 1985 will return > 01-02-1985
* 10.12.1850 will return > 10-12-1850
* 5 12 85 will return > 05-12-1985
* 5 October 2012 will return > 02-10-2012
* MAY 5th 1985 will return > 05-05-1985
* 1st March 81 will return > 01-03-1981
* March 1st 2015 return > 01-03-2015
* Apr 20 2000 return > 20-04-2000
* Sunday, 24 June 1999 return > 24-06-1999
* Mon 2nd July 1995 return > 02-07-1995
