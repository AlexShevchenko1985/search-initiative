<?php

namespace App\Base;
abstract class AbstractPostType
{
    public const TITLE            = 'title';
    public const EDITOR           = 'editor';
    public const AUTHOR           = 'author';
    public const THUMBNAIL        = 'thumbnail';
    public const EXCERPT          = 'excerpt';
    public const TRACKBACKS       = 'trackbacks';
    public const CUSTOM_FIELDS    = 'custom-fields';
    public const COMMENTS         = 'comments';
    public const REVISIONS        = 'revisions';
    public const PAGE_ATTRIBUTES  = 'page-attributes';
    public const POST_FORMATS     = 'post-formats';

    private $slug;
    private $singular;
    private $plural;
    private $labels;
    private $args;
    private $disable;

    public function __construct()
    {
        $this->slug     = $this->getSlug();
        $this->singular = $this->getSingular();
        $this->plural   = $this->getPlural();
        $this->labels   = $this->getLabels();
        $this->args     = $this->getArgs();
        $this->disable  = $this->isDisableGutenberg();

        add_action('init', [$this, 'register']);
        add_filter('use_block_editor_for_post_type', [$this, 'disableGutenberg'], 1, 2);
    }

    /**
     * Disable gutenberg
     *
     * @param   bool    $currentStatus
     * @param   string  $postType
     *
     * @return  bool
     */
    public function disableGutenberg(bool $currentStatus, string $postType): bool
    {
        if ($this->disable && in_array($postType, [$this->slug], true)) {
            $currentStatus = false;
        }

        return $currentStatus;
    }

    /**
     * Return slug for post type
     *
     * @return string
     */
    abstract public function getSlug(): string;

    /**
     * Return name for singular label
     *
     * @return string
     */
    abstract public function getSingular(): string;

    /**
     * Return name for plural label
     *
     * @return string
     */
    abstract public function getPlural(): string;

    /**
     * Is post type hierarchical
     *
     * @return bool
     */
    abstract public function isHierarchical(): bool;

    /**
     * Does post type has archive
     *
     * @return bool
     */
    abstract public function hasArchive(): bool;

    /**
     * Return array of labels for post type
     *
     * @return array
     */
    public function getLabels(): array
    {
        return [
            'name'                     => __($this->plural, 'tbc'),
            'singular_name'            => __($this->singular, 'tbc'),
            'add_new'                  => __("Add new", 'tbc'),
            'add_new_item'             => __("Add new {$this->singular}", 'tbc'),
            'edit_item'                => __("Edit {$this->singular}", 'tbc'),
            'new_item'                 => __("New {$this->singular}", 'tbc'),
            'view_item'                => __("View {$this->singular}", 'tbc'),
            'search_items'             => __("Search {$this->plural}", 'tbc'),
            'not_found'                => __("Not found", 'tbc'),
            'not_found_in_trash'       => __("Not found in trash", 'tbc'),
            'parent_item_colon'        => __("Parent {$this->singular}", 'tbc'),
            'all_items'                => __("{$this->plural}", 'tbc'),
            'archives'                 => __("{$this->plural}", 'tbc'),
            'insert_into_item'         => __("Insert into {$this->singular}", 'tbc'),
            'uploaded_to_this_item'    => __("Uploaded to this {$this->singular}", 'tbc'),
            'featured_image'           => __("Featured image", 'tbc'),
            'set_featured_image'       => __("Set featured image", 'tbc'),
            'remove_featured_image'    => __("Remove featured image", 'tbc'),
            'use_featured_image'       => __("Use featured image", 'tbc'),
            'filter_items_list'        => __("{$this->plural} list", 'tbc'),
            'items_list_navigation'    => __("{$this->plural} navigation", 'tbc'),
            'items_list'               => __("{$this->plural} list", 'tbc'),
            'menu_name'                => __("{$this->getMenuName()}", 'tbc'),
            'name_admin_bar'           => __("{$this->plural}", 'tbc'),
            'view_items'               => __("View {$this->plural}", 'tbc'),
            'attributes'               => __("{$this->singular} attributes", 'tbc'),
            'item_updated'             => __("{$this->singular} updated", 'tbc'),
            'item_published'           => __("{$this->singular} published", 'tbc'),
            'item_published_privately' => __("{$this->singular} published privately", 'tbc'),
            'item_reverted_to_draft'   => __("{$this->singular} reverted to draft", 'tbc'),
            'item_scheduled'           => __("{$this->singular} scheduled", 'tbc'),
        ];
    }

