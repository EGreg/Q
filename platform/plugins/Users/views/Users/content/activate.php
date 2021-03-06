<div id="content" class="Q_clearfix">
<?php if ($user) : ?>
	<?php if (empty($_REQUEST['p']) and !empty($user->passphraseHash)): ?>
		<div class="Q_admin_pane">
			<?php echo Q::tool('Users/avatar', array(
				'userId' => $user->id,
				'icon' => true
			), 'admin') ?>
			<?php echo Q_Html::form(Q_Dispatcher::uri(), 'post', array('id' => 'Q_activation_form')) ?>
				<?php echo Q_Html::formInfo(null) ?>
				<div class='Q_big_prompt'>
					<input type="hidden" name="code" value="<?php echo Q_Html::text($code) ?>">
					<input type="hidden" id="activate_identifier" name="<?php echo $t ?>"
						value="<?php echo Q_Html::text($identifier) ?>">
					<div class='Q_buttons'>
						<button class="Q_button" id="Users_activate_set_emailAddress" type="submit">
							Set
							<?php echo Q_Html::text($identifier) ?>
							as my primary <?php echo $type ?>
						</button>
					</div>
				</div>
			</form>
		</div>
		<div class="Q_extra_pane">

		</div>
	<?php else: ?>
		<div class="Q_admin_pane">
				<?php echo Q::tool('Users/avatar', array(
					'icon' => true,
					'userId' => $user->id
				), 'admin') ?>
				<div class='Q_big_prompt'>
					<p style="max-width: 350px;">
					<?php if (empty($_REQUEST['p'])): ?>
						Choose a <strong>pass phrase</strong> to log in with.<br>
						A simple phrase consisting of a few words that
						you will easily remember.
					<?php else: ?>
						Choose a good <strong>pass phrase</strong> to protect your account.
						See the suggestions for some ideas.
					<?php endif; ?>
					</p>
					<?php echo Q_Html::form(Q_Dispatcher::uri(), 'post', array('id' => 'Q_activation_form')) ?>
						<?php echo Q_Html::formInfo(null) ?>
						<input type="password" id='activate_passphrase' name="passphrase" class='password' autofocus placeholder="Enter a passphrase" autocomplete="new-password" /><br>
						<button type="submit" class="Q_button" style="width: 250px;">Activate My Account</button>
						<input type="hidden" id="activate_identifier" name="<?php echo $t ?>"
							value="<?php echo Q_Html::text($identifier) ?>">
						<input type="hidden" name="code" value="<?php echo Q_Html::text($code) ?>">
						<?php if (!empty($_REQUEST['p'])): ?>
							<input type="hidden" name="p" value="1">
						<?php endif; ?>
					</form>
				</div>
		</div>
		<div class="Q_extra_pane">
			<h2>Suggestions:</h2>
			<ul id='suggestions'>
				<?php foreach ($suggestions as $s): ?>
					<li class="Users_fromServer"><?php echo Q_Html::text($s) ?></li>
				<?php endforeach ?>
			</ul>
		</div>
	<?php endif; ?>
<?php elseif (Users::loggedInUser()): ?>
	<h1 class='Q_big_message'>If you feel something went wrong, <button id='activate_setIdentifier'>try again</button></h1>
<?php else: ?>
	<h1 class='Q_big_message'>Please try <a href='#' id='activate_login'>logging in</a> to activate your account.</h1>
<?php endif; ?>

<?php Q_Response::addScript('plugins/Q/js/Q.js'); ?>

<?php Q_Response::addScriptLine("jQuery(function() {
	$('#activate_setIdentifier').click(function() { Q.plugins.Users.setIdentifier(); });
	$('#activate_login').click(function() { Q.plugins.Users.login(); });
	$('#activate_passphrase').val('').focus();
	
	// Get the suggestions from YAHOO, if possible
	
	$('#activate_passphrase').plugin('Q/placeholders').plugin('Q/clickfocus');
	
	// this used to work:
	var url = 'http://query.yahooapis.com/v1/public/yql?format=json&diagnostics=false&q=select%20abstract%20from%20search.news%20where%20query%3D%22$noun_ue%22';
	// but YAHOO now deprecated the search.news table.
	// later we can pay for BOSS to do this. But for now, here is what we do:
	var url = 'http://query.yahooapis.com/v1/public/yql?format=json&diagnostics=false&q=select%20Rating.LastReviewIntro%20from%20local.search%20where%20zip%3D%2294085%22%20and%20query%3D%22$noun_ue%22';
	
	Q.request(url, null, function(err, data) {
		if (data.query && data.query.results && data.query.results.Result) {
			// var r = data.query.results.result;
			var r = data.query.results.Result;
			var ul = $('#suggestions');
			var rand, text;
			var source = '';
			for (var i=0; i<r.length; ++i) {
				text = r[i].Rating.LastReviewIntro;
				if (text) {
					source += ' ' + text;
				}
			}
			var source_words = source.toLowerCase().replace(/[^A-Za-z0-9-_\' ]/g, '').split(' ');
			for (var i=0; i<7; ++i) { // add seven quotes from here
				rand = Math.floor(Math.random() * source_words.length);
				var text = source_words.slice(rand, rand+3).join(' ');
				if (text) {
					ul.prepend($('<li />').addClass('Users_fromYahoo').html(text));
					$('li:last', ul).eq(0).remove();
				}
			}
		}

	}, {'callbackName': 'callback'});
}); "); ?>
</div>