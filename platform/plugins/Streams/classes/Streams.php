<?php

/**
 * Streams model
 * @module Streams
 * @main Streams
 */
/**
 * Static methods for the Streams models.
 * @class Streams
 * @extends Base_Streams
 * @abstract
 */
abstract class Streams extends Base_Streams
{
	/*
	 * This is where you would place all the static methods for the models,
	 * the ones that don't strongly pertain to a particular row or table.
	 */

	/**
	 * Read levels
	 * @property $READ_LEVEL
	 * @type array
	 */
	/**
	 * Can't see the stream
	 * @config $READ_LEVEL['none']
	 * @type integer
	 * @default 0
	 * @final
	 */
	/**
	 * Can see icon and title
	 * @config $READ_LEVEL['see']
	 * @type integer
	 * @default 10
	 * @final
	 */
	/**
	 * Can preview stream and its content
	 * @config $READ_LEVEL['content']
	 * @type integer
	 * @default 20
	 * @final
	 */
	/**
	 * Can see participants in the stream
	 * @config $READ_LEVEL['participants']
	 * @type integer
	 * @default 30
	 * @final
	 */
	/**
	 * Can play stream in a player
	 * @config $READ_LEVEL['messages']
	 * @type integer
	 * @default 40
	 * @final
	 */
	public static $READ_LEVEL = array(
		'none' => 0,				// can't see the stream
		'see' => 10,				// can see icon and title
		'content' => 20,			// can preview stream and its content
		'participants' => 30,		// can see participants in the stream
		'messages' => 40,			// can play stream in a player
		'max' => 40
	);
	/**
	 * Write levels
	 * @property $WRITE_LEVEL
	 * @type array
	 */
	/**
	 * Cannot affect stream or participants list
	 * @config $WRITE_LEVEL['none']
	 * @type integer
	 * @default 0
	 * @final
	 */
	/**
	 * Can become a participant, chat, and leave
	 * @config $WRITE_LEVEL['join']
	 * @type integer
	 * @default 10
	 * @final
	 */
	/**
	 * Can vote for a relation message posted to the stream.
	 * @config WRITE_LEVEL['vote']
	 * @type integer
	 * @default 13
	 * @final
	 */
	/**
	 * Can post messages, but manager must approve
	 * @config $WRITE_LEVEL['postPending']
	 * @type integer
	 * @default 15
	 * @final
	 */
	/**
	 * Can post messages which appear immediately
	 * @config $WRITE_LEVEL['post']
	 * @type integer
	 * @default 20
	 * @final
	 */
	/**
	 * Can post messages relating other streams to this one
	 * @config WRITE_LEVEL['relate']
	 * @type integer
	 * @default 23
	 * @final
	 */
	/**
	 * Can update properties of relations directly
	 * @config WRITE_LEVEL['relations']
	 * @type integer
	 * @default 25
	 * @final
	 */
	/**
	 * Can post messages requesting edits of stream
	 * @config $WRITE_LEVEL['suggest']
	 * @type integer
	 * @default 28
	 * @final
	 */
	/**
	 * Can post messages to edit stream content immediately
	 * @config $WRITE_LEVEL['edit']
	 * @type integer
	 * @default 30
	 * @final
	 */
	/**
	 * Can post a message requesting to close the stream
	 * @config $WRITE_LEVEL['closePending']
	 * @type integer
	 * @default 35
	 * @final
	 */
	/**
	 * Don't delete, just prevent any new changes to stream
	 * however, joining and leaving is still ok
	 * @config $WRITE_LEVEL['close']
	 * @type integer
	 * @default 40
	 * @final
	 */
	public static $WRITE_LEVEL = array(
		'none' => 0,
		'join' => 10,
		'vote' => 13,
		'postPending' => 18,
		'post' => 20,
		'relate' => 23,
		'relations' => 25,
		'suggest' => 28,
		'edit' => 30,
		'closePending' => 35,
		'close' => 40,
		'max' => 40
	);
	/**
	 * Admin levels
	 * @property $ADMIN_LEVEL
	 * @type array
	 */
	/**
	 * Cannot do anything related to admin / users
	 * @config $ADMIN_LEVEL['none']
	 * @type integer
	 * @default 0
	 * @final
	 */
	/**
	 * Can post on your stream about participating
	 * @config $ADMIN_LEVEL['tell']
	 * @type integer
	 * @default 10
	 * @final
	 */
	/**
	 * Able to create invitations for others, granting access
	 * @config $ADMIN_LEVEL['invite']
	 * @type integer
	 * @default 20
	 * @final
	 */
	/**
	 * Can approve posts and give people any adminLevel < 'manage'
	 * @config $ADMIN_LEVEL['manage']
	 * @type integer
	 * @default 30
	 * @final
	 */
	/**
	 * Can give people any adminLevel <= 'own'
	 * @config $ADMIN_LEVEL['own']
	 * @type integer
	 * @default 40
	 * @final
	 */
	public static $ADMIN_LEVEL = array(
		'none' => 0,
		'tell' => 10,
		'invite' => 20,
		'manage' => 30,
		'own' => 40,
		'max' => 40
	);
	/**
	 * Access sources
	 * @property $ACCESS_SOURCES
	 * @type array
	 */
	/**
	 * Public access
	 * @config $ACCESS_SOURCES['public']
	 * @type integer
	 * @default 0
	 * @final
	 */
	/**
	 * From contact
	 * @config $ACCESS_SOURCES['contact']
	 * @type integer
	 * @default 1
	 * @final
	 */
	/**
	 * Direct access
	 * @config $ACCESS_SOURCES['direct']
	 * @type integer
	 * @default 2
	 * @final
	 */
	/**
	 * Inherited public access
	 * @config $ACCESS_SOURCES['inherited_public']
	 * @type integer
	 * @default 3
	 * @final
	 */
	/**
	 * Inherited from contact
	 * @config $ACCESS_SOURCES['inherited_contact']
	 * @type integer
	 * @default 4
	 * @final
	 */
	/**
	 * Inherited direct access
	 * @config $ACCESS_SOURCES['inherited_direct']
	 * @type integer
	 * @default 5
	 * @final
	 */
	public static $ACCESS_SOURCES = array(
		'public' => 0,
		'contact' => 1,
		'direct' => 2,
		'inherited_public' => 3,
		'inherited_contact' => 4,
		'inherited_direct' => 5
	);

	/**
	 * Fetches streams from the database.
	 * @method fetch
	 * @static
	 * @param {string} $asUserId
	 *  Set this to the user for which you are fetching the streams.
	 *  If this matches the publisherId, just returns the streams.
	 *  If this is '', only returns the streams anybody can see.
	 *  Otherwise, return the streams joined with the calculated access settings.
	 *  If you pass null here, then either the logged-in user's id or '' will be used.
	 * @param {string} $publisherId
	 *  The id of the user publishing these streams
	 * @param {string|array|Db_Range} $name
	 *  The name of the stream to fetch. Can end in "/" for template streams.
	 *  Also it can be an array of stream names, or a custom Db_Range for stream names
	 * @param {string} $fields='*'
	 *  Must include "publisherId" and "name" fields, since they
	 *  make up the primary key of the stream table.
	 * @param {array} $options=array()
	 *  Optional. Defaults to array().
	 *  Provide additional query options like 'limit', 'offset', 'orderBy', 'where' etc.
	 *  @see Db_Query_Mysql::options().
	 *  @param {boolean} [$options.refetch] => Ignore cache of previous calls to fetch, 
	 *   and save a new cache if necessary.
	 *  @see Db_Query_Mysql::options().
	 * @return {array}
	 *  Returns an array of Streams_Stream objects with access info calculated
	 *  specifically for $asUserId .
	 *  Make sure to call the methods testReadLevel(), testWriteLevel() and testAdminLevel()
	 *  on these streams before using them on the user's behalf.
	 */
	static function fetch(
		$asUserId,
		$publisherId,
		$name,
		$fields = '*',
		$options = array())
	{
		if (!isset($asUserId)) {
			$asUserId = Users::loggedInUser();
			if (!$asUserId) $asUserId = "";
		}
		if ($asUserId instanceof Users_User) {
			$asUserId = $asUserId->id;
		}
		if ($publisherId instanceof Users_User) {
			$publisherId = $publisherId->id;
		}
		if (empty($publisherId) or empty($name)) {
			return array();
		}
		$allCached = array();
		if (is_array($name) and empty($options['refetch'])) {
			$namesToFetch = array();
			foreach ($name as $n) {
				if (isset(self::$fetch[$asUserId][$publisherId][$n][$fields])) {
					$allCached[$n] = self::$fetch[$asUserId][$publisherId][$n][$fields];
				} else {
					$namesToFetch[] = $n;
				}
			}
			$namesToFetch = array_unique($namesToFetch);
		} else {
			$namesToFetch = $name;
		}
		$criteria = array(
			'publisherId' => $publisherId,
			'name' => $namesToFetch
		);

		// Get streams and set their default access info
		$allRetrieved = $namesToFetch
			? Streams_Stream::select($fields)
				->where($criteria)
				->ignoreCache()
				->options($options)
				->fetchDbRows(null, '', 'name')
			: array();

		$streams = $allCached ? array_merge($allCached, $allRetrieved) : $allRetrieved;

		Streams::calculateAccess($asUserId, $publisherId, $streams, false);

		if (is_array($name) and count($name) > 1) {
			// put the streams back in the same internal PHP array order
			// and in the process honor any duplicate names that might have been passed
			$temp = $streams;
			$streams = array();
			foreach ($name as $n) {
				$streams[$n] = isset($temp[$n]) ? $temp[$n] : null;
			}
		}

		$types = array();
		foreach ($streams as $stream) {
			if ($stream) {
				$types[$stream->type] = true;
			}
		}
		$types = array_keys($types);

		foreach ($types as $type) {
			$cached = array();
			$retrieved = array();
			foreach ($allCached as $n => $s) {
				if ($s->type === $type) {
					$cached[$n] = $s;
				}
			}
			foreach ($allRetrieved as $n => $s) {
				if ($s->type === $type) {
					$retrieved[$n] = $s;
				}
			}
			$params = array(
				'streams' => &$streams,
				'cached' => $cached,
				'retrieved' => $retrieved,
				'allCached' => $allCached,
				'allRetrieved' => $allRetrieved,
				'asUserId' => $asUserId,
				'publisherId' => $publisherId,
				'name' => $name,
				'criteria' => $criteria,
				'fields' => $fields,
				'options' => $options,
				'type' => $type
			);
			self::afterFetchExtended($publisherId, $s->type, $retrieved);
			/**
			 * @event Streams/fetch/$streamType {after}
			 * @param {&array} 'streams'
			 * @param {string} 'asUserId'
			 * @param {string} 'publisherId'
			 * @param {string} 'name'
			 * @param {array} 'criteria'
			 * @param {string} 'fields'
			 * @param {array} 'options'
			 */
			Q::event("Streams/fetch/$type", $params, 'after', false, $streams);
		}

		foreach ($streams as $n => $stream) {
			self::$fetch[$asUserId][$publisherId][$n][$fields] = $stream;
		}
		return $streams;
	}
	
