<?php

/**
 * Autogenerated base class for the Awards model.
 * 
 * Don't change this file, since it can be overwritten.
 * Instead, change the Awards.php file.
 *
 * @module Awards
 */
/**
 * Base class for the Awards model
 * @class Base_Awards
 */
abstract class Base_Awards
{
	/**
	 * The list of model classes
	 * @property $table_classnames
	 * @type array
	 */
	static $table_classnames = array (
  0 => 'Awards_Charge',
  1 => 'Awards_Customer',
  2 => 'Awards_Subscription',
);

	/**
     * This method calls Db.connect() using information stored in the configuration.
     * If this has already been called, then the same db object is returned.
	 * @method db
	 * @return {iDb} The database object
	 */
	static function db()
	{
		return Db::connect('Awards');
	}

	/**
	 * The connection name for the class
	 * @method connectionName
	 * @return {string} The name of the connection
	 */
	static function connectionName()
	{
		return 'Awards';
	}
};