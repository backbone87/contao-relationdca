<?php

class RelationDCA extends Backend {

	/**
	 * Denotes the configuration key for the relation type.
	 * Relation type could be one of: one-to-one, one-to-many, many-to-one,
	 * many-to-many
	 * In a one-to-one relation at least one of own key column or foreign key
	 * column must be given.
	 *
	 * @var string
	 */
	const RELATION			= 'bbit_rdca_relation';

	/**
	 * Denotes the configuration key for the owning table.
	 * Is set automatically to this DCAs table.
	 *
	 * @var string
	 */
	const OWN_TABLE			= 'bbit_rdca_ownTable';
	/**
	 * Denotes the configuration key for the owning table's PK.
	 * Defaults to "id".
	 *
	 * @var string
	 */
	const OWN_KEY			= 'bbit_rdca_ownKey';

	/**
	 * Denotes the configuration key for the foreign table.
	 * Required.
	 *
	 * @var string
	 */
	const FOREIGN_TABLE		= 'bbit_rdca_foreignTable';
	/**
	 * Denotes the configuration key for the foreign table's PK.
	 * Defaults to "id".
	 *
	 * @var string
	 */
	const FOREIGN_KEY		= 'bbit_rdca_foreignKey';

	/**
	 * Denotes the configuration key for the join table.
	 * Required for many-to-many relations, optional otherwise.
	 * If left out in one-to-many or many-to-one this will become the foreign or
	 * own table respectively.
	 * If left out in one-to-one and OWN_KEY_COL given this will become the
	 * foreign table. If left out in one-to-one and FOREIGN_KEY_COL given this
	 * will become the own table.
	 *
	 * @var string
	 */
	const JOIN_TABLE		= 'bbit_rdca_joinTable';
	/**
	 * Denotes the configuration key for the join table's column, which
	 * references the own key.
	 * Required for many-to-many and one-to-many relations, optional otherwise.
	 * Has no effect, if the own table is the join table (could be the case
	 * in one-to-one and many-to-one only).
	 *
	 * @var string
	 */
	const OWN_KEY_COL		= 'bbit_rdca_ownKeyCol';
	/**
	 * Denotes the configuration key for the join table's column, which
	 * references the foreign key.
	 * Required for many-to-many and many-to-one relations, optional otherwise.
	 * Has no effect, if the foreign table is the join table (could be the case
	 * in one-to-one and one-to-many only).
	 *
	 * @var string
	 */
	const FOREIGN_KEY_COL	= 'bbit_rdca_foreignKeyCol';

	/**
	 * Denotes the configuration key for the join table's timestamp column.
	 * Optional. Defaults to "tstamp".
	 * If set to true or a column reference within the join table, this column
	 * is updated whenever an update is made to the join table.
	 *
	 * @var string
	 */
	const TIMESTAMP_COL		= 'bbit_rdca_timestampCol';
	/**
	 * Denotes the configuration key for the uniqueness strategy.
	 * Optional. Defaults to "overwrite".
	 * Has no effect in many-to-many relations.
	 *
	 * @var string
	 */
	const UNIQUE			= 'bbit_rdca_unique';
	/**
	 * Denotes the configuration key for the null value to be used if unique is
	 * configured to overwrite.
	 * Optional. Defaults to "0".
	 * Has no effect, if the join table differs from own table and foreign
	 * table.
	 *
	 * @var string
	 */
	const NULL_VALUE		= 'bbit_rdca_nullValue';
	/**
	 * Denotes the configuration key for the keycheck strategy.
	 * Optional. Defaults to "silent".
	 * Checks if the join tables columns, which references the foreign and own
	 * PKs have valid related entitys.
	 *
	 * @var string
	 */
	const KEYCHECK			= 'bbit_rdca_keycheck';
	/**
	 * Denotes the configuration key for the attributes to argument the
	 * relation.
	 * Optional. Defaults to the empty array.
	 *
	 * @var string
	 */
	const ATTRIBUTES		= 'bbit_rdca_attributes';
	/**
	 * Denotes the configuration key for the deletion cascade.
	 * Optional. Defaults to false.
	 * Deletes incomplete datasets within the join table, if and only if the
	 * join table is not the own table and not the foreign table.
	 *
	 * @var string
	 */
	const CASCADE_DELETE	= 'bbit_rdca_cascadeDelete';//

