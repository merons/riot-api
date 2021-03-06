<?php

/**
 * Copyright (C) 2016-2018  Daniel Dolejška
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

declare(strict_types=1);

use RiotAPI\RiotAPI;
use RiotAPI\Objects;
use RiotAPI\Definitions\Region;


class LeagueEndpointObjectIntegrityTest extends RiotAPITestCase
{
	public function testInit()
	{
		$api = new RiotAPI([
			RiotAPI::SET_KEY            => getenv('API_KEY'),
			RiotAPI::SET_REGION         => Region::EUROPE_EAST,
			RiotAPI::SET_USE_DUMMY_DATA => true,
		]);

		$this->assertInstanceOf(RiotAPI::class, $api);

		return $api;
	}

	/**
	 * @depends testInit
	 *
	 * @param RiotAPI $api
	 */
	public function testGetLeaguePositionsForSummoner( RiotAPI $api )
	{
		$summonerId = "KnNZNuEVZ5rZry3IyWwYSVuikRe0y3qTWSkr1wxcmV5CLJ8";
		//  Get library processed results
		/** @var Objects\LeaguePositionDto[] $result */
		$result = $api->getLeaguePositionsForSummoner($summonerId);
		//  Get raw result
		$rawResult = $api->getResult();

		$this->checkObjectPropertiesAndDataValidityOfObjectList($result, $rawResult, Objects\LeaguePositionDto::class);
	}

	/**
	 * @depends testInit
	 *
	 * @param RiotAPI $api
	 */
	public function testGetLeagueChallenger( RiotAPI $api )
	{
		//  Get library processed results
		/** @var Objects\LeagueListDto $result */
		$result = $api->getLeagueChallenger('RANKED_SOLO_5x5');
		//  Get raw result
		$rawResult = $api->getResult();

		$this->checkObjectPropertiesAndDataValidity($result, $rawResult, Objects\LeagueListDto::class);

		return $result;
	}

	/**
	 * @depends testInit
	 *
	 * @param RiotAPI $api
	 */
	public function testGetLeagueMaster( RiotAPI $api )
	{
		//  Get library processed results
		/** @var Objects\LeagueListDto $result */
		$result = $api->getLeagueChallenger('RANKED_SOLO_5x5');
		//  Get raw result
		$rawResult = $api->getResult();

		$this->checkObjectPropertiesAndDataValidity($result, $rawResult, Objects\LeagueListDto::class);

		return $result;
	}

	/**
	 * @depends testInit
	 * @depends testGetLeagueChallenger
	 *
	 * @param RiotAPI $api
	 * @param string  $league_id
	 */
	public function testGetLeagueById( RiotAPI $api, Objects\LeagueListDto $leagueListDto )
	{
		//  Get library processed results
		/** @var Objects\LeagueListDto $result */
		$result = $api->getLeagueById($leagueListDto->leagueId);
		//  Get raw result
		$rawResult = $api->getResult();

		$this->checkObjectPropertiesAndDataValidity($result, $rawResult, Objects\LeagueListDto::class);
	}
}
