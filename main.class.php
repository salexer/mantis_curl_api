<?php

class Main
{
    protected $connector;
    protected $filter;

    public function __construct()
    {
        $this->connector = new Connector();
        $this->filter = new Filter();
    }

    public function setFilterCookie()
    {
        $this->connector->post('view_all_set.php?f=3',$this->filter->getFilters());
        $header = $this->connector->get('view_all_bug_page.php',[], true);
        preg_match('/MANTIS_BUG_LIST_COOKIE=([^;]*)/',$header, $matches);
        $this->connector->addCookkie('MANTIS_BUG_LIST_COOKIE', $matches[0][0]);
        return $this;
    }

    public function getTasks(){
        $html = $this->connector->get('view_all_bug_page.php');
        $doc = new DomDocument;
        $internalErrors = libxml_use_internal_errors(true);
        $doc->loadHTML($html);
        libxml_use_internal_errors($internalErrors);
        $table = $doc->getElementById('buglist');
        foreach ($table->getElementsByTagName('tr') as $line) {
            echo $line->nodeValue;

        }
    }
}