	/**
	 * Fetches one stream from the database.
	 * @method fetch
	 * @static
	 * @param {string} $asUserId
	 *  Set this to the user for which you are fetching the streams.
	 *  If this matches the publisherId, just returns the streams.
	 *  If this is '', only returns the streams anybody can see.
	 *  Otherwise, return the streams joined with the calculated access settings.
	 *  If you pass null here, then either the logged-in user's id or '' will be used.
	 * @param {string} $publisherId
	 *  The id of the user publishing these streams
	 * @param {string|array|Db_Range} $name
	 *  The name of the stream to fetch. Can end in "/" for template streams.
	 *  Also it can be an array of stream names, or a custom Db_Range for stream names
	 * @param {string} $fields='*'
	 *  Must include "publisherId" and "name" fields, since they
	 *  make up the primary key of the stream table.
	 * @param {array} $options=array()
	 *  Optional. Defaults to array().
	 *  Provide additional stream selection options like 'limit', 'offset', 'orderBy', 'where' etc.
	 *  See Query/Mysql::options().
	 * @return {array|null}
	 *  Returns an array of Streams_Stream objects with access info calculated
	 *  specifically for $asUserId .
	 *  Make sure to call the methods testReadLevel(), testWriteLevel() and testAdminLevel()
	 *  on these streams before using them on the user's behalf.
	 */
	static function fetchOne(
		$asUserId,
		$publisherId,
		$name = 'Streams/user/',
		$fields = '*',
		$options = array())
	{
		$options['limit'] = 1;
		$streams = Streams::fetch($asUserId, $publisherId, $name, $fields, $options);
		if (empty($streams)) {
			return null;
		}
		return reset($streams);
	}
	
	/**
	 * Calculates the access for one or more streams by querying the database
	 * Modifies the objects in the $streams array, setting their access levels.
	 * After the function returns, you will be able to call the methods
	 * testReadLevel(), testWriteLevel() and testAdminLevel()
	 * on these streams before using them on the user's behalf.
	 * @method fetch
	 * @static
	 * @param {string} $asUserId
	 *  Set this to the user relative to whom access is calculated.
	 *  If this matches the publisherId, just sets full access and calls publishedByFetcher(true).
	 *  If this is '', only returns the streams anybody can see.
	 *  If this is null, the logged-in user's id is used, or '' if no one is logged in
	 * @param {string} $publisherId
	 *  The id of the user publishing these streams
	 * @param {array} $streams
	 *  An array of streams, obtained for example by Streams::fetch
	 * @param {boolean} $recalculate=false
	 *  Pass true here to force recalculating access to streams for which access was already calculated
	 * @return {integer}
	 *  The number of streams that were recalculated
	 */
	static function calculateAccess(
		$asUserId,
		$publisherId,
		$streams,
		$recalculate = false)
	{
		if (!isset($asUserId)) {
			$asUserId = Users::loggedInUser();
			if (!$asUserId) $asUserId = "";
		}
		if ($asUserId instanceof Users_User) {
			$asUserId = $asUserId->id;
		}
		if ($publisherId instanceof Users_User) {
			$publisherId = $publisherId->id;
		}
		if ($recalculate) {
			$streams2 = $streams;
		} else {
			$streams2 = array();
			foreach ($streams as $k => $s) {
				if ($s->get('readLevel', null) === null) {
					$streams2[$k] = $s;
				}
			}
		}
		if (empty($streams2)) {
			return 0;
		}
		
		$public_source = Streams::$ACCESS_SOURCES['public'];
		$contact_source = Streams::$ACCESS_SOURCES['contact'];
		$direct_source = Streams::$ACCESS_SOURCES['direct'];

		$streams3 = array();
		$names = array();
		foreach ($streams2 as $s) {
			if ($s->get('asUserId', null) === $asUserId) {
				continue;
			}
			$s->set('asUserId', $asUserId);
			if ($asUserId and $asUserId == $publisherId) {
				// The publisher should have full access to every one of their streams.
				$s->set('readLevel', Streams::$READ_LEVEL['max']);
				$s->set('writeLevel', Streams::$WRITE_LEVEL['max']);
				$s->set('adminLevel', Streams::$ADMIN_LEVEL['max']);
				$s->set('readLevel_source', $direct_source);
				$s->set('writeLevel_source', $direct_source);
				$s->set('adminLevel_source', $direct_source);
				$s->publishedByFetcher(true);
				continue;
			}
			$s->set('readLevel', $s->readLevel);
			$s->set('writeLevel', $s->writeLevel);
			$s->set('adminLevel', $s->adminLevel);
			$s->set('readLevel_source', $public_source);
			$s->set('writeLevel_source', $public_source);
			$s->set('adminLevel_source', $public_source);
			if (empty($asUserId)) {
				continue; // No need to fetch further access info.
			}

			$names[] = $s->name;
			$names[] = $s->type."*";
			$streams3[] = $s;
		}
		
		if (empty($names)) return count($streams2);

		// Get the per-label access data
		// Avoid making a join to allow more flexibility for sharding
		$accesses = Streams_Access::select('*')
		->where(array(
			'publisherId' => $publisherId,
			'streamName' => $names,
			'ofUserId' => array('', $asUserId)
		))->fetchDbRows();

		$labels = array();
		foreach ($accesses as $access) {
			if ($access->ofContactLabel) {
				$labels[] = $access->ofContactLabel;
			}
		}
		if (!empty($labels)) {
			$labels = array_unique($labels);
			$contacts = Users_Contact::select('*')
				->where(array(
					'userId' => $publisherId,
					'label' => $labels,
					'contactUserId' => $asUserId
				))->fetchDbRows();
			foreach ($contacts as $contact) {
				foreach ($accesses as $access) {
					if ($access->ofContactLabel !== $contact->label) {
						continue;
					}
					foreach ($streams3 as $stream) {
						$tail = substr($access->streamName, -1);
						$head = substr($access->streamName, 0, -1);
						if ($stream->name !== $access->streamName
						and ($tail !== '*' or $head !== $stream->type)) {
							continue;
						}
						$readLevel = $stream->get('readLevel', 0);
						$writeLevel = $stream->get('writeLevel', 0);
						$adminLevel = $stream->get('adminLevel', 0);
						if ($access->readLevel >= 0 and $access->readLevel > $readLevel) {
							$stream->set('readLevel', $access->readLevel);
							$stream->set('readLevel_source', $contact_source);
						}
						if ($access->writeLevel >= 0 and $access->writeLevel > $writeLevel) {
							$stream->set('writeLevel', $access->writeLevel);
							$stream->set('writeLevel_source', $contact_source);
						}
						if ($access->adminLevel >= 0 and $access->adminLevel > $adminLevel) {
							$stream->set('adminLevel', $access->adminLevel);
							$stream->set('adminLevel_source', $contact_source);
						}
					}
				}
			}
		}
	
		// Override with per-user access data
		foreach ($accesses as $access) {
			foreach ($streams3 as $stream) {
				$tail = substr($access->streamName, -1);
				$head = substr($access->streamName, 0, -1);
				if ($stream->name !== $access->streamName
				and ($tail !== '*' or $head !== $stream->type)) {
					continue;
				}
				if ($access->ofUserId === $asUserId) {
					if ($access->readLevel >= 0) {
						$stream->set('readLevel', $access->readLevel);
						$stream->set('readLevel_source', $direct_source);
					}
					if ($access->writeLevel >= 0) {
						$stream->set('writeLevel', $access->writeLevel);
						$stream->set('writeLevel_source', $direct_source);
					}
					if ($access->adminLevel >= 0) {
						$stream->set('adminLevel', $access->adminLevel);
						$stream->set('adminLevel_source', $direct_source);
					}
				}
			}
		}
		return count($streams2);
	}
	
	/**
	 * Calculates whether a given user is authorized by a specific publisher
	 * to create a particular type of stream.
	 * @method isAuthorizedToCreate
	 * @static
	 * @param {string} $userId The user who would be creating the stream.
	 * @param {string} $publisherId The id of the user who would be publishing the stream.
	 * @param {string} $streamType The type of the stream that would be created
	 * @param {array} $relate The user would also be authorized if the stream would be related to
	 *  an existing category stream, in which the user has a writeLevel of at least "relate",
	 *  and the user that would be publishing this new stream has a template for this stream type
	 *  that is related to either the category stream or a template matching the category stream.
	 *  To test for this, pass an array with the following keys:
	 *   "streamName" => The name of the stream to which the new stream would be related
	 *   "publisherId" => The id of the user publishing that stream, defaults to $publisherId
	 *   "type" => The type of relation, defaults to ""
	 * @return {Streams_Stream|boolean} Returns a stream template the user must use,
	 *  otherwise a boolean true/false to indicate a yes or no regardless of template.
	 */
	static function isAuthorizedToCreate(
		$userId,
		$publisherId,
		$streamType,
		$relate = array())
	{
		$authorized = false;
		if (!empty($relate['streamName'])) {
			if (empty($relate['publisherId'])) {
				$relate['publisherId'] = $publisherId;
			}
			if (empty($relate['type'])) {
				$relate['type'] = '';
			}
		}
		if ($publisherId == $userId) {
			$authorized = true; // user can publish streams under their own name
		}
		if (!$authorized) {
			// Check for permissions using templates
			$template = new Streams_Stream();
			$template->publisherId = $publisherId;
			$template->name = $streamType.'/';
			$template->type = 'Streams/template';
			$retrieved = $template->retrieve();
			if (!$retrieved) {
				$template->publisherId = '';
				$retrieved = $template->retrieve();
			}
			if ($retrieved) {
				$template->calculateAccess($userId);
				if ($template->testAdminLevel('own')) {
					$authorized = $template;
				}
			}
		}
		if (!$authorized and $retrieved and $relate['streamName']) {
			// Check if user is perhaps authorized to create a related stream
			$to_stream = Streams::fetchOne(
				$userId, $relate['publisherId'], $relate['streamName']
			);
			if ($to_stream and $to_stream->testWriteLevel('relate')) {
				$to_template = new Streams_Stream();
				$to_template->publisherId = $to_stream->publisherId;
				$to_template->name = $to_stream->type.'/';
				$to_template->type = 'Streams/template';
				$retrieved = $to_template->retrieve();
				if (!$retrieved) {
					$to_template->publisherId = '';
					$retrieved = $to_template->retrieve();
				}
				if ($retrieved) {
					$relatedTo = new Streams_RelatedTo();
					$relatedTo->toPublisherId = $to_template->publisherId;
					$relatedTo->toStreamName = $to_template->name;
					$relatedTo->type = $relate['type'];
					$relatedTo->fromPublisherId = $template->publisherId;
					$relatedTo->fromStreamName = $template->name;
					if ($retrieved = $relatedTo->retrieve()) {
						$authorized = $template;
					}
				}
			}
		}	
		return $authorized;
	}
	