    /**
     * Return arguments array
     *
     * @return array
     */
    public function getArgs(): array
    {
        return [
            'label'               => null,
            'labels'              => $this->labels,
            'description'         => $this->getDescription(),
            'public'              => $this->isPublic(),
            'publicly_queryable'  => $this->isPublicQueryable(),
            'exclude_from_search' => $this->isExcludedFromSearch(),
            'show_ui'             => $this->isShowUi(),
            'show_in_menu'        => $this->isShowInMenu(),
            'show_in_admin_bar'   => $this->isShowInAdminBar(),
            'show_in_nav_menus'   => $this->isShowInNavMenus(),
            'show_in_rest'        => $this->isShowInRest(),
            'rest_base'           => $this->getRestBase(),
            'menu_position'       => $this->getMenuPosition(),
            'menu_icon'           => $this->getMenuIcon(),
            'capability_type'     => $this->getCapabilityType(),
            'hierarchical'        => $this->isHierarchical(),
            'supports'            => $this->getSupports(),
            'taxonomies'          => $this->getTaxonomies(),
            'has_archive'         => $this->hasArchive(),
            'rewrite'             => $this->hasRewriteRules() ? $this->getRewriteRules() : false,
            'rewrite_with_front'  => $this->shouldRewriteWithFront(),
            'query_var'           => $this->hasQueryVar(),
        ];
    }

    /**
     * Register post type
     */
    public function register(): void
    {
        register_post_type($this->slug, $this->args);
    }

    public function getDescription(): string
    {
        return '';
    }

    public function isPublic(): bool
    {
        return true;
    }

    public function isPublicQueryable(): bool
    {
        return true;
    }

    public function isExcludedFromSearch(): bool
    {
        return true;
    }

    public function isShowUi(): bool
    {
        return true;
    }

    public function isShowInMenu(): bool
    {
        return true;
    }

    public function isShowInAdminBar(): bool
    {
        return true;
    }

    public function isShowInNavMenus(): bool
    {
        return true;
    }

    public function isShowInRest(): bool
    {
        return true;
    }

    public function getRestBase(): string
    {
        return '';
    }

    public function getMenuPosition(): ?int
    {
        return null;
    }

    public function getMenuName(): string
    {
        return $this->getPlural();
    }

    public function getMenuIcon(): string
    {
        return 'dashicons-admin-post';
    }

    public function getCapabilityType(): string
    {
        return 'post';
    }

    public function getSupports(): array
    {
        return [
            self::TITLE,
            self::EDITOR,
        ];
    }

    public function getTaxonomies(): array
    {
        return [];
    }

    public function hasRewriteRules(): bool
    {
        return true;
    }

    public function getRewriteRules(): array
    {
        return [
            'slug'          => $this->getRewriteSlug(),
            'with_front'    => $this->shouldRewriteWithFront(),
            'feeds'         => $this->hasFeeds(),
            'pages'         => true,
            'ep_mask'       => EP_PERMALINK,
        ];
    }

    public function getRewriteSlug(): string
    {
        return $this->slug;
    }

    public function shouldRewriteWithFront(): bool
    {
        return true;
    }

    public function hasFeeds(): bool
    {
        return $this->hasArchive();
    }

    public function hasQueryVar(): bool
    {
        return true;
    }

    public function isDisableGutenberg(): bool
    {
        return false;
    }
}
