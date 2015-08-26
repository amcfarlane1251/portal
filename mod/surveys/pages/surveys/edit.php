<?php
/**
 * edit a submission
 * @package ElggPages
*/
gatekeeper();

$survey_guid = get_input('guid');

$survey = get_entity($survey_guid);

