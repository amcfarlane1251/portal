<?php
/**
 * Elgg file download.
 *
 * @package ElggFile
 */

// Get the guid
$file_guid = get_input("guid");

// Get the file
// ignore access to check if file is part of an open group
$ia = elgg_set_ignore_access(true);
$f = get_entity($file_guid);
$container = get_entity($f->container_guid);
if($container) {
	if($container instanceof ElggGroup) {
		elgg_set_ignore_access($ia);
		if($container->membership == 2) {
			elgg_set_ignore_access(true);
		}
	}
}

$file = get_entity($file_guid);
if (!$file) {
	register_error(elgg_echo("file:downloadfailed"));
	forward();
}

$mime = $file->getMimeType();
if (!$mime) {
	$mime = "application/octet-stream";
}

$filename = $file->originalfilename;

// fix for IE https issue
header("Pragma: public");

header("Content-type: $mime");
if (strpos($mime, "image/") !== false || $mime == "application/pdf") {
	header("Content-Disposition: inline; filename=\"$filename\"");
} else {
	header("Content-Disposition: attachment; filename=\"$filename\"");
}

ob_clean();
flush();
readfile($file->getFilenameOnFilestore());
elgg_set_ignore_access($ia);
exit;