	/**
	 * Creates a new stream in the system
	 * @method create
	 * @static
	 * @param {string} $asUserId The user who is attempting to create the stream.
	 * @param {string} $publisherId The id of the user to publish the stream.
	 * @param {string} $type The type of the stream to create.
	 * @param {array} $fields Use this to set additional fields for the stream:
	 * @param {string} [$fields.title=null] You can set the stream's title
	 * @param {string} [$fields.icon=null] You can set the stream's icon
	 * @param {string} [$fields.title=null] You can set the stream's content
	 * @param {string} [$fields.attributes=null] You can set the stream's attributes directly as a JSON string
	 * @param {string|integer} [$fields.readLevel=null] You can set the stream's read access level, see Streams::$READ_LEVEL
	 * @param {string|integer} [$fields.writeLevel=null] You can set the stream's write access level, see Streams::$WRITE_LEVEL
	 * @param {string|integer} [$fields.adminLevel=null] You can set the stream's admin access level, see Streams::$ADMIN_LEVEL
	 * @param {string} [$fields.name=null] Here you can specify an exact name for the stream to be created. Otherwise a unique one is generated automatically.
	 * @param {boolean} [$fields.skipAccess=false] Skip all access checks when creating and relating the stream.
	 * @param {array} $relate The user would also be authorized if the stream would be related to
	 *  an existing category stream, in which the user has a writeLevel of at least "relate",
	 *  and the user that would be publishing this new stream has a template for this stream type
	 *  that is related to either the category stream or a template matching the category stream.
	 *  To test for this, pass an array with the following keys:
	 * @param {string} $relate.publisherId The id of the user publishing that stream, defaults to $publisherId
	 * @param {string} $relate.streamName The name of the stream to which the new stream would be related
	 * @param {string} [$relate.type] The type of relation, defaults to ""
	 * @return {Streams_Stream|boolean} Returns the stream that was created.
	 * @throws {Users_Exception_NotAuthorized}
	 */
	static function create(
		$asUserId, 
		$publisherId, 
		$type, 
		$fields = array(), 
		$relate = null)
	{
		$skipAccess = Q::ifset($fields, 'skipAccess', false);
		if (!isset($asUserId)) {
			$asUserId = Users::loggedInUser();
			if (!$asUserId) $asUserId = "";
		}
		if ($asUserId instanceof Users_User) {
			$asUserId = $asUserId->id;
		}
		if ($publisherId instanceof Users_User) {
			$publisherId = $publisherId->id;
		}
		$authorized = self::isAuthorizedToCreate(
			$asUserId, $publisherId, $type, $relate
		);
		if (!$authorized and !$skipAccess) {
			throw new Users_Exception_NotAuthorized();
		}
		
		// OK we are good to go!
		$stream = new Streams_Stream;
		$stream->publisherId = $publisherId;
		if (!empty($fields['name'])) {
			$p = new Q_Tree();
			$p->load(STREAMS_PLUGIN_CONFIG_DIR.DS.'streams.json');
			$p->load(APP_CONFIG_DIR.DS.'streams.json');
			if ($info = $p->get($fields['name'], array())) {
				foreach (Base_Streams_Stream::fieldNames() as $f) {
					if (isset($info[$f])) {
						$stream->$f = $info[$f];
					}
				}
			}
		}
		if (!isset($stream->type)) {
			$stream->type = $type;
		}

		// extend with any config defaults for this stream type
		$fieldNames = Streams::getExtendFieldNames($type);
		$fieldNames[] = 'name';
		$defaults = Q_Config::get('Streams', 'types', $type, 'defaults', array());
		foreach ($fieldNames as $f) {
			if (isset($fields[$f])) {
				$stream->$f = $fields[$f];
			} else if (array_key_exists($f, $defaults)) {
				$stream->$f = $defaults[$f];
			}
		}
		
		// handle setting of attributes
		if (isset($fields['attributes']) and is_array($fields['attributes'])) {
			$stream->setAttribute($fields['attributes']);
			unset($fields['attributes']);
		}
	
		// ready to persist this stream to the database
		$stream->save();
		$stream->post($asUserId, array(
			'type' => 'Streams/created',
			'content' => '',
			'instructions' => Q::json_encode($stream->toArray())
		), true);
		
		// relate the stream to category stream, if any
		if ($relate['streamName']) {
			$result = Streams::relate(
				$asUserId,
				$relate['publisherId'], 
				$relate['streamName'], 
				$relate['type'], 
				$stream->publisherId, 
				$stream->name,
				array(
					'weight' => isset($relate['weight']) ? $relate['weight'] : null,
					'skipAccess' => $skipAccess
				)
			);
			Q_Response::setSlot('messageTo', $result['messageTo']->exportArray());
		}
		return $stream;
	}

	/**
	 * Takes some information out of an existing set of streams
	 * @method take
	 * @static
	 * @param {array} $streams
	 * @param {string} $name
	 * @param {string} $readLevel
	 *  Test each stream for at least this read level.
	 *  If the test fails, return null in its stead.
	 * @param {string|array} $field='content'
	 *  Optional. Defaults to "content".
	 *  Can be an array of fields, in which case the function returns an array.
	 * @param {boolean} $escape=true
	 *  Defaults to false. If true, escapes the values as HTML
	 * @return {mixed}
	 *  Returns the value of the field, or an array of values, depending on
	 *  whether $field is an array or a string
	 */
	static function take(
		$streams,
		$name,
		$readLevel,
		$field = 'content',
		$escape = false)
	{
		if (!isset($streams[$name])) {
			return null;
		}
		$result = array();
		$was_array = is_array($field);
		$arr = $was_array ? $field : array($field);
		foreach ($arr as $f) {
			if (!isset($streams[$name]->$f))  {
				return null;
			}
			if (!$streams[$name]->testReadLevel($readLevel)) {
				return null;
			}
			$result[$f] = !$escape
				? $streams[$name]->$f
				: Q_Html::text($streams[$name]->$f);
		}
		return $was_array ? $result : reset($result);
	}

	/**
	 * Get all the streams starting with "Streams/user/" for a particular user
	 * @method forUser
	 * @static
	 * @param {string} $publisherId
	 *  The id of the user who is publishing the streams.
	 * @return {array}
	 */
	static function forUser($asUserId, $publisherId)
	{
		if (!isset($asUserId) or !isset($publisherId)) {
			return null;
		}
		return Streams::fetch($asUserId, $publisherId, 'Streams/user/', '*');
	}

	/**
	 * A shorthand to get fields from a stream, etc.
	 * @method my
	 * @static
	 * @param {string|array} $field='content'
	 *  Optional. Defaults to "content".
	 *  Can be an array of fields, in which case the function returns an array.
	 * @param {boolean} $escape=false
	 *  Defaults to false. If true, escapes as HTML
	 * @return {mixed}
	 *  Returns the value of the field, or an array of values, depending on
	 *  whether $field is an array or a string
	 */
	static function my($name, $field = 'content', $escape = false)
	{
		$user = Users::loggedInUser();
		if (!$user) {
			return null;
		}
		$streams = Streams::forUser($user->id, $user->id);
		// Since it's our stream, the testReadLevel will always succeed
		return Streams::take($streams, $name, 0, $field, $escape);
	}

	/**
	 * Get the publisher id from the request, if it can be deduced
	 * @method requestedPublisherId
	 * @static
	 * @param {boolean} $throwIfMissing=false
	 *  Optional. If true, throws an exception if the publisher id cannot be deduced
	 * @return {integer}
	 *  The id of the publisher user
	 * @throws {Users_Exception_NoSuchUser}
	 *  If the URI contains an invalid "username"
	 * @throws {Q_Exception_RequiredField}
	 *  If the username can't be deduced, this is thrown
	 */
	static function requestedPublisherId($throwIfMissing = false)
	{
		if (isset(self::$requestedPublisherId_override)) {
			return self::$requestedPublisherId_override;
		}
		$uri = Q_Dispatcher::uri();
		if (isset($_REQUEST['publisherId'])) {
			return $_REQUEST['publisherId'];
		} else if (isset($uri->publisherId)) {
			return $uri->publisherId;
		} else if (isset($uri->username)) {
			$publisher = new Users_User();
			$publisher->username = $uri->username; // Warning: SECONDARY_LOOKUP
			if (!$publisher->retrieve()) {
				throw new Users_Exception_NoSuchUser(array(), 'username');
			}
			return $publisher->id;
		}
		if (Streams::$followedInvite) {
			return Streams::$followedInvite->publisherId;
		}
		if ($throwIfMissing) {
			throw new Q_Exception_RequiredField(
				array('field' => 'publisher id'),
				'publisherId'
			);
		}
		return null;
	}

	/**
	 * Get the stream name from the request, if it can be deduced.
	 * Checks $_REQUEST['streamName'], then tries $_REQUEST['name'].
	 * If both are empty, tries Q_Dispatcher::uri() and returns "{$uri->name_prefix}{$uri->name}",
	 * which is useful when the URL contains just the last part of a stream's name.
	 * @method requestedName
	 * @static
	 * @param {boolean} $throwIfMissing=false
	 *  Optional. If true, throws an exception if the stream name cannot be deduced
	 * @param {string} $return_as
	 *  Defaults to "string". Can also be "array" or "original"
	 * @return {string}
	 *  The name of the stream
	 * @throws {Q_Exception_RequiredField}
	 *  If the name can't be deduced, this is thrown
	 */
	static function requestedName($throwIfMissing = false, $return_as = 'string')
	{
		if (isset(self::$requestedName_override)) {
			return self::$requestedName_override;
		}
		$uri = Q_Dispatcher::uri();
		if (isset($_REQUEST['streamName'])) {
			$result = $_REQUEST['streamName'];
		} else if (isset($_REQUEST['name'])) {
			$result = $_REQUEST['name'];
		} else if (isset($uri->name)) {
			if (is_array($uri->name)) {
				$result = implode('/', $uri->name);
			}
			$result = $uri->name;
		}
		if (isset($result)) {
			if ($return_as === 'string' and is_array($result)) {
				$result = implode('/', $result);
			}
			if ($return_as === 'array' and is_string($result)) {
				$result = explode('/', $result);
			}
			if (is_array($result)) {
				if (isset($uri->name_prefix)) {
					foreach ($result as $k => $v) {
						$result[$k] = $uri->name_prefix.$result;
					}
				}
				return $result;
			}
			if (!is_string($result)) {
				return $result;
			}
			return isset($uri->name_prefix) ? $uri->name_prefix.$result : $result;
		}
		if (Streams::$followedInvite) {
			return Streams::$followedInvite->streamName;
		}
		if ($throwIfMissing) {
			throw new Q_Exception_RequiredField(
				array('field' => 'stream name'),
				'streamName'
			);
		}
		return null;
	}

