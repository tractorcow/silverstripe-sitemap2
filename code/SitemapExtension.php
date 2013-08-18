<?php


/**
 * @author Damian Mooyman
 * 
 * @package sitemap2
 */
class SitemapExtension extends SiteTreeExtension {
	
	private static $db = array(
		'HideOnSitemap' => 'Boolean' // Allows manual hiding on page
	);
	
	public function SitemapChildren() {
		return $this->owner->SitemapChildrenOfParent($this->owner->ID);
	}
	
	/**
	 * Retrieves the list of sitemap-visible pages with the given parentID.
	 * May be overridden in the Page class if necessary to change the logic.
	 * 
	 * @param integer $parentID The parent id to filter pages by. May be 0 for root pages
	 * @return DataList List of child pages
	 */
	public function SitemapChildrenOfParent($parentID) {
		return DataObject::get('SiteTree')->filter(array(
			"ParentID" => $parentID,
			"ShowInSearch" => 1,
			"HideOnSitemap" => 0
		));
	}
	
	/**
	 * Renders the HTML entry for this page on the sitemap. May be overridden
	 * within the Page class itself (or sub-classes) to customise the template used
	 * 
	 * @return string
	 */
	public function RenderSitemap() {
		return $this->owner->renderWith('SitemapEntry');
	}
	
	public function updateSettingsFields(FieldList $fields) {
		// Allow pages to opt out of sitemap visibility.
		// By default non-searchable pages (such as search result pages,
		// form submission landing pages, etc are hidden)
		$fields->addFieldsToTab('Root.Settings', new CheckboxField('HideOnSitemap'), 'ShowInMenus');
	}
}
