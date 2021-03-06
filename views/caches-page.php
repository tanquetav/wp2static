<style>
button.wp2static-button {
    float:left;
    margin-right: 10px !important;
}
</style>

<p><i><a href="<?php echo admin_url('admin.php?page=wp2static-caches'); ?>">Refresh page</a> to see latest status</i><p>

<table class="widefat striped">
    <thead>
        <tr>
            <th>Cache Type</th>
            <th>Statistics</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Crawl Queue (Detected URLs)</td>
            <td><?php echo $view['crawlQueueTotalURLs']; ?> URLs in database</td>
            <td>
                <a href="<?php echo admin_url('admin.php?page=wp2static-crawl-queue'); ?>" target="_blank"><button class="wp2static-button button btn-danger">Show URLs</button></a>
<!-- TODO: allow downloading zipped CSV of all lists  <a href="#"><button class="wp2static-button button btn-danger">Download List</button></a> -->

                <form
                    name="wp2static-crawl-queue-delete"
                    method="POST"
                    action="<?php echo esc_url( admin_url('admin-post.php') ); ?>">

                <?php wp_nonce_field( $view['nonce_action'] ); ?>
                <input name="action" type="hidden" value="wp2static_crawl_queue_delete" />

                <button class="wp2static-button button btn-danger">Delete Crawl Queue</button>

                </form>
            </td>
        </tr>
        <tr>
            <td>Crawl Cache</td>
            <td><?php echo $view['crawlCacheTotalURLs']; ?> URLs in database</td>
            <td>
                <a href="<?php echo admin_url('admin.php?page=wp2static-crawl-cache'); ?>" target="_blank"><button class="wp2static-button button btn-danger">Show URLs</button></a>

                <form
                    name="wp2static-crawl-cache-delete"
                    method="POST"
                    action="<?php echo esc_url( admin_url('admin-post.php') ); ?>">

                <?php wp_nonce_field( $view['nonce_action'] ); ?>
                <input name="action" type="hidden" value="wp2static_crawl_cache_delete" />

                <button class="wp2static-button button btn-danger">Delete Crawl Cache</button>

                </form>
            </td>
        </tr>
        <tr>
            <td>Generated Static Site</td>
            <td><?php echo $view['exportedSiteFileCount']; ?> files, using <?php echo $view['exportedSiteDiskSpace']; ?>
                <br>

                <a href="file://<?php echo $view['uploads_path']; ?>wp2static-exported-site" />Path</a>

            </td>
            <td>
                <a href="<?php echo admin_url('admin.php?page=wp2static-static-site'); ?>" target="_blank"><button class="wp2static-button button btn-danger">Show Paths</button></a>

                <form
                    name="wp2static-static-site-delete"
                    method="POST"
                    action="<?php echo esc_url( admin_url('admin-post.php') ); ?>">

                <?php wp_nonce_field( $view['nonce_action'] ); ?>
                <input name="action" type="hidden" value="wp2static_static_site_delete" />

                <button class="wp2static-button button btn-danger">Delete Files</button>

                </form>
            </td>
        </tr>
        <tr>
            <td>Post-processed Static Site</td>
            <td><?php echo $view['processedSiteFileCount']; ?> files, using <?php echo $view['processedSiteDiskSpace']; ?>
                <br>

                <a href="file://<?php echo $view['uploads_path']; ?>wp2static-processed-site" />Path</a>
            </td>
            <td>
                <a href="<?php echo admin_url('admin.php?page=wp2static-post-processed-site'); ?>" target="_blank"><button class="wp2static-button button btn-danger">Show Paths</button></a>

                <form
                    name="wp2static-post-processed-site-delete"
                    method="POST"
                    action="<?php echo esc_url( admin_url('admin-post.php') ); ?>">

                <?php wp_nonce_field( $view['nonce_action'] ); ?>
                <input name="action" type="hidden" value="wp2static_post_processed_site_delete" />

                <button class="wp2static-button button btn-danger">Delete Files</button>

                </form>
            </td>
        </tr>

        <?php
        $deploy_cache_rows
            = isset($view['deployCacheTotalPathsByNamespace'])
            ? count($view['deployCacheTotalPathsByNamespace'])
            : 1
        ;
        ?>
        <tr>
            <td rowspan="<?php echo $deploy_cache_rows; ?>">Deploy Cache</td>
            <?php if ( isset($view['deployCacheTotalPathsByNamespace']) ) : ?>
                <?php $namespaces = array_keys($view['deployCacheTotalPathsByNamespace']); ?>
                <td><?php echo $view['deployCacheTotalPathsByNamespace'][$namespaces[0]]; ?> Paths in database for <code><?php echo $namespaces[0]; ?></code></td>
                <td>
                    <a href="<?php echo admin_url('admin.php?page=wp2static-deploy-cache&deploy_namespace=' . urlencode($namespaces[0])); ?>" target="_blank"><button class="wp2static-button button">Show Paths</button></a>
                    <form
                        name="wp2static-deploy-cache-delete"
                        method="POST"
                        action="<?php echo esc_url( admin_url('admin-post.php') ); ?>">

                    <?php wp_nonce_field( $view['nonce_action'] ); ?>
                    <input name="action" type="hidden" value="wp2static_deploy_cache_delete" />
                    <input name="deploy_namespace" type="hidden" value="<?php echo $namespaces[0]; ?>" />

                    <button class="wp2static-button button btn-danger">Delete Deploy Cache</button>

                    </form>
                </td>
                <?php for ( $i = 1; $i < $deploy_cache_rows; $i++ ) : ?>
                    </tr>
                    <tr>
                    <td><?php echo $view['deployCacheTotalPathsByNamespace'][$namespaces[$i]]; ?> Paths in database for <code><?php echo $namespaces[$i]; ?></code></td>
                    <td>
                        <a href="<?php echo admin_url('admin.php?page=wp2static-deploy-cache&deploy_namespace=' . urlencode($namespaces[$i])); ?>" target="_blank"><button class="wp2static-button button">Show Paths</button></a>
                        <form
                            name="wp2static-deploy-cache-delete"
                            method="POST"
                            action="<?php echo esc_url( admin_url('admin-post.php') ); ?>">

                        <?php wp_nonce_field( $view['nonce_action'] ); ?>
                        <input name="action" type="hidden" value="wp2static_deploy_cache_delete" />
                        <input name="deploy_namespace" type="hidden" value="<?php echo $namespaces[$i]; ?>" />

                        <button class="wp2static-button button btn-danger">Delete Deploy Cache</button>

                        </form>
                    </td>
                <?php endfor; ?>
            <?php else : ?>
                <td><?php echo $view['deployCacheTotalPaths']; ?> Paths in database</td>
                <td>
                    <a href="<?php echo admin_url('admin.php?page=wp2static-deploy-cache'); ?>" target="_blank"><button class="wp2static-button button btn-danger">Show Paths</button></a>

                    <form
                        name="wp2static-deploy-cache-delete"
                        method="POST"
                        action="<?php echo esc_url( admin_url('admin-post.php') ); ?>">

                    <?php wp_nonce_field( $view['nonce_action'] ); ?>
                    <input name="action" type="hidden" value="wp2static_deploy_cache_delete" />

                    <button class="wp2static-button button btn-danger">Delete Deploy Cache</button>

                    </form>
                </td>
            <?php endif; ?>
        </tr>
    </tbody>
</table>

<br>

<form
    name="wp2static-delete-all-caches"
    method="POST"
    action="<?php echo esc_url( admin_url('admin-post.php') ); ?>">

<?php wp_nonce_field( $view['nonce_action'] ); ?>
<input name="action" type="hidden" value="wp2static_delete_all_caches" />

<button class="wp2static-button button btn-danger">Delete all caches</button>

</form>
