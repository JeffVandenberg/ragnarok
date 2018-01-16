<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CharacterAspectsFixture
 *
 */
class CharacterAspectsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'character_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'aspect_type_id' => ['type' => 'smallinteger', 'length' => 5, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'aspect_text' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'description' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null],
        'story_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'assoc_character_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'aspect_type_idx' => ['type' => 'index', 'columns' => ['aspect_type_id'], 'length' => []],
            'aspect_story_idx' => ['type' => 'index', 'columns' => ['story_id'], 'length' => []],
            'aspect_assoc_char_idx' => ['type' => 'index', 'columns' => ['assoc_character_id'], 'length' => []],
            'aspect_character_idx' => ['type' => 'index', 'columns' => ['character_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'character_aspects_ibfk_1' => ['type' => 'foreign', 'columns' => ['assoc_character_id'], 'references' => ['characters', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'character_aspects_ibfk_2' => ['type' => 'foreign', 'columns' => ['character_id'], 'references' => ['characters', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'character_aspects_ibfk_3' => ['type' => 'foreign', 'columns' => ['story_id'], 'references' => ['stories', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'character_aspects_ibfk_4' => ['type' => 'foreign', 'columns' => ['aspect_type_id'], 'references' => ['aspect_types', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'character_id' => 1,
            'aspect_type_id' => 1,
            'aspect_text' => 'Lorem ipsum dolor sit amet',
            'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'story_id' => 1,
            'assoc_character_id' => 1
        ],
    ];
}
