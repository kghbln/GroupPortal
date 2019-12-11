<?php
// Ensure that the script cannot be executed outside of MediaWiki.
if ( !defined( 'MEDIAWIKI' ) ) {
    die( 'This is an extension to the MediaWiki package and cannot be run standalone.' );
}

// Display extension properties on MediaWiki.
$wgExtensionCredits['other'][] = array(
	'path' => __FILE__,
	'name' => 'GroupPortal',
	'author' => array(
		'Tim Laqua',
		'...'
		),
	'url' => 'https://www.mediawiki.org/wiki/Extension:GroupPortal',
	'description' => 'Allows for group-based main page redirection',
	'version' => '1.2.0'
	);

// Register extension class.
$wgHooks['MediaWikiPerformAction'][] = 'efGroupPortal_MediaWikiPerformAction';

// Doing all the action.
function efGroupPortal_MediaWikiPerformAction( $output, $article, $title, $user, $request ) {
        $action    = $request->getVal( 'action', 'view' );
        $redirect  = $request->getVal( 'redirect' );

        if ( $action === 'view' && $redirect === null ) {
                if ( $title->equals( Title::newMainPage() ) ) {
                        
			$groupPortals = explode( "\n", wfMessage( 'Groupportal' )->inContentLanguage()->plain());

                        $groups = $user->getGroups();

                        $targetPortal = '';
                        foreach ( $groupPortals as $groupPortal ) {
                                $mcount = preg_match( '/^(.+)\|(.+)$/', $groupPortal, $matches );

                                if ( $mcount > 0 ) {
                                        if ( in_array( $matches[1], $groups ) ||
                                                ( $matches[1] == '*' && empty( $targetPortal ) ) ) {
                                                	$targetPortal = $matches[2];
                                        }
                                }
                        }

                        if ( !empty( $targetPortal ) ) {
                                $target = Title::newFromText( $targetPortal );

                                if( is_object( $target ) ) {
                                        $output->redirect( $target->getLocalURL() );
                                        return false;
                                }
                        }
                }
        }
        return true;
}
