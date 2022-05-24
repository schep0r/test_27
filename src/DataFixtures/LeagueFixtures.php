<?php

namespace App\DataFixtures;

use App\Entity\League;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Exception\JsonException;

class LeagueFixtures extends Fixture
{
    private const SOURCE_URL = "https://www.dota2.com/webapi/IDOTA2League/GetLeagueInfoList/v001";
    private const CHUNK_SIZE = 500;


    public function load(ObjectManager $manager)
    {
        $data = $this->getData();
        $counter = 0;
        foreach ($data as $row) {
            $counter++;
            $league = new League();
            $league->setName($row['name']);
            $league->setStart($row['start_timestamp']);
            $league->setSourceLeagueId($row['league_id']);
            $manager->persist($league);

            if ($counter >= self::CHUNK_SIZE) {
                $counter = 0;
                $manager->flush();
                $manager->clear();
            }
        }

        $manager->flush();
    }

    private function getData(): array
    {
        $source = file_get_contents(self::SOURCE_URL);
        $data = json_decode($source, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new JsonException("Problem with source data");
        }

        if (!isset($data['infos'])) {
            throw new JsonException("Bad JSON format.");
        }

        return $data['infos'];
    }
}
