<?php

function fullUrl() {
	if (strpos(env('APP_URL'), 'https://') !== false)
        return str_replace('http://', 'https://', request()->fullUrl());
    else
    	return request()->fullUrl();
}

function previousUrl() {
	if (strpos(env('APP_URL'), 'https://') !== false)
        return str_replace('http://', 'https://', url()->previous());
    else
    	return url()->previous();
}
