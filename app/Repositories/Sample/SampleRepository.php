<?php
namespace App\Repositories\Sample;

use App\Repositories\BaseRepository;
use App\Repositories\Sample\SampleRepositoryInterface;
use App\Models\Sample;

class SampleRepository extends BaseRepository implements SampleRepositoryInterface
{
    public function __construct(Sample $sample)
    {
        parent::__construct($sample);
    }
}