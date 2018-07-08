<?php
namespace App\traits;

use App\Model\Paginate;

trait Links
{
    protected $maxLinks = 4;

    private function previous()
    {
        if ($this->page > 1) {
            $preview = ($this->page - 1);
            $links = '<a class="icon item" href="?page=' . $preview . '">
            <i class="left chevron icon"></i>
            </a>';
            return $links;
        }
    }

    private function next()
    {
        if ($this->page < $this->pages) {
            $next = ($this->page + 1);
            $links = '<a class="icon item" href="?page=' . $next . '">
            <i class="right chevron icon"></i>
            </a>';
            return $links;
        }
    }

    public function links()
    {
        if ($this->pages > 0) {
            $links = $this->previous();

            for ($i = $this->page - $this->maxLinks; $i <= $this->page + $this->maxLinks; $i++) {
                if ($i > 0 && $i <= $this->pages) {
                    $links .= '<a class="item" href="?page=' . $i . '">' . $i . '</a>';
                }
            }
            $links .= $this->next();
            return $links;
        }
    }
}
