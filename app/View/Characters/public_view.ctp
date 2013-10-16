<?php /* @var View $this */ ?>
<?php /* @var array $character */ ?>
<?php $this->set('title_for_layout', 'Public Information for ' . $character['Character']['character_name']); ?>
<h2><?php echo h($character['Character']['character_name']); ?></h2>
<iframe style="border: none;width:100%;min-height:50%" frameborder="0" id="character-view"></iframe>
<script>
    $(function() {
        var iFrame = $('#character-view');

        var iFrameDoc = iFrame[0].contentDocument || iFrame[0].contentWindow.document;
        //iFrameDoc.write("<p>This is a public informational page.</p><p>&nbsp;</p><p>Such a long public page.</p><p>List</p><ul><li>Item 1</li><li>Item 2</li><li>Item3</li></ul><p>&nbsp;</p><p><img src=\"http://pablochiste.files.wordpress.com/2013/05/spock-leornard-nimoy-star-trek-tos.jpg\" alt=\"Spock\" /></p>");
        iFrameDoc.write("<div id=\"pub-content\" style=\"font-family: arial;\">");
        iFrameDoc.write("<?php echo str_replace(array('"', "\n", "\r"), array('\"', '', ''), $character['Character']['public_information']); ?>");
        iFrameDoc.write("</div>");
        iFrameDoc.close();

        iFrame.load(function() {
            $(this).css('height', $(iFrameDoc).height() + 'px');
        })

    })
</script>