	/**
	 * Denotes the configuration key to disable the automatic callback
	 * registration for the fields load and save callback.
	 * Optional. Defaults to false.
	 * If enabled the fields load and save callback must be set manually to
	 * execute RelationDCA::callbackFieldLoad and RelationDCA::callbackFieldSave
	 * respectively.
	 *
	 * @var string
	 */
	const NO_CB_REG			= 'bbit_rdca_noCallbackReg';
	/**
	 * Denotes the configuration key for the schema check.
	 * Optional. Defaults to false. Recommended while development.
	 * Checks the DB's schema against the relation configuration.
	 *
	 * @var string
	 */
	const SCHEMACHECK		= 'bbit_rdca_schemacheck';//

	/**
	 * Denotes the configuration value for many-to-many relations for the
	 * "bbit_rdca_relation" configuration key.
	 *
	 * @var string
	 */
	const RELATION_MANY_TO_MANY	= 'storeManyToManyRelation';
	/**
	 * Denotes the configuration value for one-to-many relations for the
	 * "bbit_rdca_relation" configuration key.
	 *
	 * @var string
	 */
	const RELATION_ONE_TO_MANY	= 'storeOneToManyRelation';
	/**
	 * Denotes the configuration value for many-to-one relations for the
	 * "bbit_rdca_relation" configuration key.
	 *
	 * @var string
	 */
	const RELATION_MANY_TO_ONE	= 'storeManyToOneRelation';
	/**
	 * Denotes the configuration value for one-to-one relations for the
	 * "bbit_rdca_relation" configuration key.
	 *
	 * @var string
	 */
	const RELATION_ONE_TO_ONE	= 'storeOneToOneRelation';

	/**
	 * Denotes the configuration value for overwriting existing relations to
	 * fulfill uniqueness for the "bbit_rdca_unique" configuration key.
	 * Suppose following existing one-to-one relations:
	 * own A <-> foreign A
	 * own B <-> foreign B
	 * Changing the relation of entity own A to entity foreign B will cause the
	 * deletion of the relation of entity own B to entity foreign B.
	 *
	 * @var string
	 */
	const UNIQUE_OVERWRITE	= 'overwrite';
	/**
	 * Denotes the configuration value for ignoring values which violates
	 * uniqueness checks for the "bbit_rdca_unique" configuration key.
	 *
	 * UNIQUE_IGNORE guarantees that only these relations are modified that
	 * involve no other entity than this own entity or those foreign entities,
	 * which were or will be related to this own entity.
	 * Suppose following existing one-to-one relations:
	 * own A <-> foreign A
	 * own B <-> foreign B
	 * Changing the relation of entity own A to entity foreign B will be
	 * ignored, because it will modify the relation of entity own B.
	 *
	 * When using UNIQUE_IGNORE it is recommended that the user can select only
	 * these foreign entities for relation that are not already in a relation to
	 * another own entity.
	 *
	 * @var string
	 */
	const UNIQUE_IGNORE		= 'ignore';
	/**
	 * Denotes the configuration value for rejecting and throwing an exception
	 * if uniqueness check fails for the "bbit_rdca_unique" configuration key.
	 *
	 * UNIQUE_REJECT guarantees that only these relations are modified that
	 * involve no other entity than this own entity or those foreign entities,
	 * which were or will be related to this own entity.
	 * Suppose following existing one-to-one relations:
	 * own A <-> foreign A
	 * own B <-> foreign B
	 * Changing the relation of entity own A to entity foreign B will be
	 * rejected, because it will modify the relation of entity own B.
	 *
	 * When using UNIQUE_REJECT it is recommended that the user can select only
	 * these foreign entities for relation that are not already in a relation to
	 * another own entity.
	 *
	 * @var string
	 */
	const UNIQUE_REJECT		= 'reject';

	/**
	 * Denotes the configuration value for not checking keys to be valid for the
	 * "bbit_rdca_keycheck" configuration key.
	 *
	 * @var string
	 */
	const KEYCHECK_NONE			= 'none';
	/**
	 * Denotes the configuration value for silently dropping relations using
	 * invalid keys for the "bbit_rdca_keycheck" configuration key.
	 *
	 * @var string
	 */
	const KEYCHECK_SILENT		= 'silent';
	/**
	 * Denotes the configuration value for throwing an exception when invalid
	 * keys are encountered for the "bbit_rdca_keycheck" configuration key.
	 *
	 * @var string
	 */
	const KEYCHECK_EXPLICIT		= 'explicit';

	protected $arrRelations = array();

