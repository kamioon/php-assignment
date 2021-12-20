<?php

declare(strict_types=1);

namespace Statistics\Calculator;

use SocialPost\Dto\SocialPostTo;
use Statistics\Dto\StatisticsTo;

class TotalPostsPerUserPerMonth extends AbstractCalculator
{

    protected const UNITS = 'posts';
    private array $users;

    /**
     * @inheritDoc
     */
    protected function doAccumulate(SocialPostTo $postTo): void
    {

        $key = $postTo->getAuthorId();
        $this->users[$key] = ($this->users[$key] ?? 0) + 1;

    }

    /**
     * @inheritDoc
     */
    protected function doCalculate(): StatisticsTo
    {
        $total = 0;

        foreach ($this->users as $userPosts) {
            $total += $userPosts;
        }

        return (new StatisticsTo())->setValue($total / count($this->users));
    }
}
