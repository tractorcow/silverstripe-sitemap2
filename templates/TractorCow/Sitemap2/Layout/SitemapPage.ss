<div class="content-container typography SitemapPage">
    <article>
        <h1>$Title</h1>
        <div class="content">$Content</div>
    </article>
    <% if SitemapRootPages %>
        <ul class="SitemapChildren Root">
            <% loop SitemapRootPages %>
                $RenderSitemap
            <% end_loop %>
        </ul>
    <% end_if %>
</div>