	public function hookLoadDataContainer($strTable) {
		$arrDCA = &$GLOBALS['TL_DCA'][$strTable];

		if(is_array($arrDCA['fields'])) foreach($arrDCA['fields'] as $strField => &$arrConfig) {
			if(!isset($arrConfig[self::RELATION]))
				continue;

			$arrConfig[self::OWN_TABLE] = $strTable;

			$this->checkTable($arrConfig, self::OWN_TABLE);
			$this->checkColumn($arrConfig, $arrConfig[self::OWN_TABLE], self::OWN_KEY, 'id');
			$this->checkTable($arrConfig, self::FOREIGN_TABLE);
			$this->checkColumn($arrConfig, $arrConfig[self::FOREIGN_TABLE], self::FOREIGN_KEY, 'id');

			isset($arrConfig[self::KEYCHECK]) || $arrConfig[self::KEYCHECK] = self::KEYCHECK_SILENT;
			isset($arrConfig[self::ATTRIBUTES]) || $arrConfig[self::ATTRIBUTES] = array();
			isset($arrConfig[self::UNIQUE]) || $arrConfig[self::UNIQUE] = self::UNIQUE_OVERWRITE;
			isset($arrConfig[self::NULL_VALUE]) || $arrConfig[self::NULL_VALUE] = null;

			switch($arrConfig[self::RELATION]) {
				case self::RELATION_ONE_TO_ONE:
					if(isset($arrConfig[self::JOIN_TABLE])) {
						if($arrConfig[self::JOIN_TABLE] == $strTable) {
							$arrConfig[self::OWN_KEY_COL] = $arrConfig[self::OWN_KEY];
						} elseif($arrConfig[self::JOIN_TABLE] == $arrConfig[self::FOREIGN_TABLE]) {
							$arrConfig[self::FOREIGN_KEY_COL] = $arrConfig[self::FOREIGN_KEY];
						}

					} elseif(isset($arrConfig[self::OWN_KEY_COL])) {
						$arrConfig[self::JOIN_TABLE] = $arrConfig[self::FOREIGN_TABLE];
						$arrConfig[self::FOREIGN_KEY_COL] = $arrConfig[self::FOREIGN_KEY];

					} elseif(isset($arrConfig[self::FOREIGN_KEY_COL])) {
						$arrConfig[self::JOIN_TABLE] = $arrConfig[self::OWN_TABLE];
						$arrConfig[self::OWN_KEY_COL] = $arrConfig[self::OWN_KEY];

					}
					break;

				case self::RELATION_MANY_TO_ONE:
					if($arrConfig[self::JOIN_TABLE] == $arrConfig[self::FOREIGN_TABLE])
						throw new Exception('invalid many-to-one configuration. join table must be different from foreign table.', 1002);

					if(!isset($arrConfig[self::JOIN_TABLE])
					|| $arrConfig[self::JOIN_TABLE] == $arrConfig[self::OWN_TABLE]) {
						$arrConfig[self::JOIN_TABLE] = $arrConfig[self::OWN_TABLE];
						$arrConfig[self::OWN_KEY_COL] = $arrConfig[self::OWN_KEY];
					}
					break;

				case self::RELATION_ONE_TO_MANY:
					if($arrConfig[self::JOIN_TABLE] == $arrConfig[self::FOREIGN_TABLE])
						throw new Exception('invalid one-to-many configuration. join table must be different from own table.', 1003);

					if(!isset($arrConfig[self::JOIN_TABLE])
					|| $arrConfig[self::JOIN_TABLE] == $arrConfig[self::FOREIGN_TABLE]) {
						$arrConfig[self::JOIN_TABLE] = $arrConfig[self::FOREIGN_TABLE];
						$arrConfig[self::FOREIGN_KEY_COL] = $arrConfig[self::FOREIGN_KEY];
					}
					break;

				case self::RELATION_MANY_TO_MANY:
					break;

				default:
					throw new Exception('unknown mapping configuration', 1001);
					break;
			}

			$this->checkTable($arrConfig, self::JOIN_TABLE);
			$this->checkColumn($arrConfig, $arrConfig[self::JOIN_TABLE], self::FOREIGN_KEY_COL);
			$this->checkColumn($arrConfig, $arrConfig[self::JOIN_TABLE], self::OWN_KEY_COL);
			isset($arrConfig[self::TIMESTAMP_COL]) && $this->checkColumn($arrConfig, $arrConfig[self::JOIN_TABLE], self::TIMESTAMP_COL, 'tstamp');

			if(!$arrConfig[self::NO_CB_REG]) {
				$arrConfig['load_callback'][__CLASS__] = array(__CLASS__, 'callbackFieldLoad');
				$arrConfig['save_callback'][__CLASS__] = array(__CLASS__, 'callbackFieldSave');
			}

			$arrDCA['relations'][$strField] = &$arrConfig;
			$arrDCA['config']['onsubmit_callback'][__CLASS__] = array(__CLASS__, 'callbackDCSubmit');
			$arrDCA['config']['ondelete_callback'][__CLASS__] = array(__CLASS__, 'callbackDCDelete');
//			var_dump($strField, $arrConfig);
		}
	}

