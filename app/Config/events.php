<?php
// load listeners
App::uses('CharacterSkillsUpdate', 'Lib/Event');
App::uses('CakeEventManager', 'Event');

CakeEventManager::instance()->attach(new CharacterSkillsUpdate());
