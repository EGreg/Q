/**
 * Autogenerated base class representing request rows
 * in the Streams database.
 *
 * Don't change this file, since it can be overwritten.
 * Instead, change the Streams/Request.js file.
 *
 * @module Streams
 */

var Q = require('Q');
var Db = Q.require('Db');
var Streams = Q.require('Streams');
var Row = Q.require('Db/Row');

/**
 * Base class representing 'Request' rows in the 'Streams' database
 * @namespace Base.Streams
 * @class Request
 * @extends Db.Row
 * @constructor
 * @param {object} [fields={}] The fields values to initialize table row as 
 * an associative array of `{column: value}` pairs
 */
function Base (fields) {
	Base.constructors.apply(this, arguments);
}

Q.mixin(Base, Row);

/**
 * @property {String
 * @type }publisherId
 */
/**
 * @property {String
 * @type }streamName
 */
/**
 * @property {String
 * @type }byUserId
 */
/**
 * @property {String|Db.Expression}
 * @type insertedTime
 */
/**
 * @property {integer}
 * @type readLevel
 */
/**
 * @property {integer}
 * @type writeLevel
 */
/**
 * @property {integer}
 * @type adminLevel
 */

/**
 * This method calls Db.connect() using information stored in the configuration.
 * If this has already been called, then the same db object is returned.
 * @method db
 * @return {Db} The database connection
 */
Base.db = function () {
	return Streams.db();
};

/**
 * Retrieve the table name to use in SQL statements
 * @method table
 * @param {boolean} [withoutDbName=false] Indicates wheather table name should contain the database name
 * @return {String|Db.Expression} The table name as string optionally without database name if no table sharding was started
 * or Db.Expression object with prefix and database name templates is table was sharded
 */
Base.table = function (withoutDbName) {
	if (Q.Config.get(['Db', 'connections', 'Streams', 'indexes', 'Request'], false)) {
		return new Db.Expression((withoutDbName ? '' : '{$dbname}.')+'{$prefix}request');
	} else {
		var conn = Db.getConnection('Streams');
		var prefix = conn.prefix || '';
		var tableName = prefix + 'request';
		var dbname = Base.table.dbname;
		if (!dbname) {
			var dsn = Db.parseDsnString(conn['dsn']);
			dbname = Base.table.dbname = dsn.dbname;
		}
		return withoutDbName ? tableName : dbname + '.' + tableName;
	}
};

/**
 * The connection name for the class
 * @method connectionName
 * @return {string} The name of the connection
 */
Base.connectionName = function() {
	return 'Streams';
};

/**
 * Create SELECT query to the class table
 * @method SELECT
 * @param {object|string} fields The field values to use in WHERE clauseas as an associative array of `{column: value}` pairs
 * @param {string} [alias=null] Table alias
 * @return {Db.Query.Mysql} The generated query
 */
Base.SELECT = function(fields, alias) {
	var q = Base.db().SELECT(fields, Base.table()+(alias ? ' '+alias : ''));
	q.className = 'Streams_Request';
	return q;
};

/**
 * Create UPDATE query to the class table. Use Db.Query.Mysql.set() method to define SET clause
 * @method UPDATE
 * @param {string} [alias=null] Table alias
 * @return {Db.Query.Mysql} The generated query
 */
Base.UPDATE = function(alias) {
	var q = Base.db().UPDATE(Base.table()+(alias ? ' '+alias : ''));
	q.className = 'Streams_Request';
	return q;
};

/**
 * Create DELETE query to the class table
 * @method DELETE
 * @param {object}[table_using=null] If set, adds a USING clause with this table
 * @param {string} [alias=null] Table alias
 * @return {Db.Query.Mysql} The generated query
 */
Base.DELETE = function(table_using, alias) {
	var q = Base.db().DELETE(Base.table()+(alias ? ' '+alias : ''), table_using);
	q.className = 'Streams_Request';
	return q;
};

/**
 * Create INSERT query to the class table
 * @method INSERT
 * @param {object} [fields={}] The fields as an associative array of `{column: value}` pairs
 * @param {string} [alias=null] Table alias
 * @return {Db.Query.Mysql} The generated query
 */