	public function callbackFieldLoad($strValue, $objDC) {
		$arrConfig = $GLOBALS['TL_DCA'][$objDC->table]['fields'][$objDC->field];

		$arrParams = array($objDC->activeRecord->{$arrConfig[self::OWN_KEY]});
		$strAttributes = $this->generateAttributes($arrConfig, $arrParams);

		return $this->Database->prepare('
			SELECT	' . $arrConfig[self::FOREIGN_KEY_COL] . '
			FROM	' . $arrConfig[self::JOIN_TABLE] . '
			WHERE	' . $arrConfig[self::OWN_KEY_COL] . ' = ?
			' . $strAttributes
		)->execute($arrParams)->fetchEach($arrConfig[self::FOREIGN_KEY_COL]);
	}

	public function callbackFieldSave($varValue, $objDC) {
		$arrConfig = &$GLOBALS['TL_DCA'][$objDC->table]['fields'][$objDC->field];
		$arrConfig['values'] = $this->checkKeys($arrConfig, deserialize($varValue, true));
		$this->arrRelations[$objDC->table][$objDC->field] = &$arrConfig;
		return null;
	}

	public function callbackDCSubmit($objDC) {
		foreach((array) $this->arrRelations[$objDC->table] as $strField => $arrConfig) {
			$this->{$arrConfig[self::RELATION]}($objDC, $strField, $arrConfig, $arrConfig['values']);
		}
		unset($this->arrRelations[$objDC->table]);
	}

	public function callbackDCDelete($objDC) {
//		$arrUndo = $this->getCurrentUndo($objDC->table, $objDC->id);
//
//		if(!$arrUndo)
//			return;
//
//		$arrFields = $GLOBALS['TL_DCA'][$objDC->table]['relations'];
//
//		foreach((array) $arrFields as $strField => $arrConfig) {
//			if(!$arrConfig[self::CASCADE_DELETE])
//				continue;
//
//			if($arrConfig[self::JOIN_TABLE] == $objDC->table
//			|| $arrConfig[self::JOIN_TABLE] == $arrConfig[self::FOREIGN_TABLE])
//				continue;
//
//			$arrParams = array($objDC->activeRecord->{$arrConfig[self::OWN_KEY]});
//			$strAttributes = $this->generateAttributes($arrConfig, $arrParams);
//
//			$objData = $this->Database->prepare('
//				SELECT	*
//				FROM	' . $arrConfig[self::JOIN_TABLE] . '
//				WHERE	' . $arrConfig[self::OWN_KEY_COL] . ' = ?
//				' . $strAttributes
//			)->executeUncached($arrParams);
//
//			while($objData->next()) {
//				$arrUndo['data'][$arrConfig[self::JOIN_TABLE]][] = $objData->row();
//				$blnStore = true;
//			}
//
//			$objData->numRows && $this->Database->prepare('
//				DELETE
//				FROM	' . $arrConfig[self::JOIN_TABLE] . '
//				WHERE	' . $arrConfig[self::OWN_KEY_COL] . ' = ?
//				' . $strAttributes
//			)->executeUncached($arrParams);
//		}
//
//		$blnStore && $this->Database->prepare(
//			'UPDATE	tl_undo
//			SET		data = ?
//			WHERE	id = ?
//		')->executeUncached(serialize($arrUndo['data']), $arrUndo['id']);
	}

	protected function generateAttributes($arrConfig, &$arrParams) {
		if(!$arrConfig[self::ATTRIBUTES] || !is_array($arrConfig[self::ATTRIBUTES]))
			return;

		$arrAttributes = array();
		foreach($arrConfig[self::ATTRIBUTES] as $strColumn => $varValue) {
			$arrAttributes[] = $strColumn . ' = ?';
			$arrParams[] = $varValue;
		}

		return ' AND (' . implode(' AND ', $arrAttributes) . ')';
	}

