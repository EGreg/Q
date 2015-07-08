<?php

/**
 * @module Streams-tools
 */

/**
 * Renders a bunch of Stream/preview tools for streams related to the given stream.
 * Has options for adding new related streams, as well as sorting the relations, etc.
 * Also can integrate with Q/tabs tool to render tabs "related" to some category.
 * @class Streams related
 * @constructor
 * @param {array} $options options for the tool
 *   @param {string} [$options.publisherId] Either this or "stream" is required. Publisher id of the stream to which the others are related
 *   @param {string} [$options.streamName] Either this or "stream" is required. Name of the stream to which the others are related
 *   @param {string} [$options.tag="div"] The type of element to contain the preview tool for each related stream.
 *   @param {string} [$options.stream] You can pass a Streams_Stream object here instead of "publisherId" and "streamName"
 *   @param {string} [$options.relationType=""] The type of the relation.
 *   @param {boolean} [$options.isCategory=true] Whether to show the streams related TO this stream, or the ones it is related to.
 *   @param {array} [$options.relationOptions] Can include options like 'limit', 'offset', 'ascending', 'min', 'max' and 'prefix'
 *   @param {boolean} [$options.editable] Set to false to avoid showing even authorized users an interface to replace the image or text
 *   @param {boolean} [$options.creatable]  Optional pairs of {streamType: toolOptions}  to render Streams/preview tools create new related streams.
 *   The params typically include at least a "title" field which you can fill with values such as "New" or "New ..."
 *   @param {string} [$options.toolType] Name of a function that takes streamType and returns the tag to render (and then activate) for that stream
 *   @param {boolean} [$options.realtime=false] Whether to refresh every time a relation is added, removed or updated by anyone
 *   @param {array} [$options.sortable] Options for "Q/sortable" jQuery plugin. Pass false here to disable sorting interface. If streamName is not a String, this interface is not shown.
 *   @param {string} [$options.tabs] Name of a cuntion for interacting with any parent "Q/tabs" tool. Format is function (previewTool, tabsTool) { return urlOrTabKey; }
 *   @param {array} [$options.updateOptions] Options for onUpdate such as duration of the animation, etc.
 *   @param {string} [$options.onUpdate] Name of a handler for event that receives parameters "data", "entering", "exiting", "updating"
 *   @param {string} [$options.onRefresh] Name of a handler for event that occurs when the tool is completely refreshed, the "this" is the tool
 */
function Streams_related_tool($options)
{
	Q_Response::setToolOptions($options);
}