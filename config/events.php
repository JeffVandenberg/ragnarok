<?php

use App\Event\CharacterSkillsUpdate;
use Cake\Event\EventManager;


EventManager::instance()->on(new CharacterSkillsUpdate());