	protected function storeOneToOneRelation($objDC, $strField, array $arrConfig, array $arrValues) {
		$varValue = $arrValues[0];
		$varValue === null && $varValue = $arrConfig[self::NULL_VALUE];

		$arrParams = array();
		$strAttributes = $this->generateAttributes($arrConfig, $arrParams);

		array_unshift($arrParams, $varValue);

		$objUnique = $this->Database->prepare('
			SELECT	' . $arrConfig[self::OWN_KEY_COL] . '
			FROM	' . $arrConfig[self::JOIN_TABLE] . '
			WHERE	' . $arrConfig[self::FOREIGN_KEY_COL] . ' = ?
			' . $strAttributes
		)->execute($arrParams);

		array_shift($arrParams);

		if($objUnique->numRows) {
			if($objUnique->{$arrConfig[self::OWN_KEY_COL]} == $objDC->activeRecord->{$arrConfig[self::OWN_KEY]}) {
				return;

			} elseif($objUnique->{$arrConfig[self::OWN_KEY_COL]} != $arrConfig[self::NULL_VALUE]) {
				switch($arrConfig[self::UNIQUE]) {
					default:
					case self::UNIQUE_OVERWRITE:
						break;

					case self::UNIQUE_IGNORE:
						return;
						break;

					case self::UNIQUE_REJECT:
						throw new Exception('uniqueness violated. rejecting.');
						break;
				}
			}
		}

		$arrSet = array();
		isset($arrConfig[self::TIMESTAMP_COL]) && $arrSet[$arrConfig[self::TIMESTAMP_COL]] = time();

		switch($arrConfig[self::JOIN_TABLE]) {

			case $arrConfig[self::OWN_TABLE]:
				// remove the old relation of other own entities to the foreign entity (if any foreign entity)
				if($varValue != $arrConfig[self::NULL_VALUE]) {
					$arrSet[$arrConfig[self::FOREIGN_KEY_COL]] = $arrConfig[self::NULL_VALUE];
					array_unshift($arrParams, $varValue);

					$this->Database->prepare(
						'UPDATE	' . $arrConfig[self::JOIN_TABLE] . '
						%s
						WHERE	' . $arrConfig[self::FOREIGN_KEY_COL] . ' = ?
						' . $strAttributes
					)->set($arrSet)->execute($arrParams);

					array_shift($arrParams);
				}

				// set the new relation of this own entity to the foreign entity (possibly to unrelated)
				$arrSet[$arrConfig[self::FOREIGN_KEY_COL]] = $varValue;
				array_unshift($arrParams, $objDC->activeRecord->{$arrConfig[self::OWN_KEY]});

				$objStmt = $this->Database->prepare(
					'UPDATE	' . $arrConfig[self::JOIN_TABLE] . '
					%s
					WHERE	' . $arrConfig[self::OWN_KEY_COL] . ' = ?
					' . $strAttributes
				)->set($arrSet)->execute($arrParams);

				break;

			case $arrConfig[self::FOREIGN_TABLE]:
				// remove the old relation from other foreign entities to this own entity
				$arrSet[$arrConfig[self::OWN_KEY_COL]] = $arrConfig[self::NULL_VALUE];
				array_unshift($arrParams, $objDC->activeRecord->{$arrConfig[self::OWN_KEY]});

				$this->Database->prepare(
					'UPDATE	' . $arrConfig[self::JOIN_TABLE] . '
					%s
					WHERE	' . $arrConfig[self::OWN_KEY_COL] . ' = ?
					' . $strAttributes
				)->set($arrSet)->execute($arrParams);

				array_shift($arrParams);

				// no new relation to be established
				if($varValue == $arrConfig[self::NULL_VALUE])
					return;

				// set the new relation of the foreign entity to this own entity
				$arrSet[$arrConfig[self::OWN_KEY_COL]] = $objDC->activeRecord->{$arrConfig[self::OWN_KEY]};
				array_unshift($arrParams, $varValue);

				$this->Database->prepare(
					'UPDATE	' . $arrConfig[self::JOIN_TABLE] . '
					%s
					WHERE	' . $arrConfig[self::FOREIGN_KEY_COL] . ' = ?
					' . $strAttributes
				)->set($arrSet)->execute($arrParams);
				break;

			default:
				// remove the old relation of this own entity and of the foreign entity (if any)
				array_unshift($arrParams, $objDC->activeRecord->{$arrConfig[self::OWN_KEY]}, $varValue);

				// $varValue could be "NULL", in this case the second part of the OR clause always fails,
				// resulting in at most one deleted dataset
				// if the null value is not "NULL" than, all "invalid" relation datasets are deleted,
				// automagically
				$this->Database->prepare('
					DELETE
					FROM	' . $arrConfig[self::JOIN_TABLE] . '
					WHERE	(
							' . $arrConfig[self::OWN_KEY_COL] . ' = ?
						OR	' . $arrConfig[self::FOREIGN_KEY_COL] . ' = ?
					)
					' . $strAttributes
				)->execute($arrParams);

				// no new relation to be established
				if($varValue == $arrConfig[self::NULL_VALUE])
					return;

				// set the new relation between the foreign entity and this own entity
				$arrSet[$arrConfig[self::OWN_KEY_COL]] = $objDC->activeRecord->{$arrConfig[self::OWN_KEY]};
				$arrSet[$arrConfig[self::FOREIGN_KEY_COL]] = $varValue;
				$arrSet = array_merge((array) $arrConfig[self::ATTRIBUTES], $arrSet);

				$this->Database->prepare(
					'INSERT INTO ' . $arrConfig[self::JOIN_TABLE] . ' %s'
				)->set($arrSet)->execute();
				break;
		}
	}

