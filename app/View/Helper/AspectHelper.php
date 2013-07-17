<?php
/**
 * Created by JetBrains PhpStorm.
 * User: JeffVandenberg
 * Date: 5/18/13
 * Time: 11:39 PM
 * To change this template use File | Settings | File Templates.
 */
App::uses('AppHelper', 'View/Helper');
/**
 * @property FormHelper Form
 */
class AspectHelper extends AppHelper
{
    public $helpers = array(
        'Html',
        'Form',
    );

    public function MakeEditTable($character)
    {
        $view = '<table>';
        foreach ($character['CharacterAspect'] as $row => $aspect) {
            switch ($aspect['aspect_type_id']) {
                case 1:
                    $view .= $this->MakeHighConceptAspectEdit($row);
                    break;
                case 2:
                    $view .= $this->MakeTroubleAspectEdit($row);
                    break;
                case 3:
                    $view .= $this->MakeBackgroundAspectEdit($row);
                    break;
                case 4:
                    $view .= $this->MakeRisingConflictAspectEdit($row);
                    break;
                case 5:
                    $view .= $this->MakeStoryAspectEdit($row);
                    break;
                case 6:
                    $view .= $this->MakeGeneralAspectEdit($row);
                    break;
                case 7:
                    $view .= $this->MakeGeneralAspectEdit($row);
                    break;
            }
        }
        $view .= '</table>';
        return $view;
    }

    public function MakeViewTable($character)
    {
        $view = '<table>';
        foreach ($character['CharacterAspect'] as $row => $aspect) {
            $view .= $this->MakeAspectView($aspect);
        }
        $view .= '</table>';
        return $view;
    }

    public function MakeAddTable()
    {
        $view = '<table>';
        $view .= $this->MakeHighConceptAspectEdit(0);
        $view .= $this->MakeTroubleAspectEdit(1);
        $view .= $this->MakeBackgroundAspectEdit(2);
        $view .= $this->MakeRisingConflictAspectEdit(3);
        $view .= $this->MakeStoryAspectEdit(4);
        $view .= $this->MakeGeneralAspectEdit(5);
        $view .= $this->MakeGeneralAspectEdit(6);
        $view .= '</table>';
        return $view;
    }

    private function MakeAspectView($aspect)
    {
        $aspectType = $aspect['AspectType']['name'];
        $view = <<<EOQ
<tr class="row-0">
    <td colspan="3">
        <div class="aspect">
            $aspectType
        </div>
    </td>
</tr>
<tr class="row-0">
    <td style="vertical-align: top;">
        <label>Aspect</label><br />
        $aspect[aspect_text]
    </td>
    <td style="vertical-align: top;">
        <label>Description</label><br />
        $aspect[description]
    </td>
    <td>
    </td>
</tr>
EOQ;
        return $view;
    }

    private function MakeHighConceptAspectEdit($row)
    {
        $aspect = $this->Form->input("CharacterAspect.$row.aspect_text", array('label' => 'Aspect', 'class' => array('aspect-text', 'required')));
        $id = $this->Form->input("CharacterAspect.$row.id");
        $aspectType = $this->Form->hidden("CharacterAspect.$row.aspect_type_id", array('value' => 1));

        $view = <<<EOQ
<tr>
    <td colspan="3">
        <div class="aspect">
            High Concept
        </div>
    </td>
</tr>
<tr class="row-0">
    <td colspan="4">
        $id
        $aspectType
        $aspect
    </td>
</tr>
EOQ;
        return $view;
    }

    private function MakeGeneralAspectEdit($row)
    {
        $aspect = $this->Form->input("CharacterAspect.$row.aspect_text", array('label' => 'Aspect', 'class' => 'aspect-text'));
        $id = $this->Form->input("CharacterAspect.$row.id");
        $aspectType = $this->Form->hidden("CharacterAspect.$row.aspect_type_id", array('value' => '6'));
        $description = $this->Form->input("CharacterAspect.$row.description", array('style' => 'width:100%;'));
        $characterId = $this->Form->hidden("CharacterAspect.$row.assoc_character_id");
        $characterName = $this->Form->input("CharacterAspect.$row.assoc_character_name", array('class' => 'character-search'));
        $storyId = $this->Form->hidden("CharacterAspect.$row.story_id");
        $storyName = $this->Form->input("CharacterAspect.$row.story_name");
        $view = <<<EOQ
<tr class="row-0">
    <td colspan="3">
        <div class="aspect">
            General
        </div>
    </td>
</tr>
<tr class="row-0">
    <td>
        $id
        $aspectType
        $aspect
    </td>
    <td>
        $description
    </td>
    <td>
        <span>
            $storyId
            $storyName
        </span>
        <span>
            $characterId
            $characterName
        </span>
    </td>
</tr>
EOQ;
        return $view;
    }

