<?php
/**
 * Phloor News Language File
 * German
 */

$german = array(
	"phloor_news:settings:layout:title" => "Layout",

	"phloor_news:settings:layout:enable_list_layout:label" => "Listen Layout aktivieren",
	"phloor_news:settings:layout:enable_list_layout:description" => "Aktiviert das Standard Listen Layout von Elgg",

	"phloor_news:settings:layout:element_limit:label" => "Maximale Anzahl an News-Einträgen pro Seite",
	"phloor_news:settings:layout:element_limit:description" => "",

	'phloor_news' => 'News',
	'phloor_news:phloor_newss' => 'News',
	'phloor_news:revisions' => 'Überarbeitungen',
	'phloor_news:archives' => 'Archiv',
	'phloor_news:phloor_news' => 'News',
	'item:object:phloor_news' => 'News',

	'phloor_news:title:user_phloor_newss' => '%s\'s News',
	'phloor_news:title:all_phloor_newss' => 'Seitenweite News',
	'phloor_news:title:friends' => 'News von Freunden',

	'phloor_news:group' => 'News',
	'phloor_news:enablephloor_news' => 'News aktivieren',
	'phloor_news:write' => 'Neuen News-Beitrag schreiben',

	// Editing
	'news:add' => 'News hinzufügen',
	'phloor_news:add' => 'News hinzufügen',
	'phloor_news:edit' => 'News editieren',
	'phloor_news:excerpt' => 'Auszug',
	'phloor_news:body' => 'Text',
	'phloor_news:save_status' => 'Letztes mal gespeichert: ',
	'phloor_news:never' => 'Noch nie',

	'phloor_news:form:title' => 'Titel',
	'phloor_news:title:description' => '',

	'phloor_news:form:excerpt' => 'Auszug',
	'phloor_news:excerpt:description' => '',

	'phloor_news:form:description' => 'Inhalt',
	'phloor_news:description:description' => '',

	'phloor_news:form:image' => 'Photo',
	'phloor_news:image:description' => '',

	'phloor_news:form:delete_image' => 'Photo löschen? ',
	'phloor_news:delete_image:description' => '',

	'phloor_news:form:tags' => 'Tags',
	'phloor_news:tags:description' => '',

	'phloor_news:form:comments_on' => 'Kommentare erlauben? ',
	'phloor_news:comments_on:description' => '',

	'phloor_news:form:access_id' => 'Lesezugriff',
	'phloor_news:access_id:description' => '',

	'phloor_news:form:status' => 'Status',
	'phloor_news:status:description' => '',

	// Statuses
	'phloor_news:status' => 'Status',
	'phloor_news:status:draft' => 'Entwurf',
	'phloor_news:status:published' => 'Veröffentlicht',
	'phloor_news:status:unsaved_draft' => 'Nichtgepspeicherter Entwurf',

	'phloor_news:revision' => 'Überarbeitung',
	'phloor_news:auto_saved_revision' => 'Automatisches Speichern der Überarbeitung',

	// messages
	'phloor_news:message:saved' => 'News-Eintrag gespeichert.',
	'phloor_news:error:cannot_save' => 'News-Eintrag konnte nicht gespeichert werden',
	'phloor_news:error:cannot_write_to_container' => 'Sie haben nicht die nötigen Zugriffsrechte.',
	'phloor_news:error:post_not_found' => 'Dieser Eintrag wude gelöscht, ist invalid, oder Sie haben nicht die nötigen Zugriffsrechte.',
	'phloor_news:messages:warning:draft' => 'Es exisitert eine ungespeicherte Überarbeitung des Eintrags.',
	'phloor_news:edit_revision_notice' => '(Alte Version)',
	'phloor_news:message:deleted_post' => 'News-Eintrag wurde gelöscht',
	'phloor_news:error:cannot_delete_post' => 'News-Eintrag konnte nicht gelöscht werden.',
	'phloor_news:none' => 'Keine neuen News',
	'phloor_news:error:missing:title' => 'Bitte geben Sie einen Titel ein!',
	'phloor_news:error:missing:description' => 'Bitte geben Sie einen Text ein!',
	'phloor_news:error:cannot_edit_post' => 'Dieser Eintrage existiert nicht oder Sie haben nicht die nötigen Zugriffsrechte.',
	'phloor_news:error:revision_not_found' => 'Konnte die Überabeitung nicht finden.',

	// river
	'river:create:object:phloor_news' => '%s veröffentlichte den News-Eintrag %s',
	'river:comment:object:phloor_news' => '%s kommentierte den News-Eintrag %s',

	// notifications
	'phloor_news:newpost' => 'Ein neuer News-Eintrag',

	// widget
	'phloor_news:widget:description' => 'Zeigt die letzten News-Einträge an',
	'phloor_news:morephloor_newss' => 'Mehr News-Einträge',
	'phloor_news:numbertodisplay' => 'Anzahl der anzuzeigenden News-Einträge',
	'phloor_news:nophloor_newss' => 'Keine News-Einträge vorhanden.',
	
	'phloor_news:image' => 'Bild',
	'phloor_news:delete_image' => 'Bild löschen?',
);

add_translation('de', $german);
