/**
 * Autogenerated base class representing message rows
 * in the Streams database.
 *
 * Don't change this file, since it can be overwritten.
 * Instead, change the Streams/Message.js file.
 *
 * @module Streams
 */

var Q = require('Q');
var Db = Q.require('Db');
var Streams = Q.require('Streams');
var Row = Q.require('Db/Row');

/**
 * Base class representing 'Message' rows in the 'Streams' database
 * @namespace Base.Streams
 * @class Message
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
 * @property publisherId
 * @type String
 */
/**
 * @property streamName
 * @type String
 */
/**
 * @property insertedTime
 * @type String|Db.Expression
 */
/**
 * @property sentTime
 * @type String|Db.Expression
 */
/**
 * @property byUserId
 * @type String
 */
/**
 * @property byClientId
 * @type String
 */
/**
 * @property type
 * @type String
 */
/**
 * @property content
 * @type String
 */
/**
 * @property instructions
 * @type String
 */
/**
 * @property weight
 * @type number
 */
/**
 * @property ordinal
 * @type integer
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
 * @param [withoutDbName=false] {boolean} Indicates wheather table name should contain the database name
 * @return {String|Db.Expression} The table name as string optionally without database name if no table sharding was started
 * or Db.Expression object with prefix and database name templates is table was sharded
 */
