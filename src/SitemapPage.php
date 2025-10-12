<?php

namespace TractorCow\Sitemap2;

use Page;
use SilverStripe\ORM\DataList;

/**
 * @author Damian Mooyman
 *
 * @mixin SitemapExtension
 */
class SitemapPage extends Page
{
    private static $table_name = 'SitemapPage';

    private static $icon = 'tractorcow/silverstripe-sitemap2:client/dist/images/sitemap.png';

    private static $description = 'Page displaying the sitemap for this website as a nested tree';

    /**
     * Retrieves the root pages to be used in the sitemap
     *
     * @return DataList
     */
    public function SitemapRootPages()
    {
        return $this->SitemapChildrenOfParent(0);
    }
}
