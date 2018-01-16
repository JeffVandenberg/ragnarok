<?php

use App\Model\Entity\Character;
use App\View\AppView;

/* @var AppView $this */
/* @var Character $character */

$this->set('title_for_layout', 'Public Information for ' . $character->character_name); ?>
<h2><?php echo h($character->character_name); ?></h2>
<div class="tinymce-content callout">
    <?php echo $character->public_information; ?>
</div>
