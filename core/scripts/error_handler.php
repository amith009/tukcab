<?php
/********************************************************************************
 * This work is a proprietary creation of pplStuff.com and or its affiliates.	*
 * No part of this file is to be licensed to any being or software and is not	*
 * meant to be used without explicit permissions of the owners.					*
 *																				*
 * Author		:	Nilotpal Barpujari											*
 * Date			:	10-Nov-2011													*
 * File Type	:	PHP Script													*
 * Used in		:	Core Module													*
 ********************************************************************************/
function errorHandler($errno, $errstr, $errfile, $errline)
{
    if (!(error_reporting() & $errno)) {
        // This error code is not included in error_reporting
        return;
    }
	
	var_dump(debug_backtrace());
	//debug_print_backtrace();
	
	exit(0);

    /* Don't execute PHP internal error handler */
    return true;
}

set_error_handler("errorHandler");

?>