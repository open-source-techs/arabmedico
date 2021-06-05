<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['btn_save_role']))
	{
		$role['role_name'] = post("role_name");
	    if (insert($role, "tbl_admin_roles")) {
	        $roleid = fetch(query("select * from tbl_admin_roles order by role_id  desc limit 1"))["role_id"];
	        foreach ($_POST["permissions"] as $permission) {
	            $per["per_navid"] = $permission;
	            $per["per_roleid"] = $roleid;
	            insert($per, "tbl_permissions");
	        }
	        set_msg("Done", "Role and Permissions added successfully", "success");
	        jump(admin_base_url()."roles");
	    }
	    else
	    {
	    	set_msg("Error", "Unable to add role. Please try again later", "danger");
	    	jump(admin_base_url()."add-roles");
	    }
	}
	else if(isset($_POST['btn_edit_role']))
	{
		$role_id = post('roleID');
        $role['role_name'] = post("role_name");
        where('role_id',$role_id);
        if (update($role, "tbl_admin_roles"))
        {
        	where('per_roleid',$role_id);
			delete('tbl_permissions');
			foreach ($_POST["permissions"] as $permission) {
	            $per["per_navid"] = $permission;
	            $per["per_roleid"] = $role_id;
	            insert($per, "tbl_permissions");
	        }
	        set_msg("Done", "Role and Permissions updated successfully", "success");
	        jump(admin_base_url()."roles");
        }
        else 
        {
        	set_msg("Error", "Unable to update role. Please try again later", "danger");
	    	jump(admin_base_url()."edit-role?roleID=".$role_id);
        }
	}
	else
	{
		jump(admin_base_url());
	}
}
else if($_SERVER['REQUEST_METHOD'] == "GET")
{
	if(isset($_GET['act']) && $_GET['act'] == "logout")
	{
		session_destroy();
		jump(admin_base_url()."login");
	}
	else
	{
		jump(admin_base_ur());
	}
}
else
{
	jump(admin_base_ur());
}