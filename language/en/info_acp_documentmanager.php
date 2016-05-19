<?php

/**
*
* @package Document Manager Extension
* @copyright (c) 2016 mjimeyg
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
    
        'ACP_DOCUMENTMANAGER_MOD'                               => 'Document Manager',
        'ACP_DOCUMENTMANAGER_SETTINGS'                                          => 'Settings',
	
	'DOCUMENTMANAGER'					=> 'Document Manager',

	'DOCUMENTMANAGER_EXPLAIN'				=> 'You can change the Document Manager board settings for Moderators and Users here.',

	
	'DOCUMENTMANAGER_ENABLE_USER_SUBMISSIONS'		=> 'Enable user submissions',
	'DOCUMENTMANAGER_ENABLE_USER_SUBMISSIONS_EXPLAIN'	=> 'Allow users to submit their own documents.',
    
	'DOCUMENTMANAGER_REQUIRE_MODERATOR_APPROVAL'		=> 'Require Moderator approval',
        'DOCUMENTMANAGER_REQUIRE_MODERATOR_APPROVAL_EXPLAIN'		=> 'All user submitted documents will require Moderator approval.',

	
));