    private function MakeStoryAspectEdit($row)
    {
        $aspect = $this->Form->input("CharacterAspect.$row.aspect_text", array('label' => 'Aspect', 'class' => 'aspect-text'));
        $id = $this->Form->input("CharacterAspect.$row.id");
        $aspectType = $this->Form->hidden("CharacterAspect.$row.aspect_type_id", array('value' => 5));
        $description = $this->Form->input("CharacterAspect.$row.description", array('style' => 'width:100%;'));
        $characterId = $this->Form->hidden("CharacterAspect.$row.assoc_character_id");
        $characterName = $this->Form->input("CharacterAspect.$row.assoc_character_name", array('class' => 'character-search', 'label' => 'Guest Starring'));
        $storyId = $this->Form->hidden("CharacterAspect.$row.story_id");
        $storyName = $this->Form->input("CharacterAspect.$row.story_name");

        $view = <<<EOQ
<tr class="row-0">
    <td colspan="3">
        <div class="aspect">
            Story
        </div>
    </td>
</tr>
<tr class="row-0">
    <td>
        $id
        $aspectType
        $aspect
    </td>
    <td>
        $description
    </td>
    <td>
        <span>
            $storyId
            $storyName
        </span>
        <span>
            $characterId
            $characterName
        </span>
    </td>
</tr>
EOQ;
        return $view;
    }

    private function MakeBackgroundAspectEdit($row)
    {
        $aspect = $this->Form->input("CharacterAspect.$row.aspect_text", array('label' => 'Aspect', 'class' => 'aspect-text'));
        $id = $this->Form->input("CharacterAspect.$row.id");
        $aspectType = $this->Form->hidden("CharacterAspect.$row.aspect_type_id", array('value' => 3));
        $description = $this->Form->input("CharacterAspect.$row.description");

        $view = <<<EOQ
<tr class="row-0">
    <td colspan="3">
        <div class="aspect">
            Background
        </div>
    </td>
</tr>
<tr class="row-0">
    <td>
        $id
        $aspectType
        $aspect
    </td>
    <td colspan="2">
        $description
    </td>
</tr>
EOQ;
        return $view;
    }

    private function MakeRisingConflictAspectEdit($row)
    {
        $aspect = $this->Form->input("CharacterAspect.$row.aspect_text", array('label' => 'Aspect', 'class' => 'aspect-text'));
        $id = $this->Form->input("CharacterAspect.$row.id");
        $aspectType = $this->Form->hidden("CharacterAspect.$row.aspect_type_id", array('value' => 4));
        $description = $this->Form->input("CharacterAspect.$row.description");

        $view = <<<EOQ
<tr class="row-0">
    <td colspan="3">
        <div class="aspect">
            Rising Conflict
        </div>
    </td>
</tr>
<tr class="row-0">
    <td>
        $id
        $aspectType
        $aspect
    </td>
    <td colspan="2">
        $description
    </td>
</tr>
EOQ;
        return $view;
    }

    private function MakeTroubleAspectEdit($row)
    {
        $aspect = $this->Form->input("CharacterAspect.$row.aspect_text", array('label' => 'Aspect', 'class' => 'aspect-text'));
        $id = $this->Form->input("CharacterAspect.$row.id");
        $aspectType = $this->Form->hidden("CharacterAspect.$row.aspect_type_id", array('value' => 2));

        $view = <<<EOQ
<tr class="row-0">
    <td colspan="3">
        <div class="aspect">
            Trouble
        </div>
    </td>
</tr>
<tr class="row-0">
    <td colspan="3">
        $id
        $aspectType
        $aspect
    </td>
</tr>
EOQ;
        return $view;
    }
}