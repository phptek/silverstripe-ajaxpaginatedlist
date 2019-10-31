<?php

/**
 * @author Mateusz Uzdowski (2012), Russell Michell (2019)
 * @package phptek/silverstripe-ajaxpaginator
 */

namespace PhpTek\AjaxPaginator;

use SilverStripe\ORM\PaginatedList;
use SilverStripe\Core\Convert;

/**
 * Adds support for frontend pagination.
 */
class AjaxPaginatedList extends PaginatedList
{
    /**
     * @var string
     */
    protected $pjaxHeader = '';

    /**
     * Get the PJAX fetching header.
     *
     * @return string
     */
    public function getPjaxHeader()
    {
        return $this->pjaxHeader;
    }

    /**
     * Enable PJAX fetching using the $header. Set $header to null to disable.
     *
     * @return AjaxPaginatedList
     */
    public function setPjaxHeader($header)
    {
        $this->pjaxHeader = $header;

        return $this;
    }

    /**
     * Generate metadata elements.
     *
     * @param  int $context       As in PaginatedList::PaginationSummary, how many pages
     *                           are to be displayed around the currently active page.
     * @param  string $pjaxHeader Enable PJAX fetching with the assigned header.
     * @return string
     */
    function PaginationMetadata(int $context = 0, string $pjaxHeader = '')
    {
        $meta = 'data-page-start="' . (int) $this->getPageStart() . '" ' .
                'data-page-length="' . (int) $this->getPageLength() . '" ' .
                'data-total-items="' . (int) $this->getTotalItems() . '" ' .
                'data-get-param="' . Convert::raw2att($this->getPaginationGetVar()) . '"';

        if ($context) {
            $meta .= ' data-context="' . (int) $context . '"';
        }

        if ($this->getPjaxHeader()) {
            $meta .= ' data-pjax-header="' . Convert::raw2att($this->getPjaxHeader()) . '"';
        }

        return $meta;
    }

}
