<?php

namespace App\Models\QueryFilter;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

/**
 * Class QueryFilters
 * Provides an extendable class so that Eloquent models can be easily filtered
 * with query string parameters. To use, extend this class and create filtering
 * methods and make your models use the Filterable trait.
 * @package App\Models\QueryFilters
 */
abstract class QueryFilters
{
    /**
     * List of methods allowed
     *
     * @var array
     */
    protected $filterable = [
    ];

    /**
     * The request object.
     *
     * @var Request
     */
    protected $request;

    /**
     * The builder instance.
     *
     * @var Builder
     */
    protected $builder;

    /**
     * It has to be one of the available restriction properties in Restrictions.
     * This determines how filters are modified according to user restrictions for that property.
     *
     * @var ?string
     */
    protected $restrictionProperty = null;

    /**
     * If set it will sort according to this field (if request does not overwrite it)
     * @var string|null
     */
    protected $sortFieldDefault = null;

    /**
     * If set, sorting will happen in this direction (if request does not overwrite it)
     * @var 'asc'|'desc'|null
     */
    protected $sortDirDefault = null;

    /**
     * Allow requester to sort results with this filter.
     * In order for sorting to work, the request needs to have two fields:
     *
     *      sortField: [string] the field to sort results with
     *        sortDir: [string] (optional) 'asc' or 'desc'. Defaults to 'desc'.
     *
     * @var bool
     */
    protected $allowSort = true;

    /**
     * The filter has dynamic methods using __call
     *
     * @var bool
     */
    protected $hasDynamicMethods = false;

    /**
     * Create a new QueryFilters instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply the filters to the builder.
     *
     * @param  Builder $builder
     * @return Builder
     */
    public function apply(Builder $builder)
    {
        $this->builder = $builder;
        $filters = $this->filters();

        if ($this->allowSort && $this->request->get('sortField')) {
            $this->sortField($this->request->get('sortField'));
        } elseif (!is_null($this->sortFieldDefault)) {
            $this->sortField($this->sortFieldDefault);
        }

        foreach ($filters as $name => $value) {
            if (!method_exists($this, $name) && !$this->hasDynamicMethods) {
                continue;
            }

            if (is_array($value) || (is_string($value) && strlen($value))) {
                $this->$name($value);
            } else {
                $this->$name();
            }
        }

        return $this->builder;
    }

    /**
     * Get all request filters allowed in the $filterable property
     *
     * @return array
     */
    public function filters()
    {

        $filters = [];

        foreach ($this->request->all() as $filter => $value) {
            if (in_array($filter, $this->filterable)) {
                $filters[$filter] = $value;
            }
        }
        return $filters;
    }


}