	/**
	 * Get the stream type from the request, if it can be deduced
	 * @method requestedType
	 * @static
	 * @param {boolean} $throwIfMissing=false
	 *  Optional. If true, throws an exception if the stream type cannot be deduced
	 * @return {string}
	 *  The type of the stream
	 * @throws {Q_Exception_RequiredField}
	 *  If the type can't be deduced, this is thrown
	 */
	static function requestedType($throwIfMissing = false)
	{
		$uri = Q_Dispatcher::uri();
		if (isset($_REQUEST['streamType'])) {
			return $_REQUEST['streamType'];
		} else if (isset($_REQUEST['type'])) {
			return $_REQUEST['type'];
		} else if (isset($uri->type)) {
			return $uri->type;
		}
		if ($throwIfMissing) {
			throw new Q_Exception_RequiredField(
				array('field' => 'stream type'),
				'streamType'
			);
		}
		return null;
	}

	/**
	 * Get the message type from the request, if it can be deduced
	 * @method requestedType
	 * @static
	 * @param {boolean} $throwIfMissing=false
	 *  Optional. If true, throws an exception if the message type cannot be deduced
	 * @return {string}
	 *  The type of the message
	 * @throws {Q_Exception_RequiredField}
	 *  If the type can't be deduced, this is thrown
	 */
	static function requestedMessageType($throwIfMissing = false)
	{
		$uri = Q_Dispatcher::uri();
		if (isset($_REQUEST['type'])) {
			return $_REQUEST['type'];
		} else if (isset($uri->type)) {
			return $uri->type;
		}
		if ($throwIfMissing) {
			throw new Q_Exception_RequiredField(
				array('field' => 'message type'),
				array('type')
			);
		}
		return null;
	}

	/**
	 * Get the stream field from the request, if it can't be deduced throws error
	 * @method requestedField
	 * @static
	 * @param {string} $field
	 *	The fiels name
	 * @param {boolean} $throwIfMissing=false
	 *  Optional. If true, throws an exception if the stream field cannot be deduced
	 * @param {mixed} $default=null
	 *	Is returned if field is not set
	 * @return {string}
	 *  The value of the field
	 * @throws {Q_Exception_RequiredField}
	 *  If the field value can't be deduced, this is thrown
	 */
	static function requestedField($field, $throwIfMissing = false, $default = null)
	{
		$uri = Q_Dispatcher::uri();
		if (isset($_REQUEST[$field])) {
			return $_REQUEST[$field];
		} else if (isset($uri->$field)) {
			if (is_array($uri->$field)) {
				return implode('/', $uri->$field);
			}
			return $uri->$field;
		} else if ($field = Q_Request::special("Streams.$field", $default)) {
			return $field;
		}
		if ($throwIfMissing) {
			throw new Q_Exception_RequiredField(
				array('field' => "stream $field"),
				$field
			);
		}
		return $default;
	}

	/**
	 * Get the fields that have been requested in the request, otherwise '*'
	 * @method requestedFields
	 * @static
	 * @return {array|string}
	 *  An array or string of fields to select
	 * @throws {Q_Exception}
	 *	If requested field name is invalid
	 */
	static function requestedFields()
	{
		if (empty($_REQUEST['fields'])) {
			return '*';
		}
		$fields = explode(',', $_REQUEST['fields']);
		$fieldNames = Streams_Stream::fieldNames();
		foreach ($fields as $f) {
			if (!in_array($f, $fieldNames)){
				throw new Q_Exception("Invalid field name $f", 'fields');
			}
		}
		if (!in_array('publisherId', $fields)) {
			$fields[] = 'publisherId';
		}
		if (!in_array('name', $fields)) {
			$fields[] = 'name';
		}
		return $fields;
	}

	/**
	 * Produce user's display name
	 * @method displayName
	 * @static
	 * @param {string|Users_User} $userId
	 *  Can be Users_User object or a string containing a user id
	 * @param {array} $streams=null
	 *  An array of streams fetched for this user.
	 *  If it is null, we fetch them as the logged-in user.
	 * @param {array} $options=array()
	 *  Associative array of options, which can include:<br/>
	 *  "fullAccess" => Ignore the access restrictions for the name<br/> 
	 *  "short" => Only display the first name<br/>
	 *  "html" => If true, encloses the first and last name in span tags<br/>
	 *  "escape" => If true, does HTML escaping of the retrieved fields
	 * @param {string|null} $default
	 *  What to return if there is no info to get displayName from.
	 * @return {string|null}
	 */
	static function displayName($userId, $options = array(), $default = null)
	{
		if ($userId instanceof Users_User) {
			$userId = $userId->id;
		}
		if (!empty($options['fullAccess'])) {
			$asUserId = $userId;
		} else {
			$asUser = Users::loggedInUser();
			$asUserId = $asUser ? $asUser->id : "";
		}
		$avatar = Streams_Avatar::fetch($asUserId, $userId);
		return $avatar ? $avatar->displayName($options, $default) : $default;
	}

	/**
	 * Updates the publisher's avatar, as it appears to $toUserId
	 * This function should be called during events that may cause the
	 * publisher's avatar to change appearance for certain users viewing it.
	 * These are usually rare events, and include things like:<br/>
	 *   adding, removing or modifying a contact
	 * @method updateAvatar
	 * @static
	 * @param {integer} $toUserId
	 *  id of the user who will be viewing this avatar
	 * @param {string} $publisherId
	 *  id of the publisher whose avatar to update
	 * @return {boolean}
	 */
	static function updateAvatar($toUserId, $publisherId)
	{
		$user = new Users_User();
		$user->id = $publisherId;
		if (!$user->retrieve(null, null, true)->ignoreCache()->resume()) {
			return false;
		}

		// Fetch some streams as the contact user
		$streams = Streams::fetch($toUserId, $publisherId, array(
			'Streams/user/firstName', 'Streams/user/lastName'
		));
		$firstName = Streams::take($streams, 'Streams/user/firstName', 'content');
		$lastName = Streams::take($streams, 'Streams/user/lastName', 'content');

		// Update the Streams_avatar table
		Streams_Avatar::update()->set(array(
			'firstName' => $firstName,
			'lastName' => $lastName,
			'username' => $user->username,
			'icon' => $user->icon
		))->where(array(
			'toUserId' => $toUserId,
			'publisherId' => $publisherId
		))->execute();

		return true;
	}

