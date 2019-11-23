<?php
function sidebar_active($site){

    if($site == $_GET["site"]){
        echo " class='active' ";
    } elseif ($_GET["site"] == null && $site == "home") {
    echo " class='active' ";
    }
}
?>

<div class="sidebar">

    <div class="scrollable scrollbar-macosx">
        <div class="sidebar__cont">
            <div class="sidebar__menu">
                <div class="sidebar__title">Navigation</div>
                <ul class="nav nav-menu">
                    <li <?php sidebar_active("home"); ?> ><a href="index.php?site=home">
                            <div class="nav-menu__ico"><i class="fa fa-fw fa-dashboard"></i></div>
                            <div class="nav-menu__text"><span>Dashboard</span></div></a></li>
                    <li <?php sidebar_active("router"); ?> <?php sidebar_active("router-view"); ?> ><a href="index.php?site=router">
                            <div class="nav-menu__ico"><i class="fa fa-fw fa-bars"></i></div>
                            <div class="nav-menu__text"><span>Router</span></div></a></li>
                    <li <?php sidebar_active("adding"); ?> ><a href="index.php?site=adding">
                            <div class="nav-menu__ico"><i class="fa fa-fw fa-plus-circle"></i></div>
                            <div class="nav-menu__text"><span>Hinzuf&uuml;gen</span></div></a></li>

                </ul>
            </div>
        </div>
    </div>
</div>