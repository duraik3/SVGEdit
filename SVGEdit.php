<?php

/**
 * Wrapper to integrate SVG-edit in-browser vector graphics editor in MediaWiki.
 * http://www.mediawiki.org/wiki/Extension:SVGEdit
 *
 * @copyright 2010 Brion Vibber <brion@pobox.com>
 *
 * MediaWiki-side code is GPL
 *
 * SVG-edit is under Apache license: http://code.google.com/p/svg-edit/
 */

$wgExtensionCredits['other'][] = array(
	'path'           => __FILE__,
	'name'           => 'SVGEdit',
	'author'         => array( 'Brion Vibber' ),
	'url'            => 'https://www.mediawiki.org/wiki/Extension:SVGEdit',
	'descriptionmsg' => 'svgedit-desc',
);
$wgExtensionMessagesFiles['SVGEdit'] =  dirname(__FILE__) . '/SVGEdit.i18n.php';

$wgHooks['BeforePageDisplay'][] = 'SVGEditHooks::beforePageDisplay';
$wgHooks['MakeGlobalVariablesScript'][] = 'SVGEditHooks::makeGlobalVariablesScript';
$wgHooks['UploadForm:initial'][] = 'SVGEditHooks::uploadFormInitial';
$wgHooks['WikiEditorAddModules'][] = 'SVGEditHooks::addButtonModule';

$wgAutoloadClasses['SVGEditHooks'] = dirname( __FILE__ ) . '/SVGEdit.hooks.php';

$myResourceTemplate = array(
	'localBasePath' => dirname( __FILE__ ) . '/modules',
	'remoteExtPath' => 'SVGEdit/modules',
	'group' => 'ext.svgedit',
);
$wgResourceModules += array(
	'ext.svgedit.editor' => $myResourceTemplate + array(
		'scripts' => array(
			'ext.svgedit.embedapi.js',
			'ext.svgedit.formmultipart.js',
			'ext.svgedit.io.js',
			'ext.svgedit.editor.js',
		),
		'styles' => array(
			'ext.svgedit.editButton.css',
		),
		'messages' => array(
			'svgedit-summary-label',
			'svgedit-summary-default',
			'svgedit-editor-save-close',
			'svgedit-editor-close',
			'svgedit-editor-new-filename',
		),
		'dependencies' => array(
			'jquery.ui.resizable'
		)
	),
);
$wgResourceModules += array(
	'ext.svgedit.editButton' => $myResourceTemplate + array(
		'scripts' => array(
			'ext.svgedit.editButton.js',
		),
		'messages' => array(
			'svgedit-editbutton-edit',
			'svgedit-editbutton-create',
			'svgedit-edit-tab',
			'svgedit-edit-tab-tooltip'
		),
		'dependencies' => array(
			'ext.svgedit.editor'
		)
	),
);
$wgResourceModules += array(
	'ext.svgedit.inline' => $myResourceTemplate + array(
		'scripts' => array(
			'ext.svgedit.inline.js',
		),
		'messages' => array(
			'svgedit-editbutton-edit',
		),
		'dependencies' => array(
			'ext.svgedit.editor'
		)
	),
);
$wgResourceModules += array(
	'ext.svgedit.toolbar' => $myResourceTemplate + array(
		'scripts' => array(
			'ext.svgedit.toolbar.js',
		),
		'messages' => array(
			'svgedit-toolbar-insert',
		),
		'dependencies' => array(
			'ext.wikiEditor.toolbar',
			'ext.svgedit.editor'
		)
	),
);

// Can set to alternate SVGEdit URL to pull the editor's HTML/CSS/JS/SVG
// resources from another domain.
//
// By default, a master copy from Google Code is used. This may or may not be stable.
//
$wgSVGEditEditor = '';

// Set to enable experimental triggers for SVG editing within article views.
// Not yet recommended.
$wgSVGEditInline = false;
