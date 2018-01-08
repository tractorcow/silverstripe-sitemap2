<?php

namespace Tractorcow\Sitemap2;

use Page;

/**
* @author Damian Mooyman
*
* @package sitemap2
*/
class SitemapPage extends Page
{
    private static $table_name = 'SitemapPage';

    private static $icon = 'sitemap2/images/sitemap.png';

    private static $description = 'Page displaying the sitemap for this website as a nested tree';

    /**
    * Retrieves the root pages to be used in the sitemap
    *
    * @return DataList
    */
    public function SitemapRootPages() {
        return $this->SitemapChildrenOfParent(0);
    }
}