Base.INSERT = function(fields, alias) {
	var q = Base.db().INSERT(Base.table()+(alias ? ' '+alias : ''), fields || {});
	q.className = 'Streams_Request';
	return q;
};

/**
 * The name of the class
 * @property className
 * @type string
 */
Base.prototype.className = "Streams_Request";

// Instance methods

/**
 * Create INSERT query to the class table
 * @method INSERT
 * @param {object} [fields={}] The fields as an associative array of `{column: value}` pairs
 * @param {string} [alias=null] Table alias
 * @return {Db.Query.Mysql} The generated query
 */
Base.prototype.setUp = function() {
	// does nothing for now
};

/**
 * Create INSERT query to the class table
 * @method INSERT
 * @param {object} [fields={}] The fields as an associative array of `{column: value}` pairs
 * @param {string} [alias=null] Table alias
 * @return {Db.Query.Mysql} The generated query
 */
Base.prototype.db = function () {
	return Base.db();
};

/**
 * Retrieve the table name to use in SQL statements
 * @method table
 * @param {boolean} [withoutDbName=false] Indicates wheather table name should contain the database name
 * @return {String|Db.Expression} The table name as string optionally without database name if no table sharding was started
 * or Db.Expression object with prefix and database name templates is table was sharded
 */
Base.prototype.table = function () {
	return Base.table();
};

/**
 * Retrieves primary key fields names for class table
 * @method primaryKey
 * @return {string[]} An array of field names
 */
Base.prototype.primaryKey = function () {
	return [
		"publisherId",
		"streamName",
		"byUserId"
	];
};

/**
 * Retrieves field names for class table
 * @method fieldNames
 * @return {array} An array of field names
 */
Base.prototype.fieldNames = function () {
	return [
		"publisherId",
		"streamName",
		"byUserId",
		"insertedTime",
		"readLevel",
		"writeLevel",
		"adminLevel"
	];
};

/**
 * Method is called before setting the field and verifies if value is string of length within acceptable limit.
 * Optionally accept numeric value which is converted to string
 * @method beforeSet_publisherId
 * @param {string} value
 * @return {string} The value
 * @throws {Error} An exception is thrown if 'value' is not string or is exceedingly long
 */
Base.prototype.beforeSet_publisherId = function (value) {
		if (value instanceof Db.Expression) return value;
		if (typeof value !== "string" && typeof value !== "number")
			throw new Error('Must pass a string to '+this.table()+".publisherId");
		if (typeof value === "string" && value.length > 31)
			throw new Error('Exceedingly long value being assigned to '+this.table()+".publisherId");
		return value;
};

	/**
	 * Returns the maximum string length that can be assigned to the publisherId field
	 * @return {integer}
	 */
Base.prototype.maxSize_publisherId = function () {

		return 31;
};

/**
 * Method is called before setting the field and verifies if value is string of length within acceptable limit.
 * Optionally accept numeric value which is converted to string
 * @method beforeSet_streamName
 * @param {string} value
 * @return {string} The value
 * @throws {Error} An exception is thrown if 'value' is not string or is exceedingly long
 */
Base.prototype.beforeSet_streamName = function (value) {
		if (value instanceof Db.Expression) return value;
		if (typeof value !== "string" && typeof value !== "number")
			throw new Error('Must pass a string to '+this.table()+".streamName");
		if (typeof value === "string" && value.length > 255)
			throw new Error('Exceedingly long value being assigned to '+this.table()+".streamName");
		return value;
};

	/**
	 * Returns the maximum string length that can be assigned to the streamName field
	 * @return {integer}
	 */
Base.prototype.maxSize_streamName = function () {

		return 255;
};

/**
 * Method is called before setting the field and verifies if value is string of length within acceptable limit.
 * Optionally accept numeric value which is converted to string
 * @method beforeSet_byUserId
 * @param {string} value
 * @return {string} The value
 * @throws {Error} An exception is thrown if 'value' is not string or is exceedingly long
 */
