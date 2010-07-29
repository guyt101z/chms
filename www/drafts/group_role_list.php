<?php
	// Load the Qcodo Development Framework
	require(dirname(__FILE__) . '/../../includes/prepend.inc.php');

	/**
	 * This is a quick-and-dirty draft QForm object to do the List All functionality
	 * of the GroupRole class.  It uses the code-generated
	 * GroupRoleDataGrid control which has meta-methods to help with
	 * easily creating/defining GroupRole columns.
	 *
	 * Any display customizations and presentation-tier logic can be implemented
	 * here by overriding existing or implementing new methods, properties and variables.
	 * 
	 * NOTE: This file is overwritten on any code regenerations.  If you want to make
	 * permanent changes, it is STRONGLY RECOMMENDED to move both group_role_list.php AND
	 * group_role_list.tpl.php out of this Form Drafts directory.
	 *
	 * @package ALCF ChMS
	 * @subpackage Drafts
	 */
	class GroupRoleListForm extends ChmsForm {
		// Local instance of the Meta DataGrid to list GroupRoles
		protected $dtgGroupRoles;

		// Create QForm Event Handlers as Needed

//		protected function Form_Exit() {}
//		protected function Form_Load() {}
//		protected function Form_PreRender() {}
//		protected function Form_Validate() {}

		protected function Form_Run() {
			// Security check for ALLOW_REMOTE_ADMIN
			// To allow access REGARDLESS of ALLOW_REMOTE_ADMIN, simply remove the line below
			QApplication::CheckRemoteAdmin();
		}

		protected function Form_Create() {
			// Instantiate the Meta DataGrid
			$this->dtgGroupRoles = new GroupRoleDataGrid($this);

			// Style the DataGrid (if desired)
			$this->dtgGroupRoles->CssClass = 'datagrid';
			$this->dtgGroupRoles->AlternateRowStyle->CssClass = 'alternate';

			// Add Pagination (if desired)
			$this->dtgGroupRoles->Paginator = new QPaginator($this->dtgGroupRoles);
			$this->dtgGroupRoles->ItemsPerPage = 20;

			// Use the MetaDataGrid functionality to add Columns for this datagrid

			// Create an Edit Column
			$strEditPageUrl = __VIRTUAL_DIRECTORY__ . __FORM_DRAFTS__ . '/group_role_edit.php';
			$this->dtgGroupRoles->MetaAddEditLinkColumn($strEditPageUrl, 'Edit', 'Edit');

			// Create the Other Columns (note that you can use strings for group_role's properties, or you
			// can traverse down QQN::group_role() to display fields that are down the hierarchy)
			$this->dtgGroupRoles->MetaAddColumn('Id');
			$this->dtgGroupRoles->MetaAddColumn(QQN::GroupRole()->Ministry);
			$this->dtgGroupRoles->MetaAddColumn('Name');
			$this->dtgGroupRoles->MetaAddTypeColumn('GroupRoleTypeId', 'GroupRoleType');
		}
	}

	// Go ahead and run this form object to generate the page and event handlers, implicitly using
	// group_role_list.tpl.php as the included HTML template file
	GroupRoleListForm::Run('GroupRoleListForm');
?>