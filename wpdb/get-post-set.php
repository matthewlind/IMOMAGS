<?php
include "ps-queries.php";

header('Content-type: application/json');

$siteID["www.gunsandammo.com"] = 2;
$siteID["www.handgunsmag.com"] = 9;
$siteID["www.shootingtimes.com"] = 11;
$siteID["www.rifleshootermag.com"] = 10;
$siteID["www.shotgunnews.com"] = 12;
$siteID["www.bowhunter.com"] = 3;
$siteID["www.bowhuntingmag.com"] = 4;
$siteID["www.gundogmag.com"] = 5;
$siteID["www.northamericanwhitetail.com"] = 6;
$siteID["www.petersenshunting.com"] = 7;
$siteID["www.wildfowlmag.com"] = 8;
$siteID["www.gameandfishmag.com"] = 14;
$siteID["www.floridasportsman.com"] = 13;
$siteID["www.in-fisherman.com"] = 15;
$siteID["www.flyfisherman.com"] = 16;



$domain = $_SERVER['HTTP_HOST'];

$domain = str_replace(".deva", ".com", $domain);
$domain = str_replace(".fox", ".com", $domain);
$domain = str_replace(".salah", ".com", $domain);
$domain = str_replace(".devb", ".com", $domain);
$domain = str_replace(".devc", ".com", $domain);


$currentSiteID = $siteID[$domain];

$setID = $_GET['setID'];

$setData = get_set_data($currentSiteID,$setID);

echo json_encode($setData);


