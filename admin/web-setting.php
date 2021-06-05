<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Website settings</h1>
            <small>Website Settings</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Settings</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                    </div>
                    <div class="panel-body">
                        <?php
                        $sql = query("SELECT * FROM tbl_settings");
                        if(nrows($sql) > 0)
                        {
                            $data = fetch($sql);
                            ?>
                            <form  action="<?= admin_base_url()?>model/webModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                                <input type="hidden" value="<?= $data['setting_id'];?>" name="txt_site_id">
                                <div class="col-sm-6 form-group">
                                    <label>Site Name</label>
                                    <input type="text" name="txt_site_name" value="<?= $data['site_name'];?>" class="form-control" placeholder="Enter Site Name" required>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Site Name Arabic</label>
                                    <input type="text" name="txt_site_name_ar" value="<?= $data['site_name_arabic'];?>" class="form-control" placeholder="Enter Site Name In Arabic" required>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Email</label>
                                    <input type="email" name="txt_email" value="<?= $data['site_email'];?>" class="form-control" placeholder="Enter Email" required>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Phone</label>
                                    <input type="tel" name="txt_phone" value="<?= $data['site_phone'];?>" class="form-control" placeholder="Enter Phone" required>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Phone</label>
                                    <input type="text" name="txt_phone_arabic" value="<?= $data['site_phone_arabic'];?>" class="form-control" placeholder="Enter Phone in Arabic" required>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Meta Title</label>
                                    <input type="text" name="txt_meta_title" value="<?= $data['site_meta_title'];?>" class="form-control" placeholder="Enter meta title" required>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Meta Title Arabic</label>
                                    <input type="text" name="txt_meta_title_ar" value="<?= $data['site_meta_title_arabic'];?>" class="form-control" placeholder="Enter meta title in arabic" required>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Facebook</label>
                                    <input type="text" name="txt_fb" value="<?= $data['site_facebook'];?>" class="form-control" placeholder="Enter Facebook Page Link" required>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Twitter</label>
                                    <input type="text" name="txt_twitter" value="<?= $data['site_twitter'];?>" class="form-control" placeholder="Enter Twitter Page Link" required>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Google +</label>
                                    <input type="text" name="txt_google" value="<?= $data['site_google'];?>" class="form-control" placeholder="Enter Google+ Link" required>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Linked In</label>
                                    <input type="text" name="txt_linkedin" value="<?= $data['site_linkedin'];?>" class="form-control" placeholder="Enter LinkedIn Profile Link" required>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Instagram</label>
                                    <input type="text" name="txt_instagram" value="<?= $data['site_instagram'];?>" class="form-control" placeholder="Enter Instagram Link" required>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Header Logo</label>
                                    <input type="file" name="txt_head_logo" class="form-control">
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Footer Logo</label>
                                    <input type="file" name="txt_footer_logo" class="form-control">
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Favicon</label>
                                    <input type="file" name="txt_favicon" class="form-control">
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Welcome Heading</label>
                                    <textarea name="txt_welcome_head" class="form-control" placeholder="Enter Welcome Text Heading" required><?= $data['welcome_heading'];?></textarea>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Welcome Heading Arabic</label>
                                    <textarea name="txt_welcome_head_arabic" class="form-control" placeholder="Enter Welcome Text Heading in Arabic" required><?= $data['welcome_heading_arabic'];?></textarea>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Welcome Text</label>
                                    <textarea name="txt_welcome" class="form-control" placeholder="Enter Welcome Text" required><?= $data['site_welcome_text'];?></textarea>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Welcome Text Arabic</label>
                                    <textarea name="txt_welcome_arabic" class="form-control" placeholder="Enter Welcome Text in Arabic" required><?= $data['site_welcome_text_arabic'];?></textarea>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Welcome Image</label>
                                    <input type="file" name="txt_welcome_image" class="form-control">
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Thumbnail Background</label>
                                    <input type="file" name="txt_thumb_image" class="form-control">
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>News List ADD Image</label>
                                    <input type="file" name="txt_news_add" class="form-control">
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>News Detail ADD Image</label>
                                    <input type="file" name="txt_detail_add" class="form-control">
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Footer Text</label>
                                    <textarea name="txt_footer" class="form-control" placeholder="Enter Footer Text" required><?= $data['footer_text'];?></textarea>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Footer Text Arabic</label>
                                    <textarea name="txt_footer_arabic" class="form-control" placeholder="Enter Footer Text in Arabic" required><?= $data['footer_text_arabic'];?></textarea>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Site Meta Description</label>
                                    <textarea name="txt_meta_desc" class="form-control" placeholder="Enter Meta Description" required><?= $data['site_meta_description'];?></textarea>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Site Meta Description Arabic</label>
                                    <textarea name="txt_meta_desc_arabic" class="form-control" placeholder="Enter Meta Description in Arabic" required><?= $data['site_meta_description_arabic'];?></textarea>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Site Meta Tags</label>
                                    <textarea name="txt_meta_tag" class="form-control" placeholder="Enter Meta Tag" required><?= $data['site_meta_tag'];?></textarea>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Site Meta Tags Arabic</label>
                                    <textarea name="txt_meta_tag_arabic" class="form-control" placeholder="Enter Meta Tag in Arabic" required><?= $data['site_meta_tag_arabic'];?></textarea>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Address</label>
                                    <textarea name="txt_address" class="form-control" placeholder="Enter Company Address" required><?= $data['site_address'];?></textarea>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Address Arabic</label>
                                    <textarea name="txt_address_arabic" class="form-control" placeholder="Enter Company Address In Arabic" required><?= $data['site_address_arabic'];?></textarea>
                                </div>
                                <div class="col-sm-12 reset-button">
                                    <input type="submit" name="btn_edit_setting" class="btn btn-success" value="Save">
                                </div>
                            </form>
                            <?php
                        }
                        else
                        {
                        ?>
                        <form  action="<?= admin_base_url()?>model/webModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label>Site Name</label>
                                <input type="text" name="txt_site_name" class="form-control" placeholder="Enter Site Name" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Site Name Arabic</label>
                                <input type="text" name="txt_site_name_ar" class="form-control" placeholder="Enter Site Name In Arabic" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Email</label>
                                <input type="email" name="txt_email" class="form-control" placeholder="Enter Email" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Phone</label>
                                <input type="tel" name="txt_phone" class="form-control" placeholder="Enter Phone" required>
                            </div>
                            
                            <div class="col-sm-6 form-group">
                                <label>Phone</label>
                                <input type="text" name="txt_phone_arabic" class="form-control" placeholder="Enter Phone in Arabic" required>
                            </div>
                            
                            <div class="col-sm-6 form-group">
                                <label>Meta Title</label>
                                <input type="text" name="txt_meta_title" class="form-control" placeholder="Enter meta title" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Meta Title Arabic</label>
                                <input type="text" name="txt_meta_title_ar" class="form-control" placeholder="Enter meta title in arabic" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Facebook</label>
                                <input type="text" name="txt_fb" class="form-control" placeholder="Enter Facebook Page Link" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Twitter</label>
                                <input type="text" name="txt_twitter" class="form-control" placeholder="Enter Twitter Page Link" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Google +</label>
                                <input type="text" name="txt_google" class="form-control" placeholder="Enter Google+ Link" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Linked In</label>
                                <input type="text" name="txt_linkedin" class="form-control" placeholder="Enter LinkedIn Profile Link" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Instagram</label>
                                <input type="text" name="txt_instagram" class="form-control" placeholder="Enter Instagram Link" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Header Logo</label>
                                <input type="file" name="txt_head_logo" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Footer Logo</label>
                                <input type="file" name="txt_footer_logo" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Favicon</label>
                                <input type="file" name="txt_favicon" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Welcome Heading</label>
                                <textarea name="txt_welcome_head" class="form-control" placeholder="Enter Welcome Text Heading" required></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Welcome Heading Arabic</label>
                                <textarea name="txt_welcome_head_arabic" class="form-control" placeholder="Enter Welcome Text Heading in Arabic" required></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Welcome Text</label>
                                <textarea name="txt_welcome" class="form-control" placeholder="Enter Welcome Text" required></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Welcome Text Arabic</label>
                                <textarea name="txt_welcome_arabic" class="form-control" placeholder="Enter Welcome Text in Arabic" required></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Welcome Image</label>
                                <input type="file" name="txt_welcome_image" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Thumbnail Background</label>
                                <input type="file" name="txt_thumb_image" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>News List ADD Image</label>
                                <input type="file" name="txt_news_add" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>News Detail ADD Image</label>
                                <input type="file" name="txt_detail_add" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Footer Text</label>
                                <textarea name="txt_footer" class="form-control" placeholder="Enter Footer Text" required></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Footer Text Arabic</label>
                                <textarea name="txt_footer_arabic" class="form-control" placeholder="Enter Footer Text in Arabic" required></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Site Meta Description</label>
                                <textarea name="txt_meta_desc" class="form-control" placeholder="Enter Meta Description" required></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Site Meta Description Arabic</label>
                                <textarea name="txt_meta_desc_arabic" class="form-control" placeholder="Enter Meta Description in Arabic" required></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Site Meta Tags</label>
                                <textarea name="txt_meta_tag" class="form-control" placeholder="Enter Meta Tag" required></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Site Meta Tags Arabic</label>
                                <textarea name="txt_meta_tag_arabic" class="form-control" placeholder="Enter Meta Tag in Arabic" required></textarea>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Address</label>
                                <textarea name="txt_address" class="form-control" placeholder="Enter Company Address" required></textarea>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <input type="submit" name="btn_save_setting" class="btn btn-success" value="Save">
                            </div>
                        </form>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php require_once('layout/footer.php');?>
<?php
get_msg('msg');
?>