Base.table = function (withoutDbName) {
	if (Q.Config.get(['Db', 'connections', 'Streams', 'indexes', 'Message'], false)) {
		return new Db.Expression((withoutDbName ? '' : '{$dbname}.')+'{$prefix}message');
	} else {
		var conn = Db.getConnection('Streams');
		var prefix = conn.prefix || '';
		var tableName = prefix + 'message';
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
 * @param fields {object|string} The field values to use in WHERE clauseas as an associative array of `{column: value}` pairs
 * @param [alias=null] {string} Table alias
 * @return {Db.Query.Mysql} The generated query
 */
Base.SELECT = function(fields, alias) {
	var q = Base.db().SELECT(fields, Base.table()+(alias ? ' '+alias : ''));
	q.className = 'Streams_Message';
	return q;
};

/**
 * Create UPDATE query to the class table. Use Db.Query.Mysql.set() method to define SET clause
 * @method UPDATE
 * @param [alias=null] {string} Table alias
 * @return {Db.Query.Mysql} The generated query
 */
Base.UPDATE = function(alias) {
	var q = Base.db().UPDATE(Base.table()+(alias ? ' '+alias : ''));
	q.className = 'Streams_Message';
	return q;
};

/**
 * Create DELETE query to the class table
 * @method DELETE
 * @param [table_using=null] {object} If set, adds a USING clause with this table
 * @param [alias=null] {string} Table alias
 * @return {Db.Query.Mysql} The generated query
 */
Base.DELETE = function(table_using, alias) {
	var q = Base.db().DELETE(Base.table()+(alias ? ' '+alias : ''), table_using);
	q.className = 'Streams_Message';
	return q;
};

/**
 * Create INSERT query to the class table
 * @method INSERT
 * @param {object} [fields={}] The fields as an associative array of `{column: value}` pairs
 * @param [alias=null] {string} Table alias
 * @return {Db.Query.Mysql} The generated query
 */
Base.INSERT = function(fields, alias) {
	var q = Base.db().INSERT(Base.table()+(alias ? ' '+alias : ''), fields || {});
	q.className = 'Streams_Message';
	return q;
};

/**
 * The name of the class
 * @property className
 * @type string
 */
Base.prototype.className = "Streams_Message";

// Instance methods

/**
 * Create INSERT query to the class table
 * @method INSERT
 * @param {object} [fields={}] The fields as an associative array of `{column: value}` pairs
 * @param [alias=null] {string} Table alias
 * @return {Db.Query.Mysql} The generated query
 */
Base.prototype.setUp = function() {
	// does nothing for now
};

/**
 * Create INSERT query to the class table
 * @method INSERT
 * @param {object} [fields={}] The fields as an associative array of `{column: value}` pairs
 * @param [alias=null] {string} Table alias
 * @return {Db.Query.Mysql} The generated query
 */
Base.prototype.db = function () {
	return Base.db();
};

/**
 * Retrieve the table name to use in SQL statements
 * @method table
 * @param [withoutDbName=false] {boolean} Indicates wheather table name should contain the database name
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
		"ordinal"
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
		"insertedTime",
		"sentTime",
		"byUserId",
		"byClientId",
		"type",
		"content",
		"instructions",
		"weight",
		"ordinal"
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
 * Method is called before setting the field
 * @method beforeSet_sentTime
 * @param {String} value
 * @return {Date|Db.Expression} If 'value' is not Db.Expression the current date is returned
 */
Base.prototype.beforeSet_sentTime = function (value) {
		if (!value) return value;
		if (value instanceof Db.Expression) return value;
		value = (value instanceof Date) ? Base.db().toDateTime(value) : value;
		return value;
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
 * Method is called before setting the field and verifies if value is string of length within acceptable limit.
 * Optionally accept numeric value which is converted to string
 * @method beforeSet_byClientId
 * @param {string} value
 * @return {string} The value
 * @throws {Error} An exception is thrown if 'value' is not string or is exceedingly long
 */
Base.prototype.beforeSet_byClientId = function (value) {
		if (value instanceof Db.Expression) return value;
		if (typeof value !== "string" && typeof value !== "number")
			throw new Error('Must pass a string to '+this.table()+".byClientId");
		if (typeof value === "string" && value.length > 31)
			throw new Error('Exceedingly long value being assigned to '+this.table()+".byClientId");
		return value;
};

	/**
	 * Returns the maximum string length that can be assigned to the byClientId field
	 * @return {integer}
	 */
Base.prototype.maxSize_byClientId = function () {

		return 31;
};

/**
 * Method is called before setting the field and verifies if value is string of length within acceptable limit.
 * Optionally accept numeric value which is converted to string
 * @method beforeSet_type
 * @param {string} value
 * @return {string} The value
 * @throws {Error} An exception is thrown if 'value' is not string or is exceedingly long
 */
Base.prototype.beforeSet_type = function (value) {
		if (value instanceof Db.Expression) return value;
		if (typeof value !== "string" && typeof value !== "number")
			throw new Error('Must pass a string to '+this.table()+".type");
		if (typeof value === "string" && value.length > 255)
			throw new Error('Exceedingly long value being assigned to '+this.table()+".type");
		return value;
};

	/**
	 * Returns the maximum string length that can be assigned to the type field
	 * @return {integer}
	 */
Base.prototype.maxSize_type = function () {

		return 255;
};

/**
 * Method is called before setting the field and verifies if value is string of length within acceptable limit.
 * Optionally accept numeric value which is converted to string
 * @method beforeSet_content
 * @param {string} value
 * @return {string} The value
 * @throws {Error} An exception is thrown if 'value' is not string or is exceedingly long
 */
Base.prototype.beforeSet_content = function (value) {
		if (value instanceof Db.Expression) return value;
		if (typeof value !== "string" && typeof value !== "number")
			throw new Error('Must pass a string to '+this.table()+".content");
		if (typeof value === "string" && value.length > 1023)
			throw new Error('Exceedingly long value being assigned to '+this.table()+".content");
		return value;
};

	/**
	 * Returns the maximum string length that can be assigned to the content field
	 * @return {integer}
	 */
Base.prototype.maxSize_content = function () {

		return 1023;
};

/**
 * Method is called before setting the field and verifies if value is string of length within acceptable limit.
 * Optionally accept numeric value which is converted to string
 * @method beforeSet_instructions
 * @param {string} value
 * @return {string} The value
 * @throws {Error} An exception is thrown if 'value' is not string or is exceedingly long
 */
Base.prototype.beforeSet_instructions = function (value) {
		if (value instanceof Db.Expression) return value;
		if (typeof value !== "string" && typeof value !== "number")
			throw new Error('Must pass a string to '+this.table()+".instructions");
		if (typeof value === "string" && value.length > 4092)
			throw new Error('Exceedingly long value being assigned to '+this.table()+".instructions");
		return value;
};

	/**
	 * Returns the maximum string length that can be assigned to the instructions field
	 * @return {integer}
	 */
Base.prototype.maxSize_instructions = function () {

		return 4092;
};

/**
 * Method is called before setting the field to verify if value is a number
 * @method beforeSet_weight
 * @param {integer} value
 * @return {integer} The value
 * @throws {Error} If 'value' is not number
 */
Base.prototype.beforeSet_weight = function (value) {
		if (value instanceof Db.Expression) return value;
		value = Number(value);
		if (isNaN(value))
			throw new Error('Non-number value being assigned to '+this.table()+".weight");
		return value;
};

/**
 * Method is called before setting the field and verifies if integer value falls within allowed limits
 * @method beforeSet_ordinal
 * @param {integer} value
 * @return {integer} The value
 * @throws {Error} An exception is thrown if 'value' is not integer or does not fit in allowed range
 */
Base.prototype.beforeSet_ordinal = function (value) {
		if (value instanceof Db.Expression) return value;
		value = Number(value);
		if (isNaN(value) || Math.floor(value) != value) 
			throw new Error('Non-integer value being assigned to '+this.table()+".ordinal");
		if (value < 0 || value > 4294967295)
			throw new Error("Out-of-range value '"+value+"' being assigned to "+this.table()+".ordinal");
		return value;
};

	/**
	 * Returns the maximum integer that can be assigned to the ordinal field
	 * @return {integer}
	 */
Base.prototype.maxSize_ordinal = function () {

		return 4294967295;
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