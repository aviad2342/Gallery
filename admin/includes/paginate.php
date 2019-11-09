<?php 

class Paginate {
    public $current_page;
    public $page_items;
    public $page_total_items;

    public function __construct($page=1, $page_items=4, $page_total_items=0) {
        $this->current_page = (int)$page;
        $this->page_items = (int)$page_items;
        $this->page_total_items = (int)$page_total_items;
    }

    public function next() {
        return $this->current_page + 1;
    }

    public function previous() {
        return $this->current_page - 1;
    }

    public function page_total() {
        return ceil($this->page_total_items/$this->page_items);
    }

    public function hes_previous() {
        return $this->previous() >= 1 ? true : false;
    }

    public function hes_next() {
        return $this->next() <= $this->page_total() ? true : false;
    }

    public function offset() {
        return ($this->current_page - 1) * $this->page_items;
    }

}


?>