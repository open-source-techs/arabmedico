<aside class="main-sidebar">
	<div class="sidebar">
        <div class="user-panel">
            <div class="image pull-left">
                <img src="assets/dist/img/avatar5.png" class="img-circle" alt="User Image">
            </div>
            <div class="info">
                <h4>Welcome</h4>
                <p><?= get_sess('userdata')['ad_user_fname'] . " " . get_sess('userdata')['ad_user_lname'];?></p>
            </div>
        </div>
        <ul class="sidebar-menu">
            <?php
            $get_navbar = query("SELECT * FROM tbl_permissions p JOIN  tbl_navigation n  ON (p.per_navid = n.nav_id) WHERE p.per_roleid = '".get_sess("userdata")['ad_user_usertype']."' ORDER BY n.nav_order ASC");
            while ($nav_item = fetch($get_navbar))
            {
                if($nav_item['nav_is_child'] == 0)
                {
                    if($nav_item['nav_is_have_child'] == 0)
                    {
                        ?>
                        <li class="<?php active_page($nav_item['nav_link']); ?>">
                            <a href="<?php echo admin_base_url().$nav_item['nav_link']; ?>">
                                <i class="<?php echo $nav_item['nav_iconname']; ?>"></i>
                                <span><?php echo $nav_item['nav_name']; ?></span>
                            </a>
                        </li>
                        <?php
                    }
                    else
                    {
                        ?>
                        <li class="treeview">
                            <a href="#">
                                <i class="<?php echo $nav_item['nav_iconname']; ?>"></i>
                                <span><?php echo $nav_item['nav_name']; ?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <?php
                                $get_child = query("SELECT * FROM tbl_permissions p JOIN  tbl_navigation n  ON (p.per_navid = n.nav_id) WHERE p.per_roleid = '".get_sess("userdata")['ad_user_usertype']."' AND nav_is_child = 1 AND nav_parent = ".$nav_item['nav_id']." ORDER BY n.nav_order ASC");
                                while ($child_item = fetch($get_child))
                                {
                                ?>
                                <li><a href="<?php echo admin_base_url().$child_item['nav_link']; ?>"><?php echo $child_item['nav_name']; ?></a></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </li>
                        <?php
                    }
                }
            }
            ?>
		</ul>
	</div>
</aside>