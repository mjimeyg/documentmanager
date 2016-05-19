<?php
/**
*
* @package Document Manager Extension
* @copyright (c) 2016 mjimeyg
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mjimeyg\documentmanager\migrations;

class version_1_0_0 extends \phpbb\db\migration\migration
{
    
    public function update_schema() {
        return array(
            'add_tables'        => array(
                $this->table_prefix . 'series'  => array(
                    'COLUMNS'   => array(
                        'series_id'             => array('UINT', NULL, 'auto_increment'),
                        'series_title'          => array('VCHAR_UNI:255', ''),
                        'series_complete'       => array('UINT:1', 0),
                    ),
                    'PRIMARY_KEY'  => 'series_id',
                ),
                $this->table_prefix . 'documents'  => array(
                    'COLUMNS'   => array(
                        'document_id'           => array('UINT', NULL, 'auto_increment'),
                        'document_title'        => array('VCHAR_UNI:255', ''),
                        'document_complete'     => array('UINT:1', 0),
                        'document_uploaded'     => array('TIMESTAMP', 0),
                        'document_updated'      => array('TIMESTAMP', 0),
                    ),
                    'PRIMARY_KEY'  => 'document_id',
                ),
                $this->table_prefix . 'documents_series_link'  => array(
                    'COLUMNS'   => array(
                        'id'                    => array('UINT', NULL, 'auto_increment'),
                        'series_id'             => array('UINT', NULL, ''),
                        'document_id'           => array('UINT', NULL, ''),
                        'series_index'          => array('UINT:1', 0),
                    ),
                    'PRIMARY_KEY'  => 'id',
                ),
                $this->table_prefix . 'chapters'  => array(
                    'COLUMNS'   => array(
                        'chapter_id'            => array('UINT', NULL, 'auto_increment'),
                        'document_id'           => array('UINT', NULL, ''),
                        'document_index'        => array('UINT', 0),
                        'chapter_title'         => array('VCHAR_UNI:255', ''),
                        'chapter_uploaded'      => array('TIMESTAMP', 0),
                        'chapter_updated'       => array('TIMESTAMP', 0),
                        'chapter_text'          => array('MTEXT_UNI', ''),
                    ),
                    'PRIMARY_KEY'  => 'chapter_id',
                ),
                $this->table_prefix . 'documents_authors_link'  => array(
                    'COLUMNS'   => array(
                        'id'                    => array('UINT', NULL, 'auto_increment'),
                        'user_id'               => array('UINT', NULL, ''),
                        'document_id'           => array('UINT', NULL, ''),
                        'document_index'        => array('UINT:1', 0),
                        'primary_author'        => array('UINT:1', 1),
                        'contributing_author'   => array('UINT:1', 0),
                    ),
                    'PRIMARY_KEY'  => 'id',
                ),
                $this->table_prefix . 'categories'  => array(
                    'COLUMNS'   => array(
                        'category_id'                    => array('UINT', NULL, 'auto_increment'),
                        'category_title'               => array('VCHAR_UNI:255', ''),
                        'category_parent'           => array('UINT', NULL, ''),
                        'category_has_children'        => array('UINT:1', 0),
                    ),
                    'PRIMARY_KEY'  => 'category_id',
                ),
                $this->table_prefix . 'documents_categories_link'  => array(
                    'COLUMNS'   => array(
                        'id'                    => array('UINT', NULL, 'auto_increment'),
                        'document_id'                    => array('UINT', NULL, ''),
                        'category_id'                    => array('UINT', NULL, ''),
                    ),
                    'PRIMARY_KEY'  => 'id',
                ),
                
            ),
        );
    }
    
    public function revert_schema() {
        return array(
            'drop_tables'   => array(
                $this->table_prefix . 'series',
                $this->table_prefix . 'documents',
                $this->table_prefix . 'series_documents_link',
                $this->table_prefix . 'chapters',
                $this->table_prefix . 'documents_authors_link',
                $this->table_prefix . 'categories',
                $this->table_prefix . 'documents_categories_link',
            ),
        );
    }
    
    public function update_data()
    {
            return array(
                array('config.add', array('documentmanager_enable_user_submissions', 1)),
                array('config.add', array('documentmanager_require_moderator_approval', 1)),

                array('module.add', array(
                    'acp',
                    'ACP_CAT_DOT_MODS',
                    'ACP_DOCUMENTMANAGER_MOD',
                )),

                array('module.add', array(
                    'acp',
                    'ACP_DOCUMENTMANAGER_MOD',
                    array(
                        'module_basename'   => '\mjimeyg\documentmanager\acp\settings_module',
                        'modes'             => array('settings'),
                    )
                )),

            );
    }
}