	protected function storeManyToOneRelation($objDC, $strField, array $arrConfig, array $arrValues) {
		$varValue = $arrValues[0];
		$varValue === null && $varValue = $arrConfig[self::NULL_VALUE];

		$arrParams = array();
		$strAttributes = $this->generateAttributes($arrConfig, $arrParams);

		$arrSet = array();
		isset($arrConfig[self::TIMESTAMP_COL]) && $arrSet[$arrConfig[self::TIMESTAMP_COL]] = time();

		switch($arrConfig[self::JOIN_TABLE]) {

			case $arrConfig[self::OWN_TABLE]:
				$arrSet[$arrConfig[self::FOREIGN_KEY_COL]] = $varValue;
				array_unshift($arrParams, $objDC->activeRecord->{$arrConfig[self::OWN_KEY]});

				$objStmt = $this->Database->prepare(
					'UPDATE	' . $arrConfig[self::JOIN_TABLE] . '
					%s
					WHERE	' . $arrConfig[self::OWN_KEY_COL] . ' = ?
					' . $strAttributes
				)->set($arrSet)->execute($arrParams);

				break;

			default:
				array_unshift($arrParams, $objDC->activeRecord->{$arrConfig[self::OWN_KEY]});

				$this->Database->prepare('
					DELETE
					FROM	' . $arrConfig[self::JOIN_TABLE] . '
					WHERE	' . $arrConfig[self::OWN_KEY_COL] . ' = ?
					' . $strAttributes
				)->execute($arrParams);

				if($varValue == $arrConfig[self::NULL_VALUE])
					return;

				$arrSet[$arrConfig[self::OWN_KEY_COL]] = $objDC->activeRecord->{$arrConfig[self::OWN_KEY]};
				$arrSet[$arrConfig[self::FOREIGN_KEY_COL]] = $varValue;
				$arrSet = array_merge((array) $arrConfig[self::ATTRIBUTES], $arrSet);

				$this->Database->prepare(
					'INSERT INTO ' . $arrConfig[self::JOIN_TABLE] . ' %s'
				)->set($arrSet)->execute();
				break;
		}
	}

