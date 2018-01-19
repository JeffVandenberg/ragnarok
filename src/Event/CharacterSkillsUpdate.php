<?php
namespace App\Event;

use App\Model\Entity\Configuration;
use Cake\Event\Event;
use Cake\Event\EventListenerInterface;
use Cake\ORM\TableRegistry;
use Exception;

/**
 * Created by PhpStorm.
 * User: JeffVandenberg
 * Date: 4/29/2016
 * Time: 8:56 AM
 */

class CharacterSkillsUpdate implements EventListenerInterface
{
    /**
     * @return array
     */
    public function implementedEvents()
    {
        return [
            'config.update' => 'updateCharacterSkills'
        ];
    }

    /**
     * @param Event $event
     * @throws Exception
     */
    public function updateCharacterSkills(Event $event)
    {
        $newSkillPoints = $this->getSkillPointsFromConfig($event->data['new_config'], 'SKILL_POINTS');
        $newPowerLevel = $this->getSkillPointsFromConfig($event->data['new_config'], 'POWER_LEVEL');

        $charactersTable = TableRegistry::get('Characters');

        $charactersTable->updateAll(
            [
                'Characters.skill_level' => $newSkillPoints
            ],
            [
                'Characters.skill_level <' => $newSkillPoints
            ]);

        $charactersTable->updateAll(
            [
                'Characters.power_level' => $newPowerLevel
            ],
            [
                'Characters.power_level <' => $newPowerLevel
            ]);
    }

    /**
     * @param Configuration[] $configOptions
     * @param $key
     * @return null
     * @throws Exception
     */
    private function getSkillPointsFromConfig($configOptions, $key)
    {
        $value = null;
        foreach ($configOptions as $option) {
            if ($option->key === $key) {
                $value = $option->value;
            }
        }

        if ($value === null) {
            throw new Exception('Missing ' . $key . ' from configuration');
        }

        return $value;
    }

}
