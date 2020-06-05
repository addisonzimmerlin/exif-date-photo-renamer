<?php

// The current working directory (i.e., where this script is located)
$cwd = getcwd() . '/';

// Get a list of all files in the current working directory
$files = scandir($cwd);

// For each file...
foreach($files as $file){
	// If the file is not a JPG/JPEG/CR2, or it has already been renamed, skip it
	if(
		preg_match('/\.(JPEG|jpeg|JPG|jpg|CR2|cr2)$/', $file)===0
		||
		preg_match('/^[0-9]+\-[0-9]+\-[0-9]+\-[0-9]+\-[0-9]+\-[0-9]+\-\-/', $file)===1
	) continue;

	// Get the photo's EXIF tags
	$exif_data = exif_read_data("$cwd$file");

	// If the photo does not have any EXIF tags, skip it
	if($exif_data===false) continue;

	// The default value, which represents no date
	$date = -1;

	// An array of EXIF date tags to check
	$date_tags = [
		'DateTimeOriginal',
		'DateTimeDigitized',
		'DateTime',
		'FileDateTime'
	];

	// Check for the EXIF date tags, in the order specified above. First value wins
	foreach($date_tags as $date_tag){
		if(
			isset($exif_data[$date_tag])
		){
			$date = $exif_data[$date_tag];
			break;
		}
	}

	// If no date tags were found, skip this file
	if($date===-1) continue;

	// If the date that was extracted is a string, convert it to an integer
	if( is_string($date) ) $date = strtotime($date);

	// Format the date
	$date = date('Y-m-d-H-i-s', $date);

	// The new filename
	$new_filename = "$date--$file";

	// Output some debugging info
	echo <<<HEREDOC
"$file" renamed to "$new_filename"


HEREDOC;

	// Rename the file
	rename("$cwd$file", "$cwd$new_filename");
}

// Done
echo "Done";

?>