	/**
	 * Updates the publisher's avatars, which may have changed with the taintedAccess.
	 * This function should be called during rare events that may cause the
	 * publisher's avatar to change appearance for certain users viewing it.<br/>
	 *
	 * You should rarely have to call this function. It is used internally by the model,
	 * in two main situations:
	 *
	 * 1)  adding, removing or modifying a Streams_Access row for Streams/user/firstName or Streams/user/lastName
	 *	In this case, the function is able to update exactly the avatars that need updating.
	 * 
	 * 2) adding, removing or modifying a Stream row for Streams/user/firstName or Streams/user/lastName
	 *	In this case, there may be some avatars which this function will miss.
	 *	These correspond to users which are reachable by the access array for one stream,
	 *	but not the other. For example, if Streams/user/firstName is being updated, but
	 *	a particular user is reachable only by the access array for Streams/user/lastName, then
	 *	their avatar will not be updated and contain a stale value for firstName.
	 *	To fix this, the Streams_Stream model passes true in the 4th parameter to this function.
	 * @method updateAvatars
	 * @static
	 * @param {string} $publisherId
	 *  id of the publisher whose avatar to update
	 * @param {array} $taintedAccess
	 *  array of Streams_Access objects representing access information that is either
	 *  about to be saved, are about to be overwritten, or will be deleted
	 * @param {string|Streams_Stream} $streamName
	 *  pass the stream name here. You can also pass a Stream_Stream object here,
	 *  in which case it will be used, instead of selecting that stream from the database.
	 * @param {boolean} $updateToPublicValue=false
	 *  if you want to first update all the avatars for this stream
	 *  to the what the public would see, to avoid the situation described in 2).
	 */
	static function updateAvatars(
		$publisherId, 
		$taintedAccess, 
		$streamName, 
		$updateToPublicValue = false)
	{
		if (!isset($streamName)) {
			$streamAccesses = array();
			foreach ($taintedAccess as $access) {
				$streamAccesses[$access->streamName][] = $access;
			}
			if (count($streamAccesses) > 1) {
				foreach ($streamAccesses as $k => $v) {
					self::updateAvatars($publisherId, $v, $k);
				}
				return false;
			}
		}
		if ($streamName instanceof Streams_Stream) {
			$stream = $streamName;
			$streamName = $stream->name;
		}

		// If we are here, all the Stream_Access objects have the same streamName
		if ($streamName !== 'Streams/user/firstName'
		and $streamName !== 'Streams/user/lastName'
		and $streamName !== 'Streams/user/username') {
			// we don't care about access to other streams being updated
			return false;
		}
		$showToUserIds = array();

		// Select the user corresponding to this publisher
		$user = new Users_User();
		$user->id = $publisherId;
		if (!$user->retrieve(null, null, array('ignoreCache' => true))) {
			throw new Q_Exception_MissingRow(array(
				'table' => 'user',
				'criteria' => 'id = '.$user->id
			));
		}

		// Obtain the stream object to use
		if (isset($stream)) {
			if (!isset($stream->content)) {
				$stream->content = '';
			}
		} else {
			// If the $stream isn't already defined, select it
			$stream = new Streams_Stream();
			$stream->publisherId = $publisherId;
			$stream->name = $streamName;
			if (!$stream->retrieve()) {
				// Strange, this stream doesn't exist.
				// Well, we will just silently set the content to '' then
				$stream->content = '';
			}
		}

		$content_readLevel = Streams::$READ_LEVEL['content'];
		$readLevels = array();
		$label_readLevels = array();
		$contact_label_list = array();
		$removed_labels = array();

		// First, assign all the readLevels that are directly set for specific users,
		// and aggregate the contact_labels from the other accesses, for an upcoming select.
		foreach ($taintedAccess as $access) {
			if ($userId = $access->ofUserId) {
				$readLevel = $access->readLevel;
				$readLevels[$userId] = $readLevel;
				if ($readLevel < 0) {
					$showToUserIds[$userId] = null; // not determined yet
				} else if ($readLevel >= $content_readLevel) {
					$showToUserIds[$userId] = true;
				} else {
					$showToUserIds[$userId] = false;
				}
			} else if ($access->ofContactLabel) {
				$ofContactLabel = $access->ofContactLabel;
				$contact_label_list[] = $ofContactLabel;
				if ($access->get('removed', false)) {
					$removed_labels[$ofContactLabel] = true;
				} else {
					$label_readLevels[$ofContactLabel] = $access->readLevel;
				}
			}
		}

		// Now, get all the people affected by this change, and their readLevels
		$readLevels2 = array();
		if ($contact_label_list) {
			$contact_label_list = array_unique($contact_label_list);
			$contacts = Users_Contact::select('*')
				->where(array(
					'userId' => $publisherId,
					'label' => $contact_label_list
				))->fetchDbRows(null, '', 'contactUserId');
			foreach ($contacts as $contact) {
				$contactUserId = $contact->contactUserId;
				if (isset($showToUserIds[$contactUserId])) {
					// this user had their read level set directly by the access,
					// which overrides read levels set by access using ofContactLabel
					continue;
				}
				if (isset($removed_labels[$ofContactLabel])) {
					// this label doesn't affect readLevels anymore, since it was deleted
					// but put this contact's id on a list whose readLevels need to be determined
					$showToUserIds[$contactUserId] = null;
					continue;
				}
				if (!isset($label_readLevels[$contact->label])) {
					continue;
				}
				$readLevel = $label_readLevels[$contact->label];
				if (!isset($readLevels2[$contactUserId])) {
					$readLevels2[$contactUserId] = $readLevel;
				} else {
					$readLevels2[$contactUserId] = max(
						$readLevels2[$contactUserId],
						$readLevel
					);
				}
			}
		}

		// Now step through all the users we found who were found through ofContactLabel
		// and make sure we update the avatar rows that were meant for them.
		foreach ($readLevels2 as $userId => $rl) {
			if ($rl >= $content_readLevel) {
				$showToUserIds[$userId] = true;
			} else {
				// in order for this to happen, two things had to be true:
				// 1) there was no access that directly set a readLevel >= $content_readLevel
				// 2) there was no access that set a readLevel >= $content_readLevel for any label containing this user
				// therefore, their view should be the public view
				$showToUserIds[$userId] = 'public';
			}
		}

		// Resolve all the undetermined readLevels
		foreach ($showToUserIds as $userId => $v) {
			if (!isset($v)) {
				// if the readLevel hasn't been determined by now, it's the same as the public one
				$showToUserIds[$userId] = 'public';
			}
		}
		
		// Set up the self avatar:
		$showToUserIds[$publisherId] = true;

		// Finally, set up the public avatar:
		if (!isset($stream->readLevel)) {
			$stream->readLevel = Streams_Stream::$DEFAULTS['readLevel'];
		}
		$showToUserIds[""] = ($stream->readLevel >= $content_readLevel);

		// Now, we update the avatars:
		$parts = explode('/', $streamName);
		$field = end($parts);
		$rows_that_show = array();
		$rows_that_hide = array();
		foreach ($showToUserIds as $userId => $show) {
			if ($show === 'public') {
				// If no show is explicitly specified, use the value used for the rest of the public
				$show = $showToUserIds[""];
			}
			if ($show === true) {
				$rows_that_show[] = array(
					'publisherId' => $publisherId,
					'toUserId' => $userId,
					'username' => $user->username,
					'icon' => $user->icon,
					'updatedTime' => new Db_Expression("CURRENT_TIMESTAMP"),
					$field => $stream->content
				);
			} else if ($show === false) {
				$rows_that_hide[] = array(
					'publisherId' => $publisherId,
					'toUserId' => $userId,
					'username' => $user->username,
					'icon' => $user->icon,
					'updatedTime' => new Db_Expression("CURRENT_TIMESTAMP"),
					$field => ''
				);
			}
		}
		$updates_that_show = array(
			'username' => $user->username,
			'icon' => $user->icon,
			'updatedTime' => new Db_Expression("CURRENT_TIMESTAMP"),
			$field => $stream->content
		);
		$updates_that_hide = array(
			'username' => $user->username,
			'icon' => $user->icon,
			'updatedTime' => new Db_Expression("CURRENT_TIMESTAMP"),
			$field => ''
		);

		// We are now ready to make changes to the database.
		if ($updateToPublicValue) {
			Streams_Avatar::update()
				->set(array($field => $showToUserIds[""] ? $stream->content : ''))
				->where(compact('publisherId'))
				->execute();
		}
		Streams_Avatar::insertManyAndExecute($rows_that_show, array('onDuplicateKeyUpdate' => $updates_that_show));
		Streams_Avatar::insertManyAndExecute($rows_that_hide, array('onDuplicateKeyUpdate' => $updates_that_hide));
	}

	/**
	 *
	 * @method getRelation
	 * @private
	 * @param {string} $asUserId
	 *  The user who is fetching
	 * @param {string} $toPublisherId
	 *  The publisher of the category
	 * @param {string} $toStreamName
	 *  The name of the category
	 * @param {string} $type
	 *  The type of the relation
	 * @param {string} $fromPublisherId
	 *  The publisher of the member stream(s)
	 * @param {string} $fromStreamName
	 *  The name of the member stream(s)
	 * @param {array} $options=array()
	 *  An array of options that can include:
	 *  "skipAccess" => Defaults to false. If true, skips the access checks and just relates the stream to the category
	 * @param {&Streams_RelatedTo} $relatedTo
	 * @param {&Streams_RelatedFrom} $relatedFrom
	 */
	private static function getRelation(
		$asUserId,
		$toPublisherId,
		$toStreamName,
		$type,
		$fromPublisherId,
		$fromStreamName,
		&$relatedTo,
		&$relatedFrom,
		&$category,
		&$stream,
		$options = array())
	{
		if (!isset($asUserId)) {
			$asUserId = Users::loggedInUser();
			if (!$asUserId) $asUserId = "";
		}
		if ($asUserId instanceof Users_User) {
			$asUserId = $asUserId->id;
		}
		if ($toPublisherId instanceof Users_User) {
			$toPublisherId = $toPublisherId->id;
		}

		// Check access to category stream, the stream to which other streams are related
		$category = Streams::fetchOne($asUserId, $toPublisherId, $toStreamName);
		if (!$category) {
			throw new Q_Exception("Category not found", compact(
				'toPublisherId', 'toStreamName'
			));
		}

		if (empty($options['skipAccess'])) {
			if (!$category->testWriteLevel('relate')) {
				throw new Users_Exception_NotAuthorized();
			}
		}

		// Find member stream, the stream which is being related
		$stream = Streams::fetchOne($asUserId, $fromPublisherId, $fromStreamName);
		if (!$stream) {
			throw new Q_Exception("Stream $fromStreamName not found", array('fromStreamName', 'fromPublisherId'));
		}

		$relatedTo = new Streams_RelatedTo();
		$relatedTo->toPublisherId = $toPublisherId;
		$relatedTo->toStreamName = $toStreamName;
		$relatedTo->type = $type;
		$relatedTo->fromPublisherId = $fromPublisherId;
		$relatedTo->fromStreamName = $fromStreamName;

		$relatedFrom = new Streams_RelatedFrom();
		$relatedFrom->fromPublisherId = $fromPublisherId;
		$relatedFrom->fromStreamName = $fromStreamName;
		$relatedFrom->type = $type;
		$relatedFrom->toPublisherId = $toPublisherId;
		$relatedFrom->toStreamName = $toStreamName;
	}

	/**
	 * Make the stream a member of category or other aggregating stream,
	 * First parameter set - where to add, Second parameter set - what to add
	 * NOTE: this currently only works when fromPublisherId and toPublisherId are on same Q cluster
	 * @method relate
	 * @static
	 * @param {string} $asUserId
	 *  The user who is making aggreagtor operation on the stream (add stream to category)
	 * @param {string} $toPublisherId
	 *  The user who has published the category stream
	 * @param {string} $toStreamName
	 *  The name of the category stream
	 * @param {string} $type
	 *  The type of the relation
	 * @param {string} $fromPublisherId
	 *  The user who has published the member stream
	 * @param {string} $fromStreamName
	 *  The name of the member stream
	 * @param {array} $options=array()
	 *  An array of options that can include:
	 *  "skipAccess" => Defaults to false. If true, skips the access checks and just relates the stream to the category
	 *  "weight" => Pass a numeric value here, or something like "max+1" to make the weight 1 greater than the current MAX(weight)
	 * @return {array|boolean}
	 *  Returns false if the operation was canceled by a hook
	 *  Returns true if relation was already there
	 *  Otherwise returns array with keys "messageFrom" and "messageTo" and values of type Streams_Message
	 */
	static function relate(
		$asUserId,
		$toPublisherId,
		$toStreamName,
		$type,
		$fromPublisherId,
		$fromStreamName,
		$options = array())
	{
		if (!isset($asUserId)) {
			$asUserId = Users::loggedInUser();
			if (!$asUserId) $asUserId = "";
		}
		if ($asUserId instanceof Users_User) {
			$asUserId = $asUserId->id;
		}
		if ($toPublisherId instanceof Users_User) {
			$toPublisherId = $toPublisherId->id;
		}
		if (!isset($options)) {
			$options = array();
		}
		
		self::getRelation(
			$asUserId,
			$toPublisherId,
			$toStreamName,
			$type,
			$fromPublisherId,
			$fromStreamName,
			$relatedTo,
			$relatedFrom,
			$category,
			$stream,
			$options);

		$to_exists = $relatedTo->retrieve();
		$from_exists = $relatedFrom->retrieve();

		// Recover from inconsistency:
		// if one exists but not the other, clean up and start over
		if (($to_exists && !$from_exists) || (!$to_exists && $from_exists)) {
			if ($to_exists) $relatedTo->remove();
			if ($from_exists) $relatedFrom->remove();
			$to_exists = $from_exists = false;
		}

		if ($to_exists && $from_exists) {
			return true;
		}

		// Now, set up the relation.
		/**
		 * @event Streams/relate/$streamType {before}
		 * @param {string} 'relatedTo'
		 * @param {string} 'relatedFrom'
		 * @param {string} 'asUserId'
		 * @return {false} To cancel further processing
		 */
		if (false === Q::event(
			"Streams/relate/{$stream->type}",
			compact('relatedTo', 'relatedFrom', 'asUserId'),
			'before'
		)) {
			return false;
		}

		/*
		 * save 'Streams/relation' to $relatedTo.
		 * we consider category stream as 'remote' i.e. more error prone.
		 * If first save fails, 'Streams/related' saved
		 */

		$weight = isset($options['weight']) ? $options['weight'] : null;

		if (!isset($relatedTo->weight) and isset($weight)) {
			$parts = explode('+', "$weight");
			if (count($parts) > 1 and is_numeric($parts[1])) {
				$row = Streams_RelatedTo::select('MAX(weight)')
					->where(compact('toPublisherId', 'toStreamName', 'type'))
					->ignoreCache()
					->getSql("Q::log")
					->fetchAll(PDO::FETCH_COLUMN);
				$weight = reset($row);
				$weight += $parts[1];
			} else if (!is_numeric($weight)) {
				throw new Q_Exception_WrongValue(array('field' => 'weight', 'range' => 'a numeric value'), 'weight');
			}
			$relatedTo->weight = $weight;
		}

		try {
			$relatedTo->save();
		} catch (Exception $e) {
			// posting 'Streams/relation' failed. Relation is inconsistent.
			// JUNK: this leaves junk in the database, but preserves consistency
			throw new Streams_Exception_Relation();
		}

		// Send Streams/relatedTo message to a stream
		// node server will be notified by Streams_Message::post
		// DISTRIBUTED: in the future, the publishers may be on separate domains
		// so posting this message may require internet communication.
		$relatedTo_message = Streams_Message::post($asUserId, $toPublisherId, $toStreamName, array(
			'type' => 'Streams/relatedTo',
			'instructions' => Q::json_encode(compact('fromPublisherId', 'fromStreamName', 'type', 'weight'))
		), true);

		try {
			$relatedFrom->save();
		} catch (Exception $e) {
			throw new Streams_Exception_Relation();
		}

		// Send Streams/relatedFrom message to a stream
		// node server will be notified by Streams_Message::post
		// DISTRIBUTED: in the future, the publishers may be on separate domains
		// so posting this message may require internet communication.
		$relatedFrom_message = Streams_Message::post($asUserId, $fromPublisherId, $fromStreamName, array(
			'type' => 'Streams/relatedFrom',
			'instructions' => Q::json_encode(compact('toPublisherId', 'toStreamName', 'type', 'weight'))
		), true);

		/**
		 * @event Streams/relate/$streamType {after}
		 * @param {string} 'relatedTo'
		 * @param {string} 'relatedFrom'
		 * @param {string} 'asUserId'
		 */
		Q::event(
			"Streams/relate/{$stream->type}",
			compact('relatedTo', 'relatedFrom', 'asUserId'),
			'after'
		);

		return array(
			'messageFrom' => $relatedFrom_message, 
			'messageTo' => $relatedTo_message
		);
	}

