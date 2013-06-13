<?php /* @var View $this */ ?>
<?php $this->set('title_for_layout', 'Chatting as ' . $name); ?>
Chatting as <?php echo $name; ?><br />
<script language="JavaScript" type="text/javascript">
    <!--
    var sourceBase="http://host4.chatblazer.com/";
    var siteID = "CBS1842";
    var tagName = "script";
    document.write('<'+tagName+' language="JavaScript" type="text/javascript" src="'+sourceBase+'chatblazer.js"></'+tagName+'>');
    //-->
</script>
<script language="JavaScript" type="text/javascript">
    <!--
    var mainConfig="CBS1842/config.xml";
    var mainSkin= "";

    // username and password used for direct login only
    var directUsername="<?php echo $name; ?>";
    var directPassword="";
    var roomPassword="";
    var roomID="2694";
    var roomName="Welcome";

    // Size of ChatBlazer application in % or pixels
    var chatWidth="100%";
    var chatHeight="100%";


    // path of chat
    var flashPath="ChatBlazer8.swf?cb=1";

    function addParam(pname,pval) {
        if (typeof pval!="undefined" && pval) { flashPath = flashPath + "&"+pname+"=" + encodeURIComponent(pval); }
    }

    addParam("siteid",siteID);
    addParam("config",mainConfig);
    addParam("username",directUsername);
    addParam("password",directPassword);
    addParam("roompass",roomPassword);
    addParam("roomid",roomID);
    addParam("roomname",roomName);

    if (navigator.appVersion.indexOf("MSIE") != -1) {
        addParam("isIE","1");
    }

    embedFlash(flashPath,chatWidth,chatHeight,"cb8",sourceBase, "#000000");
    //-->
</script>


