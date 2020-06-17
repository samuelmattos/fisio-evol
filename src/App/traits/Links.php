<?php
namespace App\traits;

use App\Model\Paginate;

trait Links
{
    protected $maxLinks = 4;

    private function pageRequest()
    {
        return (!busca()) ? "?page=" : "?s=" . busca() . '&page=';
    }

    private function previous()
    {
        if ($this->page > 1) {
            $preview = ($this->page - 1);
            $links = '<li class="page-item"><a class="page-link" href="'.$this->pageRequest() . $preview . '">
            <span aria-hidden="true">&laquo;</span>
            </a></li>';
            return $links;
        }
    }

    private function next()
    {
        if ($this->page < $this->pages) {
            $next = ($this->page + 1);
            $links = '<li class="page-item"><a class="page-link" href="'.$this->pageRequest() . $next . '">
            <span aria-hidden="true">&raquo;</span>
            </a></li>';
            return $links;
        }
    }

    public function links()
    {
        if($this->pages == 1){
            return '';
        }
        if ($this->pages > 0) {
            $links = '<ul class="pagination">'; 
            $links .= $this->previous();
            $css_current = '';
            for ($i = $this->page - $this->maxLinks; $i <= $this->page + $this->maxLinks; $i++) {
                if ($i > 0 && $i <= $this->pages) {
                    if($this->page == $i){
                        $css_current = 'active';
                    }else{
                        $css_current = '';
                    }
                    $links .= '<li class="page-item '.$css_current.'"><a class="page-link " href="'.$this->pageRequest() . $i . '">' . $i . '</a></li>';
                }
            }
            $links .= $this->next();
            $links .= '</ul>'; 
            return $links;
        }
    }
}
