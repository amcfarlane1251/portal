<?php

$group = elgg_extract("entity", $vars);

echo "<div id='group-tools-related-groups-form'>";
//change limit to restrict the number of groups returned from the search
echo elgg_view("input/related_autocomplete", array("name" => "guid", "limit" => 40, "match_on" => "groups", "placeholder" => elgg_echo("group_tools:related_groups:form:placeholder")));
echo elgg_view("input/hidden", array("name" => "group_guid", "value" => $group->getGUID()));
echo elgg_view("input/submit", array("value" => elgg_echo("add")));
echo "<div class='elgg-subtext'>" . elgg_echo("group_tools:related_groups:form:description") . "</div>";
echo "</div>";
