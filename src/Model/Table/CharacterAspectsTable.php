<?php
namespace App\Model\Table;

use App\Model\Entity\CharacterAspect;
use Cake\Datasource\EntityInterface;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CharacterAspects Model
 *
 * @property \App\Model\Table\CharactersTable|\Cake\ORM\Association\BelongsTo $Characters
 * @property \App\Model\Table\AspectTypesTable|\Cake\ORM\Association\BelongsTo $AspectTypes
 * @property \App\Model\Table\StoriesTable|\Cake\ORM\Association\BelongsTo $Stories
 *
 * @method CharacterAspect get($primaryKey, $options = [])
 * @method CharacterAspect newEntity($data = null, array $options = [])
 * @method CharacterAspect[] newEntities(array $data, array $options = [])
 * @method CharacterAspect|bool save(EntityInterface $entity, $options = [])
 * @method CharacterAspect patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method CharacterAspect[] patchEntities($entities, array $data, array $options = [])
 * @method CharacterAspect findOrCreate($search, callable $callback = null, $options = [])
 */
class CharacterAspectsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('character_aspects');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Characters', [
            'foreignKey' => 'character_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('AspectTypes', [
            'foreignKey' => 'aspect_type_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Stories', [
            'foreignKey' => 'story_id'
        ]);
        $this->belongsTo('Characters', [
            'foreignKey' => 'assoc_character_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('aspect_text')
            ->maxLength('aspect_text', 100)
            ->allowEmpty('aspect_text');

        $validator
            ->scalar('description')
            ->allowEmpty('description');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['character_id'], 'Characters'));
        $rules->add($rules->existsIn(['aspect_type_id'], 'AspectTypes'));
        $rules->add($rules->existsIn(['story_id'], 'Stories'));
        $rules->add($rules->existsIn(['assoc_character_id'], 'Characters'));

        return $rules;
    }
}