	protected function storeOneToManyRelation($objDC, $strField, array $arrConfig, array $arrValues) {
		$objStmt = $this->Database->prepare('*');
		$arrParams = array($objDC->activeRecord->{$arrConfig[self::OWN_KEY]});
		$strAttributes = $this->generateAttributes($arrConfig, $arrParams);

		$arrSet = array();
		isset($arrConfig[self::TIMESTAMP_COL]) && $arrSet[$arrConfig[self::TIMESTAMP_COL]] = time();

		$arrExisting = $objStmt->prepare('
			SELECT	' . $arrConfig[self::FOREIGN_KEY_COL] . '
			FROM	' . $arrConfig[self::JOIN_TABLE] . '
			WHERE	' . $arrConfig[self::OWN_KEY_COL] . ' = ?
			' . $strAttributes
		)->execute($arrParams)->fetchEach($arrConfig[self::FOREIGN_KEY_COL]);

		if($arrValues) {
			$arrForeignDelete = $objStmt->prepare(
				'SELECT	' . $arrConfig[self::FOREIGN_KEY_COL] . '
				FROM	' . $arrConfig[self::JOIN_TABLE] . '
				WHERE	' . $arrConfig[self::FOREIGN_KEY_COL] . ' IN (' . self::generateWildcards($arrValues) . ')
				AND		' . $arrConfig[self::OWN_KEY_COL] . ' != ?
				' . $strAttributes
			)->execute(array_merge($arrValues, $arrParams))->fetchEach($arrConfig[self::FOREIGN_KEY_COL]);
		}

		array_shift($arrParams);

		$arrNew = array_diff($arrValues, $arrExisting);
		$arrDelete = array_diff($arrExisting, $arrValues);

		if($arrForeignDelete) {
			switch($arrConfig[self::UNIQUE]) {
				default:
				case self::UNIQUE_OVERWRITE:
					break;

				case self::UNIQUE_IGNORE:
					$arrNew = array_diff($arrNew, $arrForeignDelete);
					$arrForeignDelete = array();
					break;

				case self::UNIQUE_REJECT:
					throw new Exception('uniqueness violated. rejecting.');
					break;
			}
		}

		switch($arrConfig[self::JOIN_TABLE]) {

			case $arrConfig[self::FOREIGN_TABLE]:
				if($arrDelete) {
					$arrSet[$arrConfig[self::OWN_KEY_COL]] = $arrConfig[self::NULL_VALUE];
					$objStmt->prepare(
						'UPDATE	' . $arrConfig[self::JOIN_TABLE] . '
						%s
						WHERE	' . $arrConfig[self::FOREIGN_KEY_COL] . ' IN (' . self::generateWildcards($arrDelete) . ')
						' . $strAttributes
					)->set($arrSet)->execute(array_merge($arrDelete, $arrParams));
				}

				if($arrNew) {
					$arrSet[$arrConfig[self::OWN_KEY_COL]] = $objDC->activeRecord->{$arrConfig[self::OWN_KEY]};
					$objStmt->prepare(
						'UPDATE	' . $arrConfig[self::JOIN_TABLE] . '
						%s
						WHERE	' . $arrConfig[self::FOREIGN_KEY_COL] . ' IN (' . self::generateWildcards($arrNew) . ')
						' . $strAttributes
					)->set($arrSet)->execute(array_merge($arrNew, $arrParams));
				}

				break;

			default:
				// remove deleted relations between this own entity and foreign entities
				// and remove old relations between the foreign entities to be related with this own entity
				if($arrDelete || $arrForeignDelete) {
					$objStmt->prepare('
						DELETE
						FROM	' . $arrConfig[self::JOIN_TABLE] . '
						WHERE	' . $arrConfig[self::FOREIGN_KEY_COL] . ' IN (' . $this->generateWildcards($arrDelete, $arrForeignDelete) . ')
						' . $strAttributes
					)->execute(array_merge($arrDelete, $arrForeignDelete, $arrParams));
				}

				$arrSet[$arrConfig[self::OWN_KEY_COL]] = $objDC->activeRecord->{$arrConfig[self::OWN_KEY]};
				$arrSet = array_merge((array) $arrConfig[self::ATTRIBUTES], $arrSet);

				foreach((array) $arrNew as $varForeignKey) {
					$arrSet[$arrConfig[self::FOREIGN_KEY_COL]] = $varForeignKey;
					$objStmt->prepare(
						'INSERT INTO ' . $arrConfig[self::JOIN_TABLE] . ' %s'
					)->set($arrSet)->execute();
				}
				break;
		}
	}

