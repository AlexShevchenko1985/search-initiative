<?php

namespace App\Taxonomy;

use App\Base\AbstractTaxonomy;

final class ReviewsCategory extends AbstractTaxonomy
{
    public function getSlug(): string
    {
        return 'reviews-category';
    }

    public function getSingular(): string
    {
        return 'Reviews category';
    }

    public function getPlural(): string
    {
        return 'Reviews categories';
    }

    public function getMenuName(): string
    {
        return 'Reviews category';
    }

    public function isHierarchical(): bool
    {
        return true;
    }

    public function getPostTypes(): array
    {
        return [
            'reviews'
        ];
    }

    public function getRewriteSlug(): string
    {
        return 'reviews-category';
    }
}
