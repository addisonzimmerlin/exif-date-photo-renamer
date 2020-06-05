# exif-date-time-photo-renamer

A PHP script that extracts the Exif data from all of the JPG/JPEG/CR2 files in a directory, and adds the date/time each photo was taken to its filename.

## Usage

1. Copy `exif-date-time-photo-renamer.php` to the directory where your photos are located

1. Run it:
	```sh
	php exif-date-time-photo-renamer.php
	```

## Supported File Formats

- JPG
- JPEG
- CR2

## Supported Exif Date/Time Tags

- DateTimeOriginal
- DateTimeDigitized
- DateTime
- FileDateTime

## Ignores

- Photos that don't have any [supported Exif date/time tags](#supported-exif-datetime-tags)
- Photos that have already been renamed (i.e., it is safe to re-run this script, if needed)
- Photos in subdirectories