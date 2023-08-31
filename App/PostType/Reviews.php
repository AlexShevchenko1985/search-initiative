<?php

namespace App\PostType;

use App\Base\AbstractPostType;

final class Reviews extends AbstractPostType
{
    public function getSlug(): string
    {
        return 'reviews';
    }

    public function getSingular(): string
    {
        return 'Review';
    }

    public function getPlural(): string
    {
        return 'Reviews';
    }

    public function getMenuName(): string
    {
        return 'Reviews';
    }

    public function isHierarchical(): bool
    {
        return true;
    }

    public function hasArchive(): bool
    {
        return true;
    }

    public function getRewriteSlug(): string
    {
        return 'reviews';
    }
    public function getSupports(): array
    {
        return [
            self::TITLE,
            self::EDITOR,
            self::THUMBNAIL,
            self::EXCERPT,
            self::AUTHOR,
            self::COMMENTS,
        ];
    }

    public function getTaxonomies(): array
    {
        return [
            'reviews-category'
        ];
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
        return false;
    }

    public function getMenuIcon(): string
    {
        return 'dashicons-format-chat';
    }

    public function isDisableGutenberg(): bool
    {
        return true;
    }
}