	/**
	 * Attempt to remove the stream from category or other aggregating stream,
	 * First parameter set - where to remove, Second parameter set - what to remove
	 * NOTE: this currently only works when fromPublisherId and toPublisherId are on same Q cluster
	 * @method unrelate
	 * @static
	 * @param {string} $asUserId
	 *  The user who is making aggreagtor operation on the stream (remove stream from category)
	 * @param {string} $toPublisherId
	 *  The user who has published the category stream
	 * @param {string} $toStreamName
	 *  The name of the category stream
	 * @param {string} $type
	 *  The type of the relation
	 * @param {string} $fromPublisherId
	 *  The user who has published the member stream
	 * @param {string} $fromStreamName
	 *  The name of the member stream
	 * @param {array} $options=array()
	 *  An array of options that can include:
	 *  "skipAccess" => Defaults to false. If true, skips the access checks and just relates the stream to the category
	 *  "adjustWeights" => Defaults to false. If true, also decrements all following relations' weights by one.
	 * @return {boolean}
	 *  Whether the relation was removed
	 */
	static function unrelate(
		$asUserId,
		$toPublisherId,
		$toStreamName,
		$type,
		$fromPublisherId,
		$fromStreamName,
		$options = array())
	{
		self::getRelation(
			$asUserId,
			$toPublisherId,
			$toStreamName,
			$type,
			$fromPublisherId,
			$fromStreamName,
			$relatedTo,
			$relatedFrom,
			$category,
			$stream,
			$options);

		$to = $relatedTo->retrieve();
		$from = $relatedFrom->retrieve();

		if (!$to && !$from) {
			return false;
		}

		// Now, clean up the relation.
		/**
		 * @event Streams/unrelate/$streamType {before}
		 * @param {string} 'relatedTo'
		 * @param {string} 'relatedFrom'
		 * @param {string} 'asUserId'
		 * @return {false} To cancel further processing
		 */
		if (Q::event(
			"Streams/unrelate/{$stream->type}",
			compact('relatedTo', 'relatedFrom', 'asUserId'), 
			'before') === false
		) {
			return;
		}

		/*
		 * remove 'Streams/relation' from $relatedTo.
		 * we consider category stream as 'remote' i.e. more error prone.
		 */

		$weight = isset($relatedTo->weight) ? $relatedTo->weight : null;
		if ($to && $relatedTo->remove()) {
			if (isset($weight) and !empty($options['adjustWeights'])) {
				$criteria = array(
					'toPublisherId' => $toPublisherId,
					'toStreamName' => $toStreamName,
					'type' => $type,
					'weight' => new Db_Range($weight, false, false, null)
				);
				Streams_RelatedTo::update()->set(array(
					'weight' => new Db_Expression("weight - 1")
				))->where($criteria)->execute();
			}
			
			// Send Streams/unrelatedTo message to a stream
			// node server will be notified by Streams_Message::post
			Streams_Message::post($asUserId, $toPublisherId, $toStreamName, array(
				'type' => 'Streams/unrelatedTo',
				'instructions' => Q::json_encode(compact(
					'fromPublisherId', 'fromStreamName', 'type', 'options', 'weight'
				))
			), true);
		}

		if ($from && $relatedFrom->remove()) {
			// Send Streams/unrelatedFrom message to a stream
			// node server will be notified by Streams_Message::post
			Streams_Message::post($asUserId, $fromPublisherId, $fromStreamName, array(
				'type' => 'Streams/unrelatedFrom',
				'instructions' => Q::json_encode(compact(
					'toPublisherId', 'toStreamName', 'type', 'options'
				))
			), true);
		}

		/**
		 * @event Streams/unrelste/$streamType {after}
		 * @param {string} 'relatedTo'
		 * @param {string} 'relatedFrom'
		 * @param {string} 'asUserId'
		 */
		Q::event(
			"Streams/unrelate/{$stream->type}",
			compact('relatedTo', 'relatedFrom', 'asUserId'), 
			'after'
		);

		return true;
	}

	/**
	 * Fetch all the streams which are related to, or from, a given stream.
	 * @method related
	 * @static
	 * @param {string} $asUserId
	 *  The user who is fetching
	 * @param {string} $publisherId
	 *  The publisher of the stream
	 * @param {string|array|Db_Range} $streamName
	 *  The name of the stream which is presumably related to/from other streams
	 * @param {mixed} $isCategory=true
	 *  If false, returns the categories that this stream is related to.
	 *  If true, returns all the streams this related to this category.
	 *  If a string, returns all the streams related to this category with names prefixed by this string.
	 * @param {array} $options=array()
	 *	'limit' =>  number of records to fetch
	 *	'offset' =>  offset to start from
	 *  'min' => the minimum weight (inclusive) to filter by, if any
	 *  'max' => the maximum weight (inclusive) to filter by, if any
	 *  'orderBy' => defaults to false, which means order by descending weight. True means by ascending weight.
	 *  'type' =>  if specified, this filters the type of the relation
	 *  'prefix' => if specified, this filters by the prefix of the related streams
	 *	'where' =>  you can also specify any extra conditions here
	 *  'extra' => An array of any extra info to pass to Streams::fetch when fetching streams
	 *	'relationsOnly' =>  If true, returns only the relations to/from stream, doesn't fetch the streams.
	 *		Useful if publisher id of relation objects is not the same as provided by publisherId.
	 *  'streamsOnly' => If true, returns only the streams related to/from stream, doesn't return the relations.
	 *	  Useful for shorthand in while( ) statements.
	 *  'streamFields' => If specified, fetches only the fields listed here for any streams
	 *  'skipFields' => Optional array of field names. If specified, skips these fields when fetching streams
	 *  'includeTemplates' => Defaults to false. Pass true here to include template streams (whose name ends in a slash) among the related streams.
	 * @return {array}
	 *  Returns array($relations, $relatedStreams, $stream).
	 *  However, if $streamName wasn't a string or ended in "/"
	 *  then these third parameter is an array of streams.
	 */
	static function related(
		$asUserId,
		$publisherId,
		$streamName,
		$isCategory = true,
		$options = array())
	{
		if (is_string($streamName) and substr($streamName, -1) === '/') {
			$streamName = new Db_Range($streamName, false, false, true);
		}
		$returnMultiple = !is_string($streamName);
		if (is_array($isCategory)) {
			$options = $isCategory;
			$isCategory = true;
		}

		// Check access to stream
		$rows = Streams::fetch($asUserId, $publisherId, $streamName);
		$streams = array();
		foreach($rows as $n => $row) {
			if (!$row) continue;
			if (!$row->testReadLevel('see')) {
				throw new Users_Exception_NotAuthorized();
			}
			$streams[$n] = $row;
		}
		if (!$streams) {
			if (!empty($options['relationsOnly'])
			|| !empty($options['streamsOnly'])) {
				return array();
			}
			return array(array(), array(), $returnMultiple ? array() : null);
		}
		$stream = reset($streams);

		if ($isCategory) {
			$query = Streams_RelatedTo::select('*')
			->where(array(
				'toPublisherId' => $publisherId,
				'toStreamName' => $streamName
			));
		} else {
			$query = Streams_RelatedFrom::select('*')
			->where(array(
				'fromPublisherId' => $publisherId,
				'fromStreamName' => $streamName
			));
		}
		if ($isCategory) {
			if (empty($options['orderBy'])) {
				$query = $query->orderBy('weight', false);
			} else if ($options['orderBy'] === true) {
				$query = $query->orderBy('weight', true);
			}
		}
		if (isset($options['prefix'])) {
			if (substr($options['prefix'], -1) !== '/') {
				throw new Q_Exception("prefix has to end in a slash", 'prefix');
			}
			$other_field = $isCategory ? 'fromStreamName' : 'toStreamName';
			$query = $query->where(array(
				$other_field => new Db_Range($options['prefix'], true, false, true)
			));
		}

		$offset = !empty($options['offset']) ? $options['offset'] : 0;
		$max_limit = Q_Config::expect('Streams', 'db', 'limits', 'stream');
		$limit = !empty($options['limit'])
			? $options['limit']
			: $max_limit;
		if ($limit > $max_limit) {
			throw new Q_Exception("Streams::related limit is too large, must be <= $max_limit");
		}

		$min = isset($options['min']) ? $options['min'] : null;
		$max = isset($options['max']) ? $options['max'] : null;
		if (isset($min) or isset($max)) {
			$range = new Db_Range($min, true, true, $max);
			$query = $query->where(array('weight' => $range));
		}
		if (isset($limit)) {
			$query = $query->limit($limit, $offset);
		}
		if (isset($options['type'])) {
			$query = $query->where(array('type' => $options['type']));
		}
		if (isset($options['where'])) {
			$query = $query->where($options['where']);
		}
		$FT = $isCategory ? 'from' : 'to';
		if (empty($options['includeTemplates'])) {
			$col = $FT.'StreamName';
			$query = $query->where(new Db_Expression(
				"SUBSTRING($col, -1, 1) != '/'"
			));
		}

		$relations = $query->fetchDbRows(null, '', $FT.'StreamName');
		if (empty($options['includeTemplates'])) {
			foreach ($relations as $k => $v) {
				if (substr($k, -1) === '/') {
					unset($relations[$k]);
				}
			}
		}

		if (!empty($options['relationsOnly'])) {
			return $relations;
		}
		if (empty($relations)) {
			return empty($options['streamsOnly'])
				? array($relations, array(), $returnMultiple ? $streams : $stream)
				: array();
		}
		$fields = '*';
		if (isset($options['skipFields'])) {
			$skip_fields = is_array($options['skipFields'])
				? $options['skipFields']
				: explode(',', $options['skipFields']);
			$fields = implode(',', array_diff(Streams_Stream::fieldNames(), $skip_fields));
		} else if (isset($options['streamFields'])) {
			$fields = is_string($options['streamFields'])
				? $options['streamFields']
				: implode(',', $options['streamFields']);
		}
		$extra = isset($options['extra']) ? $options['extra'] : null;
		$names = array();
		$FTP=$FT.'PublisherId';
		foreach ($relations as $name => $r) {
			if ($r->$FTP === $publisherId) {
				$names[] = $name;
			}
		}
		$relatedStreams = Streams::fetch($asUserId, $publisherId, $names, $fields, $extra);
		foreach ($relatedStreams as $name => $s) {
			if (!$s) continue;
			$s->weight = isset($relations[$name]->weight)
				? $relations[$name]->weight
				: null;
		}
		if (!empty($options['streamsOnly'])) {
			return $relatedStreams;
		}
		return array(
			$relations, 
			$relatedStreams,
			$returnMultiple ? $streams : $stream
		);
	}
	
