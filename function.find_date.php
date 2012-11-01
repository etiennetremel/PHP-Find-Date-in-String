<?php
/**
 * Find Date in a String
 *
 * @author   Etienne Tremel
 * @license  http://creativecommons.org/licenses/by/3.0/ CC by 3.0
 * @link     http://www.etiennetremel.net
 *
 * @param string	find_date( ' some text 01/01/2012 some text' ) or find_date( ' some text October 5th 86 some text' )
 * @return mixed	false if no date found else array: array( 'day' => 01, 'month' => 01, 'year' => 2012 )
 */
function find_date( $string ) {

	//Define month name:
	$month_names = array( 
		"january",
		"february",
		"march",
		"april",
		"may",
		"june",
		"july",
		"august",
		"september",
		"october",
		"november",
		"december"
	);

	$month_number=$month=$matches_year=$year=$matches_month_number=$matches_month_word=$matches_day_number="";
	
	//Match dates: 01/01/2012 or 30-12-11 or 1 2 1985
	preg_match( '/([0-9]?[0-9])[\.\-\/ ]?([0-1]?[0-9])[\.\-\/ ]?([0-9]{2,4})/', $string, $matches );
	if ( $matches ) {
		if ( $matches[1] )
			$day = $matches[1];

		if ( $matches[2] )
			$month = $matches[2];

		if ( $matches[3] )
			$year = $matches[3];
	}

	//Match month name:
	preg_match( '/(' . implode( '|', $month_names ) . ')/i', $string, $matches_month_word );

	if ( $matches_month_word ) {
		if ( $matches_month_word[1] )
			$month = array_search( strtolower( $matches_month_word[1] ),  $month_names ) + 1;
	}

	//Match 5th 1st day:
	preg_match( '/([0-9]?[0-9])(st|nd|th)/', $string, $matches_day );
	if ( $matches_day ) {
		if ( $matches_day[1] )
			$day = $matches_day[1];
	}

	//Match Year if not already setted:
	if ( empty( $year ) ) {
		preg_match( '/[0-9]{4}/', $string, $matches_year );
		if ( $matches_year[0] )
			$year = $matches_year[0];
	}
	if ( ! empty ( $day ) && ! empty ( $month ) && empty( $year ) ) {
		preg_match( '/[0-9]{2}/', $string, $matches_year );
		if ( $matches_year[0] )
			$year = $matches_year[0];
	}

	//Leading 0
	if ( 1 == strlen( $day ) )
		$day = '0' . $day;

	//Leading 0
	if ( 1 == strlen( $month ) )
		$month = '0' . $month;

	//Check year:
	if ( 2 == strlen( $year ) && $year > 20 )
		$year = '19' . $year;
	else if ( 2 == strlen( $year ) && $year < 20 )
		$year = '20' . $year;

	$date = array(
		'year' 	=> $year,
		'month' => $month,
		'day' 	=> $day
	);

	//Return false if nothing found:
	if ( empty( $year ) && empty( $month ) && empty( $day ) )
		return false;
	else
		return $date;
}
?>