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
    
    'MAIN'          => 'Main',
    'SERIES'        => 'Series',
    'DOCUMENTS'     => 'Documents',
    'AUTHORS'       => 'Authors',
    'CATEGORIES'    => 'Categories',
    
    'MODAL_TEXT_CAT_DELETE'         => "Are you sure you want to delete <strong>{0}</strong>?<br />Warning: This will remove the category from all documents.",
    'MODAL_TITLE_CAT_DELETE'        => "Delete category",
    
    
    
    'TITLE_SERIES_CREATE'					=> 'Create Series',
    'TITLE_SERIES_MANAGE'					=> 'Manage Series',
    'TITLE_SERIES_EDIT'						=> 'Edit Series',
    'TITLE_DOCUMENT_CREATE'					=> 'Create Document',
    'TITLE_DOCUMENT_MANAGE'					=> 'Manage Documents',
    'TITLE_DOCUMENT_EDIT'						=> 'Edit Document',
    'TITLE_CATEGORIES_MANAGE'					=> 'Manage Categories',
    'TITLE_AUTHORS_MANAGE'					=> 'Manage Authors',
    'MESSAGE_SERIES_CREATED_SUCCES'			=> 'Successfuly created series: "%1$s"',
    'MESSAGE_DOCUMENT_CREATED_SUCCES'			=> 'Successfuly created document: "%1$s"',
    'MESSAGE_AUTHOR_CREATED_SUCCES'			=> 'Successfuly created author: "%1$s"',
    'MESSAGE_SERIES_CREATED_FAILURE'		=> 'Failed to create series: "%1$s".',
    'MESSAGE_DOCUMENT_CREATED_FAILURE'			=> 'Failed to create document: "%1$s".',
    'MESSAGE_AUTHOR_CREATED_FAILURE'		=> 'Failed to create author: "%1$s".',
    'LABEL_ACTION'							=> 'Action',
    'LABEL_ID'								=> 'ID',
    'LABEL_COMPLETE'						=> 'Complete',
    'LABEL_TITLE'							=> 'Title',
    'LABEL_CHAPTER_TITLE'							=> 'Chapter Title',
    'LABEL_MCPS'							=> 'Mcps',
    'LABEL_COMPLETE'						=> 'Complete',
    'LABEL_RATING'							=> 'Rating',
    'LABEL_SECTION'							=> 'Section',
    'LABEL_GENRES'							=> 'Genres',
    'LABEL_KEYWORDS'						=> 'Keywords',
    'LABEL_URL'								=> 'Url',
    'LABEL_NUMBER'							=> 'Number',
    'LABEL_TEXT'							=> 'Text',
    'LABEL_SERIES'							=> 'Series',
    'LABEL_DOCUMENTS'							=> 'Documents',
    'LABEL_AUTHORS'							=> 'Authors',
    'LABEL_USERNAME'						=> 'Username',
    'LABEL_EMAIL'							=> 'Email',
    'LABEL_WEBSITE'							=> 'Website',
    'LABEL_CATEGORIES'							=> 'Categories',
    'LABEL_DATA'							=> 'Data',
    'OPERATION_RESULT'						=> 'Success',
    'DESCRIPTION_SERIES_CREATE'				=> 'Use this form to create a new series.',
    'DESCRIPTION_SERIES_MANAGE'				=> 'Use this form to manage existing series.',
    'DESCRIPTION_SERIES_EDIT'				=> 'Use this form to edit the documents that make up an existing series.',
    'DESCRIPTION_DOCUMENT_CREATE'				=> 'Use this form to create a new document.',
    'DESCRIPTION_DOCUMENT_MANAGE'				=> 'Use this form to manage existing documents.',
    'DESCRIPTION_DOCUMENT_EDIT'				=> 'Use this form to edit an existing document.',
    'DESCRIPTION_CATEGORIES_MANAGE'			=> 'Use this form to manage lookups and categories.',
    'DESCRIPTION_AUTHORS_MANAGE'			=> 'Use this form to manage authors.',
    'CONFIRM_DELETE_SERIES'					=> 'Are you sure you want to delete the series?',
    'CONFIRM_DELETE_AUTHOR'					=> 'Are you sure you want to delete the author?',
    'CONFIRM_DELETE_FROM_SERIES'			=> 'Are you sure you want to delete the document from the series?',
    'CS_INSTRUCTION_1'						=> 'Please fill out the fields below.',

    // Error messages
    
    // Invalid form submissions
    'ERROR_FORM_EMPTY_MAIN'                                                 => 'The following fields need editing:<br /><br /><ul><li>{0}</li></ul>',
    
    'ERROR_FORM_EMPTY_TITLE'                                                => 'Document title cannot be empty.',
    'ERROR_FORM_EMPTY_AUTHORS'                                              => 'You must select at least one author.',
    'ERROR_FORM_EMPTY_CATEGORIES'                                           => 'All documents must be assigned to at least one category.',
    'ERROR_FORM_EMPTY_CHAPTER_TITLE'                                        => 'Chapter title cannot be empty.',
    'ERROR_FORM_EMPTY_TEXT'                                                 => 'Document text cannot be empty.',
    
    'ERROR_FORM_INVALID_TITLE'                                                => 'Document title is not a string.',
    'ERROR_FORM_INVALID_AUTHORS'                                              => 'Authors must be an integer or an array of integers.',
    'ERROR_FORM_INVALID_CATEGORIES'                                           => 'Categries must be an integer or an array of integers.',
    'ERROR_FORM_INVALID_CHAPTER_TITLE'                                        => 'Chapter title is not a string.',
    'ERROR_FORM_INVALID_TEXT'                                                 => 'Document text is not a string.',
    
    // Dialog Titles
    'DIALOG_TITLE_ERROR_INVALID_FORM_SUBMISSION'                            => 'Invalid Form!',
    
    
    'RECENT_DOCUMENTS'                                      => 'Recent Documens',
));