	/**
	 * Updates the weight on a relation
	 * @param {string} $asUserId
	 *  The id of the user on whose behalf the app will be updating the relation
	 * @param {string} $toPublisherId
	 *  The publisher of the stream on the 'to' end of the reltion
	 * @param {string} $toStreamName
	 *  The name of the stream on the 'to' end of the relation
	 * @param {string} $type
	 *  The type of the relation
	 * @param {string} $fromPublisherId
	 *  The publisher of the stream on the 'from' end of the reltion
	 * @param {string} $fromStreamName
	 *  The name of the stream on the 'from' end of the reltion
	 * @param {double} $weight
	 *  The new weight
	 * @param {double} $adjustWeights=null
	 *  The amount to move the other weights by, to make room for this one
	 * @param {array} $options=array()
	 *  An array of options that can include:
	 *  "skipAccess" => Defaults to false. If true, skips the access checks and just updates the weight on the relation
	 * @return {array|boolean}
	 *  Returns false if the operation was canceled by a hook
	 *  Otherwise returns array with key "to" and value of type Streams_Message
	 */
	static function updateRelation(
		$asUserId,
		$toPublisherId,
		$toStreamName,
		$type,
		$fromPublisherId,
		$fromStreamName,
		$weight,
		$adjustWeights = null,
		$options = array())
	{
		self::getRelation(
			$asUserId,
			$toPublisherId,
			$toStreamName,
			$type,
			$fromPublisherId,
			$fromStreamName,
			$relatedTo,
			$relatedFrom,
			$category,
			$stream,
			$options);
			
		if (!$relatedTo->retrieve()) {
			throw new Q_Exception_MissingRow(
				array('table' => 'relatedTo', 'criteria' => 'with those fields'),
				array('publisherId', 'name', 'type', 'toPublisherId', 'to_name')
			);			
		}
//		if (!$relatedFrom->retrieve()) {
//			throw new Q_Exception_MissingRow(
//				array('table' => 'relatedFrom', 'criteria' => 'those fields'),
//				array('publisherId', 'name', 'type', 'fromPublisherId', 'from_name')
//			);
//		}
		
		if (empty($options['skipAccess'])) {
			if (!$category->testWriteLevel('relations')) {
				throw new Users_Exception_NotAuthorized();
			}
		}
		
		/**
		 * @event Streams/updateRelation/$streamType {before}
		 * @param {string} 'relatedTo'
		 * @param {string} 'relatedFrom'
		 * @param {string} 'asUserId'
		 * @param {double} 'weight'
		 * @param {double} 'previousWeight'
		 */
		$previousWeight = $relatedTo->weight;
		$adjustWeightsBy = $weight < $previousWeight ? $adjustWeights : -$adjustWeights;
		if (Q::event(
			"Streams/updateRelation/{$stream->type}",
			compact('relatedTo', 'relatedFrom', 'type', 'weight', 'previousWeight', 'adjustWeightsBy', 'asUserId'), 
			'before') === false
		) {
			return false;
		}
		
		if (!empty($adjustWeights)
		and is_numeric($adjustWeights)
		and $weight !== $previousWeight) {
			$criteria = array(
				'toPublisherId' => $toPublisherId,
				'toStreamName' => $toStreamName,
				'type' => $type,
				'weight' => $weight < $previousWeight
					? new Db_Range($weight, true, false, $previousWeight)
					: new Db_Range($previousWeight, false, true, $weight)
			);
			Streams_RelatedTo::update()->set(array(
				'weight' => new Db_Expression("weight + " . $adjustWeightsBy)
			))->where($criteria)->execute();
		}
		
		$relatedTo->weight = $weight;
		$relatedTo->save();
		
		// Send Streams/updatedRelateTo message to the category stream
		// node server will be notified by Streams_Message::post
		$message = Streams_Message::post($asUserId, $toPublisherId, $toStreamName, array(
			'type' => 'Streams/updatedRelateTo',
			'instructions' => Q::json_encode(compact(
				'fromPublisherId', 'fromStreamName', 'type', 'weight', 'previousWeight', 'adjustWeightsBy', 'asUserId'
			))
		), true);
		
		// TODO: We are not yet sending Streams/updatedRelateFrom message to the other stream
		// because we might be changing a lot of weights, and we'd have to message a lot of streams.
		// This is better done in the background using Node.js after selecting using $criteria
		// When we implement this, we can introduce weight again in the relatedFrom table.
		
		/**
		 * @event Streams/updateRelation/$streamType {after}
		 * @param {string} 'relatedTo'
		 * @param {string} 'relatedFrom'
		 * @param {string} 'asUserId'
		 * @param {double} 'weight'
		 * @param {double} 'previousWeight'
		 */
		Q::event(
			"Streams/updateRelation/{$stream->type}",
			compact('relatedTo', 'relatedFrom', 'type', 'weight', 'previousWeight', 'adjustWeightsBy', 'asUserId'),
			'after'
		);
		
		return $message;
	}
	
	/**
	 * Closes a stream, which prevents anyone from posting messages to it
	 * unless they have WRITE_LEVEL >= "close", as well as attempting to remove
	 * all relations to other streams. A "cron job" can later go and delete
	 * closed streams. The reason you should avoid deleting streams right away
	 * is that other subscribers may still want to receive the last messages
	 * posted to the stream.
	 * @method close
	 * @param {string} $asUserId The id of the user who would be closing the stream
	 * @param {string} $publisherId The id of the user publishing the stream
	 * @param {string} $streamName The name of the stream
	 * @param {array} [$options=array()] Can include "skipAccess"
	 * @static
	 */
	static function close($asUserId, $publisherId, $streamName, $options = array())
	{
		$stream = new Streams_Stream();
		$stream->publisherId = $publisherId;
		$stream->name = $streamName;
		if (!$stream->retrieve()) {
			throw new Q_Exception_MissingRow(array(
				'table' => 'stream', 
				'criteria' => "{publisherId: '$publisherId', name: '$streamName'}"
			));
		}
		
		// Authorization check
		if (empty($options['skipAccess'])) {
			if ($asUserId !== $publisherId) {
				$stream->calculateAccess($asUserId);
				if (!$stream->testWriteLevel('close')) {
					throw new Users_Exception_NotAuthorized();
				}
			}
		}

		// Clean up relations from other streams to this category
		list($relations, $related) = Streams::related($asUserId, $stream->publisherId, $stream->name, true);
		foreach ($relations as $r) {
			try {
				Streams::unrelate(
					$asUserId, 
					$r->fromPublisherId, 
					$r->fromStreamName, 
					$r->type, 
					$stream->publisherId, 
					$stream->name
				);
			} catch (Exception $e) {}
		}

		// Clean up relations from this stream to categories
		list($relations, $related) = Streams::related(
			$asUserId,
			$stream->publisherId,
			$stream->name,
			false
		);
		foreach ($relations as $r) {
			try {
				Streams::unrelate(
					$asUserId, 
					$r->toPublisherId,
					$r->toStreamName,
					$r->type,
					$stream->publisherId,
					$stream->name
				);
			} catch (Exception $e) {}
		}

		$result = false;
		try {
			$stream->closedTime = new Db_Expression("CURRENT_TIMESTAMP");
			if ($stream->save()) {
				$stream->post($asUserId, array(
					'type' => 'Streams/closed',
					'content' => ''
				), true);
				$result = true;
			}
		} catch (Exception$e) {
	
		}
		return $result;
	}

	/**
	 * Retrieve the user's stream needed to post invite messages
	 * If stream does not exists - create it. May return null if save failed.
	 * @method getInvitedStream
	 * @static
	 * @param $asUserId {string}
	 *	The user id of inviting user
	 * @param $forUserId {string}
	 *	User id for which stream is created
	 * @return {Streams_Stream|null}
	 */
	static function getInvitedStream ($asUserId, $forUserId) {
		$invited = Streams::fetch($asUserId, $forUserId, 'Streams/invited');
		if (!empty($invited)) return $invited['Streams/invited'];
		$invited = new Streams_Stream();
		$invited->publisherId = $forUserId;
		$invited->name = 'Streams/invited';
		$invited->type = 'Streams/invited';
		$invited->title = 'Streams/invited';
		$invited->content = 'Post message here when user is invited to some stream';
		$invited->readLevel = Streams::$READ_LEVEL['none'];
		$invited->writeLevel = Streams::$WRITE_LEVEL['post']; // anyone can post messages
		$invited->adminLevel = Streams::$ADMIN_LEVEL['none'];
		$result = $invited->save(true);
		//Streams::calculateAccess($asUserId, $forUserId, array('Streams/invited' => $invited), false);
		return $result ? $invited : null;
	}

