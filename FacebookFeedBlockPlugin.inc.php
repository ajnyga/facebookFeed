<?php

/**
 * @file plugins/generic/facebookFeed/FacebookFeedBlockPlugin.inc.php
 *
 * Copyright (c) 2014-2018 Simon Fraser University
 * Copyright (c) 2003-2018 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class FacebookFeedBlockPlugin
 * @ingroup plugins_generic_facebookFeed
 *
 * @brief Class for block component of Facebook Feed plugin
 */

import('lib.pkp.classes.plugins.BlockPlugin');

class FacebookFeedBlockPlugin extends BlockPlugin {
	/** @var FacebookFeedPlugin Parent plugin */
	protected $_parentPlugin;

	/**
	 * @param $parentPlugin FacebookFeedPlugin
	 */
	public function __construct($parentPlugin) {
		parent::__construct();
		$this->_parentPlugin = $parentPlugin;
	}

	/**
	 * Get the name of this plugin. The name must be unique within
	 * its category.
	 * @return String name of plugin
	 */
	public function getName() {
		return 'FacebookFeedBlockPlugin';
	}

	/**
	 * Hide this plugin from the management interface (it's subsidiary)
	 */
	public function getHideManagement() {
		return true;
	}

	/**
	 * Get the display name of this plugin.
	 * @return String
	 */
	public function getDisplayName() {
		return __('plugins.generic.facebookFeed.displayName');
	}

	/**
	 * Get a description of the plugin.
	 */
	public function getDescription() {
		return __('plugins.generic.facebookFeed.description');
	}

	/**
	 * Get the supported contexts (e.g. BLOCK_CONTEXT_...) for this block.
	 * @return array
	 */
	public function getSupportedContexts() {
		return array(BLOCK_CONTEXT_SIDEBAR);
	}

	/**
	 * Override the builtin to get the correct plugin path.
	 * @return string
	 */
	public function getPluginPath() {
		return $this->_parentPlugin->getPluginPath();
	}

	/**
	 * Get the HTML contents for this block.
	 * @param $templateMgr object
	 * @param $request PKPRequest
	 * @return $string
	 */
	public function getContents($templateMgr, $request = null) {
		$context = $request->getContext();

		if ($facebookFeedUrl = $this->_parentPlugin->getSetting($context->getId(), 'facebookFeedUrl')){
			$templateMgr->assign('facebookFeedUrl', $facebookFeedUrl);
		} else {
			return '';
		}
		return parent::getContents($templateMgr, $request);
	}
}
