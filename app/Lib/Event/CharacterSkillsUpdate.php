<?php

/**
 * Created by PhpStorm.
 * User: JeffVandenberg
 * Date: 4/29/2016
 * Time: 8:56 AM
 */
App::uses('CakeEventListener', 'Event');

class CharacterSkillsUpdate implements CakeEventListener
{
    public function implementedEvents()
    {
        return [
            'config.update' => 'updateCharacterSkills'
        ];
    }

    public function updateCharacterSkills(CakeEvent $event)
    {
        App::uses('Character', 'Model');
        $oldSkillPoints = $this->getSkillPointsFromConfig($event->data['old_config'], 'SKILL_POINTS');
        $newSkillPoints = $this->getSkillPointsFromConfig($event->data['new_config'], 'SKILL_POINTS');

        $oldPowerLevel = $this->getSkillPointsFromConfig($event->data['old_config'], 'POWER_LEVEL');
        $newPowerLevel = $this->getSkillPointsFromConfig($event->data['new_config'], 'POWER_LEVEL');

        $characterRepo = new Character();

        $characterRepo->unbindModel(array(
            'belongsTo' => array_keys($characterRepo->belongsTo)
        ));

        $characterRepo->updateAll(
            [
                'Character.skill_level' => $newSkillPoints
            ],
            [
                'Character.skill_level <=' => $oldSkillPoints
            ]);

        $characterRepo->updateAll(
            [
                'Character.power_level' => $newPowerLevel
            ],
            [
                'Character.power_level <=' => $oldPowerLevel
            ]);
    }

    private function getSkillPointsFromConfig($configOptions, $key)
    {
        $value = null;
        foreach ($configOptions as $option) {
            if ($option['Configuration']['key'] === $key) {
                $value = $option['Configuration']['value'];
            }
        }

        if ($value === null) {
            throw new CakeException('Missing ' . $key . ' from configuration');
        }

        return $value;
    }

}
