<?php
/**
 * Created by JetBrains PhpStorm.
 * User: JeffVandenberg
 * Date: 5/18/13
 * Time: 11:39 PM
 * To change this template use File | Settings | File Templates.
 */
namespace App\View\Helper;

use App\Model\Entity\Character;
use App\Model\Entity\CharacterAspect;
use Cake\View\Helper\FormHelper;
use Cake\View\Helper\HtmlHelper;
use Cake\View\Helper\TextHelper;


/**
 * @property FormHelper Form
 * @property HtmlHelper Html
 * @property TextHelper Text
 */
class AspectHelper extends AppHelper
{
    public $helpers = array(
        'Html',
        'Form',
        'Text'
    );

    public function MakeEditTable(Character $character)
    {
        $view = '<table>';
        foreach ($character->character_aspects as $row => $aspect) {
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

    public function MakeViewTable(Character $character)
    {
        $view = '<table>';
        foreach ($character->character_aspects as $row => $aspect) {
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

    private function MakeAspectView(CharacterAspect $aspect)
    {
        $aspectType = $aspect->aspect_type->name;
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
        {$aspect->aspect_text}
    </td>
    <td style="vertical-align: top;">
        <label>Description</label><br />
        {$this->Text->autoParagraph($aspect->description)}
    </td>
    <td>
    </td>
</tr>
EOQ;
        return $view;
    }

    private function MakeHighConceptAspectEdit(int $row)
    {
        $aspect = $this->Form->control("character_aspects.$row.aspect_text", array('label' => 'Aspect', 'class' => 'aspect-text'));
        $id = $this->Form->control("character_aspects.$row.id");
        $aspectType = $this->Form->hidden("character_aspects.$row.aspect_type_id", array('value' => 1));
        $description = $this->Form->control("character_aspects.$row.description");

        $view = <<<EOQ
<tr class="row-0">
    <td colspan="3">
        <div class="aspect">
            High Concept
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

    private function MakeGeneralAspectEdit(int $row)
    {
        $aspect = $this->Form->control("character_aspects.$row.aspect_text", array('label' => 'Aspect', 'class' => 'aspect-text', 'required' => false));
        $id = $this->Form->control("character_aspects.$row.id");
        $aspectType = $this->Form->hidden("character_aspects.$row.aspect_type_id", array('value' => '6'));
        $description = $this->Form->control("character_aspects.$row.description");

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
    <td colspan="2">
        $description
    </td>
</tr>
EOQ;
        return $view;
    }

    private function MakeStoryAspectEdit(int $row)
    {
        $aspect = $this->Form->control("character_aspects.$row.aspect_text", array('label' => 'Aspect', 'class' => 'aspect-text', 'required' => false));
        $id = $this->Form->control("character_aspects.$row.id");
        $aspectType = $this->Form->hidden("character_aspects.$row.aspect_type_id", array('value' => 5));
        $description = $this->Form->control("character_aspects.$row.description");

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
    <td colspan="2">
        $description
    </td>
</tr>
EOQ;
        return $view;
    }

    private function MakeBackgroundAspectEdit(int $row)
    {
        $aspect = $this->Form->control("character_aspects.$row.aspect_text", array('label' => 'Aspect', 'class' => 'aspect-text', 'required' => false));
        $id = $this->Form->control("character_aspects.$row.id");
        $aspectType = $this->Form->hidden("character_aspects.$row.aspect_type_id", array('value' => 3));
        $description = $this->Form->control("character_aspects.$row.description");

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

    private function MakeRisingConflictAspectEdit(int $row)
    {
        $aspect = $this->Form->control("character_aspects.$row.aspect_text", array('label' => 'Aspect', 'class' => 'aspect-text', 'required' => false));
        $id = $this->Form->control("character_aspects.$row.id");
        $aspectType = $this->Form->hidden("character_aspects.$row.aspect_type_id", array('value' => 4));
        $description = $this->Form->control("character_aspects.$row.description");

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

    private function MakeTroubleAspectEdit(int $row)
    {
        $aspect = $this->Form->control("character_aspects.$row.aspect_text", [
            'label' => 'Aspect',
            'class' => 'aspect-text',
            'required' => false
        ]);
        $id = $this->Form->control("character_aspects.$row.id");
        $aspectType = $this->Form->hidden("character_aspects.$row.aspect_type_id", [
            'value' => 2
        ]);
        $description = $this->Form->control("character_aspects.$row.description");

        $view = <<<EOQ
<tr class="row-0">
    <td colspan="3">
        <div class="aspect">
            Trouble
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
}
