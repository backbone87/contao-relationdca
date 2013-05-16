<?php

$GLOBALS['BE_MOD'] = array_merge(
	array(
		'backboneit_relationdca_test' => array(
			'own' => array(
				'tables' => array('tl_backboneit_relationdca_test_own'),
			),
			'foreign' => array(
				'tables' => array('tl_backboneit_relationdca_test_foreign'),
			),
		),
	),
	$GLOBALS['BE_MOD']
);
