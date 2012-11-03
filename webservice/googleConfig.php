<?php

//API KEY = AIzaSyBxxm__Wtz94ygdXc0pKDj5Qh3u_XsbEmk;
//API KEY = AIzaSyAJxwOJn0Sdf1f8QFK8kCAQq5BZHJWpSuM;  
//Define Yahoo APIs Here
$queryString_googleSearch="https://maps.googleapis.com/maps/api/place/textsearch/xml?query=%s&sensor=true&key=AIzaSyCuJ9QLwZ3Vo45QMcvOoq6myrjv--4eNQU";

$queryString_citySearch="https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=%s,%s&radius=500&types=&name=pizza&sensor=false&key=AIzaSyCuJ9QLwZ3Vo45QMcvOoq6myrjv--4eNQU";

$offerArr = array(
                  'Buy 1 Get 1',
				  'up to 50 % Discounts',
				  'Buy 1 Get 1 offer',
				  'Discounts up to 30 %',
				  '25% off on each item',
				  'up to 20 % Discounts',
				  'Buy 2 & Get 1 offer',
				  );
				  
$GurgaonArr = array(
                    array("SmileID"=>"1",
					"Title"=>"Deal Smile",
					"Description"=>"Buy 1 Get 1 Pizza",
					"DealerName"=>"Pizza Hut",
					"LocationName"=>"sector 55 Gurgaon",
					"Country"=>"India",
					"State"=>"Hariyana",
					"Locality"=>"Gurgaon",
					"ClosestAddress"=>"sector 55 Gurgaon",
					"Latitude"=>"28.425279",
					"Longitude"=>"77.106664")
					,
					array("SmileID"=>"1",
					"Title"=>"Deal Smile",
					"Description"=>"Discounts up to 10 %",
					"DealerName"=>"Audi",
					"LocationName"=>"Audi, secter 53 Gurgaon",
					"Country"=>"India",
					"State"=>"Hariyana",
					"Locality"=>"Gurgaon",
					"ClosestAddress"=>"secter 53 Gurgaon",
					"Latitude"=>"28.433039",
					"Longitude"=>"77.105135")
					,
					array("SmileID"=>"1",
					"Title"=>"Deal Smile",
					"Description"=>"Buy 1 Get 1 Pizza",
					"DealerName"=>"Pizza Hut",
					"LocationName"=>"sun city Gurgaon",
					"Country"=>"India",
					"State"=>"Hariyana",
					"Locality"=>"Gurgaon",
					"ClosestAddress"=>"sun city Gurgaon",
					"Latitude"=>"28.433039",
					"Longitude"=>"77.105135")
					,
					array("SmileID"=>"1",
					"Title"=>"Deal Smile",
					"Description"=>"Buy 1 Get 1 Pizza",
					"DealerName"=>"Pizza Hut",
					"LocationName"=>"sector 57 Gurgaon",
					"Country"=>"India",
					"State"=>"Hariyana",
					"Locality"=>"Gurgaon",
					"ClosestAddress"=>"",
					"Latitude"=>"28.436011",
					"Longitude"=>"77.110402")
					,
					array("SmileID"=>"1",
					"Title"=>"Deal Smile",
					"Description"=>"Buy 1 Get 1 Pizza",
					"DealerName"=>"Pizza Hut",
					"LocationName"=>"sector 61 Gurgaon",
					"Country"=>"India",
					"State"=>"Hariyana",
					"Locality"=>"Gurgaon",
					"ClosestAddress"=>"sector 61 Gurgaon",
					"Latitude"=>"28.409445",
					"Longitude"=>"77.095313")
					);

?>