<?php if (!defined('NEOFRAG_CMS')) exit;
/**************************************************************************
Copyright © 2015 Michaël BILCOT & Jérémy VALENTIN

This file is part of NeoFrag.

NeoFrag is free software: you can redistribute it and/or modify
it under the terms of the GNU Lesser General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

NeoFrag is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU Lesser General Public License for more details.

You should have received a copy of the GNU Lesser General Public License
along with NeoFrag. If not, see <http://www.gnu.org/licenses/>.
**************************************************************************/

$rules = [
	'title' => [
		'label'         => 'Titre',
		'value'         => $this->form->value('title'),
		'type'          => 'text',
		'rules'			=> 'required'
	],
	'url' => [
		'label'         => 'Url du stream',
		'value'         => $this->form->value('url'),
		'type'          => 'url',
		'rules'			=> 'required'
	],
	'id' => [
		'label'         => 'ID',
		'value'         => $this->form->value('id'),
		'type'          => 'text',
		'size'          => 'col-md-3',
		'rules'			=> 'required'
	],
	'provider' => [
		'label'         => 'Plateforme',
		'value'         => $this->form->value('provider'),
		'values'        => [
			'twitch' => 'Twitch'
		],
		'type'          => 'select',
		'rules'			=> 'required',
		'size'          => 'col-md-4'
	]
];

/*
NeoFrag Alpha 0.1.6.1
./modules/streams/forms/streams.php
*/