	/**
	 * Method is used to verify access rights and fetch stream specific data
	 * @method get
	 * @static
	 *
	 * @param {string} $asUserId
	 *  The user who is attempting to fetch streams
	 * @param {string|array} $publisherId
	 *  Optional. The publisher of the stream to fetch
	 * @param {string|array} $streamName
	 *  Optional. The name of the stream to fetch. May be generic name if last char is '/'
	 *   if array is provided fetches streams for each array member
	 * @param {array} $options=array()
	 *   Array of parameters including:<br/>
	 *	"search" => Experimental, Optional. A search term to look in 'title' and 'content'.
	 *	  If provided, $streamName shall be not empty and contain generic name (type) of the
	 *	  streams to search. Streams/search/$type 'before' and 'after' hooks are called to
	 *	  adjust search result<br/>
	 *
	 *   Following options work only if $publisherId and $streamName are strings and 'Stream' table is not
	 *	 sharded:<br/>
	 *
	 *	"limit" => Optional. The number of streams to fetch<br/>
	 *	"offset" => Optional. The offset to start from<br/>
	 *	"orderBy" => Optional. The name(s) of the field(s) to order result<br/>
	 * @param {boolean} $single=false
	 * @return {array}
	 *  Array of resulting stream indexed by name
	 */

	static function get(
		$asUserId,
		$publisherId,
		$streamName,
		$options = array(),
		$single = false) // return array by default
	{
		$publishers = is_array($publisherId) ? $publisherId : array($publisherId);
		$names = is_array($streamName) ? $streamName : array($streamName);
		// set up extra query options
		$modifiers = array();
		// use of these options is useless if fetching in many tries
		if (is_string($publisherId) && is_string($streamName))
			foreach (array('limit', 'offset', 'orderBy') as $option)
				if (isset($options[$option])) $modifiers[$option] = $options[$option];

		$streams = array();
		if (!isset($options['search'])) {
			// simply fetch requested streams
			foreach ($publishers as $publisherId) {
				foreach($names as $name) {
					$bulk = Streams::fetch($asUserId, $publisherId, $name, '*', $modifiers);
					foreach ($bulk as $key => $s) {
						if (!$s->testReadLevel('see')) {
							unset($bulk[$key]);
						} else {
							if (!$s->testReadLevel('content')) {
							foreach(array_diff(array_keys($s->fields), // even if stream is extended with non-standard fields they'll be removed
									array(	// the array of fields allowed to see
										'publisherId',
										'insertedTime',
										'updatedTime',
										'name',
										'type',
										'title',
										'icon',
										'messageCount',
										'participantCount')) as $field)
								unset($s->$field);
							}
						}
					}
					$streams = array_merge($streams, $bulk);
				}
			}
		} else {
			// try to search according to search term
			$search = $options['search'];
			// WARNING: we should use a separate solution for searches!!
			$modifiers['orWhere'] = "title LIKE %$search% OR content LIKE %$search%";
			foreach ($publishers as $publisherId) {
				foreach ($names as $name) {
					// we skip silently before/after hooks if $name is not generic
					if (substr($name, -1) === '/') {
						$type = substr($name, 0, -1);
						/**
						 * @event Streams/search/$streamType {before}
						 * @param {string} 'publisherId'
						 * @param {string} 'name'
						 * @return {false} To cancel further processing
						 */
						if (Q::event(
								"Streams/search/$type",
								compact('publisherId', 'name'),
								'before',
								false,
								$modifiers
							) === false) continue;

						$result = Streams::fetch($asUserId, $publisherId, $name, '*', $modifiers);

						/**
						 * @event Streams/search/$streamType {after}
						 * @param {string} 'publisherId'
						 * @param {string} 'name'
						 */
						Q::event(
								"Streams/search/$type",
								compact('publisherId', 'name', 'modifiers'),
								'after',
								false,
								$result
							);

						array_merge($streams, $result);
					}
				}
			}
		}

		return $single ? reset($streams) : $streams;
	}

	/**
	 * Get first and last name out of full name
	 * @method splitFullName
	 * @static
	 * @param {string} $fullName The string representing full name
	 * @return {array} array containing 'first' and 'last' properties
	 */
	static function splitFullName ($fullName) {
		$capitalize = Q_Config::get('Streams', 'inputs', 'fullName', 'capitalize', true);
		$last = null;
		if (strpos($fullName, ',') !== false) {
			list($last, $first) = explode(',', $fullName);
		} else if (strpos($fullName, ' ') !== false) {
			$parts = explode(' ', $fullName);
			if ($capitalize) {
				foreach ($parts as $k => $v) {
					$parts[$k] = ucfirst($v);
				}
			}
			$last = join(' ', array_slice($parts, 1));
			$first = $parts[0];
		} else {
			$first = $fullName;
		}
		$first = trim($first);
		$last = trim($last);

		return compact('first', 'last');
	}

	/**
	 * Registers a user. Can be hooked to 'Users/register' before event
	 * so it can override standard functionality.
	 * Method ensures user registration based on full name and also handles registration of
	 * invited user
	 * @method register
	 * @static
	 * @param {string} $fullName The full name of the user in the format 'First Last' or 'Last, First'
	 * @param {string} $identifier User identifier
	 * @param {array} $icon=array() User icon
	 * @param {string} $provider=null Provider
	 * @param {array} $options=array() An array of options that could include:
	 *  "activation": The key under "Users"/"transactional" config to use for sending an activation message.
	 * @return {Users_User}
	 * @throws {Q_Exception_WrongType} If identifier is not e-mail or modile
	 * @throws {Q_Exception} If user was already verified for someone else
	 * @throws {Users_Exception_AlreadyVerified} If user was already verified
	 * @throws {Users_Exception_UsernameExists} If username exists
	 */
	static function register($fullName, $identifier, $icon = array(), $provider = null, $options = array())
	{
		if (is_array($provider)) {
			$options = $provider;
			$provider = null;
		}
		
		/**
		 * @event Users/register {before}
		 * @param {string} 'username'
		 * @param {string} 'identifier'
		 * @param {string} 'icon'
		 * @return {Users_User}
		 */
		$return = Q::event('Streams/register', compact('name', 'fullName', 'identifier', 'icon', 'provider', 'options'), 'before');
		if (isset($return)) {
			return $return;
		}

		// calculate first and last name out of name
		if (empty($fullName)) {
			throw new Q_Exception("Please enter your name", 'name');
		}

		$name = self::splitFullName($fullName);
		if (empty($name['first']) && empty($name['last'])) {
			// this is unlikely to happen
			throw new Q_Exception("Please enter your name properly", 'name');
		}

		self::$cache['register'] = $name;

		if ($provider !== 'invite') {
			$user = Users::register("", $identifier, $icon, $provider, $options);
		} else {
			if (!empty($identifier)) {
				$rid = Users::requestedIdentifier($type);
				$user = Users::userFromContactInfo($type, $rid);
				if (!$user) throw new Users_Exception_NoSuchUser();
			} else {
				$user = Users::loggedInUser();
			}
		}

		/**
		 * @event Users/register {after}
		 * @param {string} 'username'
		 * @param {string} 'identifier'
		 * @param {string} 'icon'
		 * @param {Users_User} 'user'
		 * @return {Users_User}
		 */
		Q::event('Streams/register', compact(
			'name', 'identifier', 'icon', 'user', 'provider', 'options'
		), 'after');

		return $user;
	}
	
	/**
	 * A convenience method to get the URL of the streams-related action
	 * @method register
	 * @static
	 * @param {string} $publisherId
	 *	The name of the publisher
	 * @param {string} $streamName
	 *	The name of the stream
	 * @param {string} $what
	 *	Defaults to 'stream'. Can also be 'message', 'relation', etc.
	 * @return {string} 
	 *	The corresponding URL
	 */
	static function actionUrl($publisherId, $streamName, $what = 'stream')
	{
		switch ($what) {
			case 'stream':
			case 'message':
			case 'relation':
				return Q_Uri::url("Streams/$what?publisherId=".urlencode($publisherId)."&name=".urlencode($streamName));
		}
		return null;
	}
	
	static function getExtendClasses($type)
	{
		static $result = array();
		if (isset($result[$type])) {
			return $result[$type];
		}
		$extend = Q_Config::get('Streams', 'types', $type, 'extend', null);
		if (is_string($extend)) {
			$extend = array($extend);
		}
		$classes = array();
		if ($extend) {
			if (!Q::isAssociative($extend)) {
				$temp = array();
				foreach ($extend as $k) {
					$temp[$k] = true;
				}
				$extend = $temp;
			}
			foreach ($extend as $k => $v) {
				if (!class_exists($k, true)) {
					throw new Q_Exception_MissingClass(array(
						'className' => $k
					));
				}
				if (!is_subclass_of($k, 'Db_Row')) {
					throw new Q_Exception_BadValue(array(
						'internal' => "Streams/types/$type/extend",
						'problem' => "$k must extend Db_Row"
					));
				}
				if ($v === true) {
					$v = call_user_func(array('Base_'.$k, 'fieldNames'));
					$v = array_diff($v, array('publisherId', 'streamName', 'name'));
				} else if (Q::isAssociative($v)) {
					$v = array_keys($v);
				}
				$classes[$k] = $v;
			}
		}
		return $result[$type] = $classes;
	}
	
	static function getExtendFieldNames($type)
	{
		$classes = Streams::getExtendClasses($type);
		$fieldNames = array(
			'title', 'icon', 'content', 'attributes', 
			'readLevel', 'writeLevel', 'adminLevel'
		);
		foreach ($classes as $k => $v) {
			foreach ($v as $f) {
				$fieldNames[] = $f;
			}
		}
		return $fieldNames;
	}
	
	protected static function afterFetchExtended($publisherId, $type, $retrieved)
	{
		// all streams are the same type
		if (!$retrieved) return;
		$classes = array();
		$rows = array();
		foreach ($retrieved as $name => $stream) {
			$classes = Streams::getExtendClasses($type);
			foreach ($classes as $k => $v) {
				$r = call_user_func(array($k, 'select'), '*')
					->where(array(
						'publisherId' => $publisherId,
						'streamName' => array_keys($retrieved)
					))->fetchDbRows(null, '', 'streamName');
				$rows = array_merge($rows, $r);
			}
		}
		foreach ($retrieved as $name => $stream) {
			if (empty($rows[$name])) continue;
			foreach ($classes as $k => $v) {
				foreach ($v as $f) {
					if (!isset($rows[$name])) continue;
					$stream->$f = $rows[$name]->$f;
				}
			}
		}
	}

	/**
	 * @property $fetch
	 * @static
	 * @type array
	 * @protected
	 */
	protected static $fetch = array();
	/**
	 * @property $cache
	 * @static
	 * @type array
	 */
	static $cache = array();
	/**
	 * @property $followedInvite
	 * @type Streams_Invite
	 */
	static $followedInvite = null;
	/**
	 * @property $requestedPublisherId_override
	 * @static
	 * @type string
	 */
	static $requestedPublisherId_override = null;
	/**
	 * @property $requestedName_override
	 * @static
	 * @type string
	 */
	static $requestedName_override = null;
	static $beingSaved = null;
	static $beingSavedQuery = null;
};