	protected function storeManyToManyRelation($objDC, $strField, array $arrConfig, array $arrValues) {
		$objStmt = $this->Database->prepare('*');

		$arrParams = array($objDC->activeRecord->{$arrConfig[self::OWN_KEY]});
		$strAttributes = $this->generateAttributes($arrConfig, $arrParams);

		$arrExisting = $objStmt->prepare('
			SELECT	' . $arrConfig[self::FOREIGN_KEY_COL] . '
			FROM	' . $arrConfig[self::JOIN_TABLE] . '
			WHERE	' . $arrConfig[self::OWN_KEY_COL] . ' = ?
			' . $strAttributes
		)->execute($arrParams)->fetchEach($arrConfig[self::FOREIGN_KEY_COL]);

		$arrDelete = array_diff($arrExisting, $arrValues);
		if($arrDelete) {
			$objStmt->prepare('
				DELETE
				FROM	' . $arrConfig[self::JOIN_TABLE] . '
				WHERE	' . $arrConfig[self::OWN_KEY_COL] . ' = ?
				' . $strAttributes . '
				AND		' . $arrConfig[self::FOREIGN_KEY_COL] . ' IN (' . self::generateWildcards($arrDelete) . ')
			')->execute(array_merge($arrParams, $arrDelete));
		}

		$arrSet = (array) $arrConfig[self::ATTRIBUTES];
		$arrSet[$arrConfig[self::OWN_KEY_COL]] = $objDC->activeRecord->{$arrConfig[self::OWN_KEY]};
		$arrConfig[self::TIMESTAMP_COL] && $arrSet[$arrConfig[self::TIMESTAMP_COL]] = time();

		foreach(array_diff($arrValues, $arrExisting) as $varForeignKey) {
			$arrSet[$arrConfig[self::FOREIGN_KEY_COL]] = $varForeignKey;
			$objStmt->prepare(
				'INSERT INTO ' . $arrConfig[self::JOIN_TABLE] . ' %s'
			)->set($arrSet)->execute();
		}
	}

//	protected function getCurrentUndo($strTable, $intID) {
//		$this->import('BackendUser', 'User');
//		$objUndo = $this->Database->prepare('
//			SELECT	*
//			FROM	tl_undo
//			WHERE	pid = ?
//			AND		fromTable = ?
//			AND		backboneit_relationdca = ?
//			ORDER BY tstamp DESC
//		')->executeUncached(
//			$this->User->id,
//			$strTable,
//			0
//		);
//
//		$arrAlreadyProcessed = array();
//
//		while($objUndo->next()) {
//			$arrData = deserialize($objUndo->data, true);
//
//			$arrIDs = array();
//			foreach((array) $arrData[$strTable] as $arrRow)
//				$arrIDs[$arrRow['id']] = true;
//
//			if(isset($arrIDs[$intID])) {
//				$arrUndo = $objUndo->row();
//				$arrUndo['data'] = $arrData; //saves double deserialize later
//
//			} elseif($this->Database->tableExists($objUndo->table)) {
//				$intCount = $this->Database->prepare('
//					SELECT	COUNT(*) AS cnt
//					FROM	' . $objUndo->table . '
//					WHERE	id IN (' . self::generateWildcards($arrIDs) . ')
//				')->executeUncached(array_keys($arrIDs))->cnt;
//
//				 // some IDs where already deleted, so mark this undo to has been processed
//				$intCount != count($arrIDs) && $arrAlreadyProcessed[] = $objUndo->id;
//			}
//		}
//
//		$arrAlreadyProcessed && $this->Database->prepare(
//			'UPDATE	tl_undo
//			SET		backboneit_relationdca = ?
//			WHERE	id IN (' . self::generateWildcards($arrAlreadyProcessed) . ')
//		')->executeUncached(array_merge(array(time()), $arrAlreadyProcessed));
//
//		return $arrUndo;
//	}

	protected function checkKeys(array &$arrConfig, array $arrIDs) {
		if(!$arrIDs)
			return array();

		$arrIDs = array_unique($arrIDs);

		if($arrConfig[self::KEYCHECK] == self::KEYCHECK_NONE)
			return $arrIDs;

		$arrChecked = $this->Database->prepare('
			SELECT	DISTINCT ' . $arrConfig[self::FOREIGN_KEY] . '
			FROM	' . $arrConfig[self::FOREIGN_TABLE] . '
			WHERE	' . $arrConfig[self::FOREIGN_KEY] . ' IN (' . self::generateWildcards($arrIDs) . ')
		')->execute($arrIDs)->fetchEach($arrConfig[self::FOREIGN_KEY]);

		if(count($arrChecked) == count($arrIDs))
			return $arrIDs;

		if($arrConfig[self::KEYCHECK] == self::KEYCHECK_EXPLICIT)
			throw new Exception('keycheck failed', 10);

		return array_intersect($arrIDs, $arrChecked);
	}

	protected function checkTable(array &$arrConfig, $strParam) {
		if(!is_string($arrConfig[$strParam]) || !strlen($arrConfig[$strParam]))
			throw new Exception(sprintf('invalid configuration, [%s] given for %s is not a valid table ref',
				$arrConfig[$strParam],
				$strParam
			), 1011);
		if($arrConfig[self::SCHEMACHECK] && !$this->Database->tableExists($arrConfig[$strParam]))
			throw new Exception(sprintf('configuration does not comply with db schema, table [%s] configured for %s not found',
				$arrConfig[$strParam],
				$strParam
			), 1012);
	}

	protected function checkColumn(array &$arrConfig, $strTable, $strParam, $strDefaultColumn = null) {
		if(!is_string($arrConfig[$strParam]) || !strlen($arrConfig[$strParam])) {
			if($strDefaultColumn == null) {
				throw new Exception(sprintf('invalid configuration, [%s] given for %s is not a valid column ref',
					$arrConfig[$strParam],
					$strParam
				), 1021);
			} else {
				$arrConfig[$strParam] = $strDefaultColumn;
			}
		}
		if($arrConfig[self::SCHEMACHECK] && !$this->Database->fieldExists($arrConfig[$strParam], $strTable))
			throw new Exception(sprintf('configuration does not comply with db schema, column [%s] configured for %s not found in table %s',
				$arrConfig[$strParam],
				$strParam,
				$strTable
			), 1022);
	}

	public static function generateWildcards(array $arrValues) {
		$arrArgs = func_get_args();
		return implode(',', array_fill(0, array_sum(array_map('count', array_filter($arrArgs, 'is_array'))), '?'));
	}

	protected function __construct() {
		parent::__construct();
	}

	protected function __clone() {
	}

	private static $objInstance;

	public static function getInstance() {
		if(isset(self::$objInstance))
			return self::$objInstance;

		return self::$objInstance = new self();
	}

}
