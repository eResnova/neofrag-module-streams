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

class m_streams_c_admin_checker extends Controller_Module
{
	public function add()
	{
		if (!$this->is_authorized('add_streams'))
		{
			throw new Exception(NeoFrag::UNAUTHORIZED);
		}

		return [];
	}

	public function _edit($stream_id, $title)
	{
		if (!$this->is_authorized('modify_streams'))
		{
			throw new Exception(NeoFrag::UNAUTHORIZED);
		}

		if ($stream = $this->model()->check_stream($stream_id, $title))
		{
			return $stream;
		}
	}

	public function delete($stream_id, $title)
	{
		if (!$this->is_authorized('delete_streams'))
		{
			throw new Exception(NeoFrag::UNAUTHORIZED);
		}

		$this->ajax();

		if ($stream = $this->model()->check_stream($stream_id, $title))
		{
			return [$stream['stream_id'], $stream['title']];
		}
	}
}

/*
NeoFrag Alpha 0.1.6.1
./modules/streams/controllers/admin_checker.php
*/