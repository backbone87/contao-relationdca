<?php

$GLOBALS['TL_DCA']['tl_backboneit_relationdca_test_foreign'] = array(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
	),

	// List
	'list'  => array
	(
		'sorting' => array
		(
			'mode'                    => 1,
			'fields'                  => array('name'),
			'panelLayout'             => 'limit',
			'disableGrouping'	=> true,
		),
		'label' => array
		(
			'fields'                  => array('tstamp', 'name'),
			'format'                  => '<span style="color:#b3b3b3; padding-right:3px;">[%s]</span> %s',
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();" accesskey="e"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'href'                => 'act=edit',
				'icon'                => 'edit.gif',
			),
			'delete' => array
			(
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
			),
			'show' => array
			(
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),
	
	'palettes' => array(
		'default' => 'name;'
//			. '{onetoone},onetooneOwn,onetooneForeign,onetooneJoinTable;'
//			. '{manytoone},manytooneOwn,manytooneJoinTable;'
//			. '{onetomany},onetomanyForeign,onetomanyJoinTable;'
//			. '{manytomany},manytomanyJoinTable'
	),

	// Fields
	'fields' => array
	(
		'name' => array
		(
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255)
		),
//		'onetooneOwn' => array
//		(
//			'inputType'	=> 'select',
//			'foreignKey'=> 'tl_backboneit_relationdca_test_foreign.name', 
//			'eval'		=> array(
//			),
//			RelationDCA::RELATION		=> RelationDCA::ONE_TO_ONE,					// required
////			RelationDCA::OWN_TABLE		=> 'tl_backboneit_relationdca_test_own',	// fixed
////			RelationDCA::OWN_KEY		=> 'id',									// default
//			RelationDCA::FOREIGN_TABLE	=> 'tl_backboneit_relationdca_test_foreign',// required
////			RelationDCA::FOREIGN_KEY	=> 'id',									// default
////			RelationDCA::JOIN_TABLE		=> 'tl_backboneit_relationdca_test_own',	// implicit
////			RelationDCA::OWN_KEY_COL	=> 'id',									// implicit
//			RelationDCA::FOREIGN_KEY_COL=> 'onetoone',								// required
//			RelationDCA::TIMESTAMP_COL	=> true, //'tstamp',						// optional
////			RelationDCA::UNIQUE			=> RelationDCA::UNIQUE_OVERWRITE,			// default
////			RelationDCA::NULL_VALUE		=> 0,										// default
////			RelationDCA::KEYCHECK		=> RelationDCA::KEYCHECK_SILENT,			// default
////			RelationDCA::ATTRIBUTES		=> array(),									// default
////			RelationDCA::CASCADE_DELETE	=> false,									// unused
////			RelationDCA::NO_CB_REG		=> false,									// default
//			RelationDCA::SCHEMACHECK	=> true,									// explicit
//		),
//		'onetooneForeign' => array
//		(
//			'inputType'	=> 'select',
//			'foreignKey'=> 'tl_backboneit_relationdca_test_foreign.name', 
//			'eval'		=> array(
//			),
//			RelationDCA::RELATION		=> RelationDCA::ONE_TO_ONE,					// required
////			RelationDCA::OWN_TABLE		=> 'tl_backboneit_relationdca_test_own',	// fixed
////			RelationDCA::OWN_KEY		=> 'id',									// default
//			RelationDCA::FOREIGN_TABLE	=> 'tl_backboneit_relationdca_test_foreign',// required
////			RelationDCA::FOREIGN_KEY	=> 'id',									// default
////			RelationDCA::JOIN_TABLE		=> 'tl_backboneit_relationdca_test_foreign',// implicit
//			RelationDCA::OWN_KEY_COL	=> 'onetoone',								// required
////			RelationDCA::FOREIGN_KEY_COL=> 'id',									// implicit
//			RelationDCA::TIMESTAMP_COL	=> true, //'tstamp',						// optional
////			RelationDCA::UNIQUE			=> RelationDCA::UNIQUE_OVERWRITE,			// default
////			RelationDCA::NULL_VALUE		=> 0,										// default
////			RelationDCA::KEYCHECK		=> RelationDCA::KEYCHECK_SILENT,			// default
////			RelationDCA::ATTRIBUTES		=> array(),									// default
////			RelationDCA::CASCADE_DELETE	=> false,									// unused
////			RelationDCA::NO_CB_REG		=> false,									// default
//			RelationDCA::SCHEMACHECK	=> true,									// explicit
//		),
//		'onetooneJoinTable' => array
//		(
//			'inputType'	=> 'select',
//			'foreignKey'=> 'tl_backboneit_relationdca_test_foreign.name', 
//			'eval'		=> array(
//			),
//			RelationDCA::RELATION		=> RelationDCA::ONE_TO_ONE,					// required
////			RelationDCA::OWN_TABLE		=> 'tl_backboneit_relationdca_test_own',	// fixed
////			RelationDCA::OWN_KEY		=> 'id',									// default
//			RelationDCA::FOREIGN_TABLE	=> 'tl_backboneit_relationdca_test_foreign',// required
////			RelationDCA::FOREIGN_KEY	=> 'id',									// default
//			RelationDCA::JOIN_TABLE		=> 'tl_backboneit_relationdca_test_onetoone',// explicit
//			RelationDCA::OWN_KEY_COL	=> 'ownCol',								// required
//			RelationDCA::FOREIGN_KEY_COL=> 'foreignCol',							// required
//			RelationDCA::TIMESTAMP_COL	=> true, //'tstamp',						// optional
////			RelationDCA::UNIQUE			=> RelationDCA::UNIQUE_OVERWRITE,			// default
////			RelationDCA::NULL_VALUE		=> 0,										// default
////			RelationDCA::KEYCHECK		=> RelationDCA::KEYCHECK_SILENT,			// default
////			RelationDCA::ATTRIBUTES		=> array(),									// default
////			RelationDCA::CASCADE_DELETE	=> false,									// default
////			RelationDCA::NO_CB_REG		=> false,									// default
//			RelationDCA::SCHEMACHECK	=> true,									// explicit
//		),
//		'manytomanyJoinTable' => array
//		(
//			'inputType'	=> 'select',
//			'foreignKey'=> 'tl_backboneit_relationdca_test_foreign.name', 
//			'eval'		=> array(
//				'multiple'	=> true,
//			),
//			RelationDCA::RELATION		=> RelationDCA::MANY_TO_MANY,				// required
////			RelationDCA::OWN_TABLE		=> 'tl_backboneit_relationdca_test_own',	// fixed
////			RelationDCA::OWN_KEY		=> 'id',									// default
//			RelationDCA::FOREIGN_TABLE	=> 'tl_backboneit_relationdca_test_foreign',// required
////			RelationDCA::FOREIGN_KEY	=> 'id',									// default
//			RelationDCA::JOIN_TABLE		=> 'tl_backboneit_relationdca_test_manytomany',// required
//			RelationDCA::OWN_KEY_COL	=> 'ownCol',								// required
//			RelationDCA::FOREIGN_KEY_COL=> 'foreignCol',							// required
//			RelationDCA::TIMESTAMP_COL	=> true, //'tstamp',						// optional
////			RelationDCA::UNIQUE			=> RelationDCA::UNIQUE_OVERWRITE,			// unused
////			RelationDCA::NULL_VALUE		=> 0,										// unused
////			RelationDCA::KEYCHECK		=> RelationDCA::KEYCHECK_SILENT,			// default
////			RelationDCA::ATTRIBUTES		=> array(),									// default
////			RelationDCA::CASCADE_DELETE	=> false,									// default
////			RelationDCA::NO_CB_REG		=> false,									// default
//			RelationDCA::SCHEMACHECK	=> true,									// explicit
//		),
	)
);