Base.prototype.beforeSet_byUserId = function (value) {
		if (value instanceof Db.Expression) return value;
		if (typeof value !== "string" && typeof value !== "number")
			throw new Error('Must pass a string to '+this.table()+".byUserId");
		if (typeof value === "string" && value.length > 31)
			throw new Error('Exceedingly long value being assigned to '+this.table()+".byUserId");
		return value;
};

	/**
	 * Returns the maximum string length that can be assigned to the byUserId field
	 * @return {integer}
	 */
Base.prototype.maxSize_byUserId = function () {

		return 31;
};

/**
 * Method is called before setting the field
 * @method beforeSet_insertedTime
 * @param {String} value
 * @return {Date|Db.Expression} If 'value' is not Db.Expression the current date is returned
 */
Base.prototype.beforeSet_insertedTime = function (value) {
		if (value instanceof Db.Expression) return value;
		value = (value instanceof Date) ? Base.db().toDateTime(value) : value;
		return value;
};

/**
 * Method is called before setting the field and verifies if integer value falls within allowed limits
 * @method beforeSet_readLevel
 * @param {integer} value
 * @return {integer} The value
 * @throws {Error} An exception is thrown if 'value' is not integer or does not fit in allowed range
 */
Base.prototype.beforeSet_readLevel = function (value) {
		if (value instanceof Db.Expression) return value;
		value = Number(value);
		if (isNaN(value) || Math.floor(value) != value) 
			throw new Error('Non-integer value being assigned to '+this.table()+".readLevel");
		if (value < -2147483648 || value > 2147483647)
			throw new Error("Out-of-range value '"+value+"' being assigned to "+this.table()+".readLevel");
		return value;
};

	/**
	 * Returns the maximum integer that can be assigned to the readLevel field
	 * @return {integer}
	 */
Base.prototype.maxSize_readLevel = function () {

		return 2147483647;
};

/**
 * Method is called before setting the field and verifies if integer value falls within allowed limits
 * @method beforeSet_writeLevel
 * @param {integer} value
 * @return {integer} The value
 * @throws {Error} An exception is thrown if 'value' is not integer or does not fit in allowed range
 */
Base.prototype.beforeSet_writeLevel = function (value) {
		if (value instanceof Db.Expression) return value;
		value = Number(value);
		if (isNaN(value) || Math.floor(value) != value) 
			throw new Error('Non-integer value being assigned to '+this.table()+".writeLevel");
		if (value < -2147483648 || value > 2147483647)
			throw new Error("Out-of-range value '"+value+"' being assigned to "+this.table()+".writeLevel");
		return value;
};

	/**
	 * Returns the maximum integer that can be assigned to the writeLevel field
	 * @return {integer}
	 */
Base.prototype.maxSize_writeLevel = function () {

		return 2147483647;
};

/**
 * Method is called before setting the field and verifies if integer value falls within allowed limits
 * @method beforeSet_adminLevel
 * @param {integer} value
 * @return {integer} The value
 * @throws {Error} An exception is thrown if 'value' is not integer or does not fit in allowed range
 */
Base.prototype.beforeSet_adminLevel = function (value) {
		if (value instanceof Db.Expression) return value;
		value = Number(value);
		if (isNaN(value) || Math.floor(value) != value) 
			throw new Error('Non-integer value being assigned to '+this.table()+".adminLevel");
		if (value < -2147483648 || value > 2147483647)
			throw new Error("Out-of-range value '"+value+"' being assigned to "+this.table()+".adminLevel");
		return value;
};

	/**
	 * Returns the maximum integer that can be assigned to the adminLevel field
	 * @return {integer}
	 */
Base.prototype.maxSize_adminLevel = function () {

		return 2147483647;
};

/**
 * Check if mandatory fields are set and updates 'magic fields' with appropriate values
 * @method beforeSave
 * @param {array} value The array of fields
 * @return {array}
 * @throws {Error} If mandatory field is not set
 */
Base.prototype.beforeSave = function (value) {
	var fields = ['streamName'], i;
	if (!this._retrieved) {
		var table = this.table();
		for (i=0; i<fields.length; i++) {
			if (typeof this.fields[fields[i]] === "undefined") {
				throw new Error("the field "+table+"."+fields[i]+" needs a value, because it is NOT NULL, not auto_increment, and lacks a default value.");
			}
		}
	}
	return value;
};

module.exports = Base;