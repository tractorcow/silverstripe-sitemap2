<?php

namespace TractorCow\Sitemap2;

use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Core\Extension;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataList;
use SilverStripe\ORM\DataObject;

/**
 * @author Damian Mooyman
 *
 * @property SiteTree|SitemapExtension $owner
 */
class SitemapExtension extends Extension
{
    private static $db = [
        'ShowOnSitemap' => 'Boolean(1)'
    ];

    public function SitemapChildren()
    {
        return $this->owner->SitemapChildrenOfParent($this->owner->ID);
    }

    /**
     * Retrieves the list of sitemap-visible pages with the given parentID.
     * May be overridden in the Page class if necessary to change the logic.
     *
     * @param integer $parentID The parent id to filter pages by. May be 0 for root pages
     * @return DataList List of child pages
     */
    public function SitemapChildrenOfParent($parentID)
    {
        return DataObject::get(SiteTree::class)->filter([
            "ParentID" => $parentID,
            "ShowInSearch" => 1,
            "ShowOnSitemap" => 1
        ]);
    }

    /**
     * Renders the HTML entry for this page on the sitemap. May be overridden
     * within the Page class itself (or sub-classes) to customise the template used
     *
     * @return string
     */
    public function RenderSitemap()
    {
        return $this->owner->renderWith('TractorCow\\Sitemap2\\SitemapEntry');
    }

    public function updateCMSFields(FieldList $fields) {
        $fields->removeByName('ShowOnSitemap');
    }

    public function updateSettingsFields(FieldList $fields)
    {
        $fields->addFieldToTab('Root.Settings',
            CheckboxField::create('ShowOnSitemap'),
            'ShowInMenus');
    }
}
