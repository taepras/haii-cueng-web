<?php

function displayVar($text){
	if(isset($text) && $text)
		return $text;
	else
		return 'N/A';
}
