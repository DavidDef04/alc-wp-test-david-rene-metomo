<?php
// This file is generated. Do not modify it manually.
return array(
	'alc-cta-banner' => array(
		'apiVersion' => 2,
		'name' => 'alc/cta-banner',
		'title' => 'CTA Banner',
		'category' => 'widgets',
		'icon' => 'megaphone',
		'description' => 'Bannière d’appel à l’action ALC.',
		'attributes' => array(
			'title' => array(
				'type' => 'string',
				'default' => 'Titre ALC'
			),
			'content' => array(
				'type' => 'string',
				'default' => 'Texte de contenu ALC'
			),
			'buttonUrl' => array(
				'type' => 'string',
				'default' => '#'
			),
			'backgroundColor' => array(
				'type' => 'string',
				'default' => '#1e40af'
			)
		),
		'editorScript' => 'file:./build/index.js',
		'style' => 'file:./build/style-index.css'
	)
);
