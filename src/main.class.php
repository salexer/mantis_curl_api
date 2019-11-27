<?php

use Sunra\PhpSimple\HtmlDomParser;

class Main
{
    protected $connector;
    protected $filter;

    public function __construct($cookie)
    {
        $this->connector = new Connector($cookie);
        $this->filter = new Filter();
    }

    public function setFilterCookie()
    {
        $this->connector->post('view_all_set.php?f=3',$this->filter->getFilters());
        $header = $this->connector->get('view_all_bug_page.php',[], true);
        preg_match('/MANTIS_BUG_LIST_COOKIE=([^;]*)/',$header, $matches);
        $this->connector->addCookie('MANTIS_BUG_LIST_COOKIE', $matches[0][0]);
        return $this;
    }

    public function getTasks(){
        $columns = [
            3 => 'id',
            10 => 'summary',
            9 => 'updated',
        ];
        $html = $this->connector->get('view_all_bug_page.php');
        $doc = new DomDocument;
        $internalErrors = libxml_use_internal_errors(true);
        $doc->loadHTML($html);
        libxml_use_internal_errors($internalErrors);
        $table = $doc->getElementById('buglist');
        $out = [];
        foreach ($table->getElementsByTagName('tr') as $line) {
            $new_task = [];
            foreach ($line->getElementsByTagName('td') as $index => $td){
                if (isset($columns[$index])){
                    $new_task[$columns[$index]] = $td->nodeValue;
                }
            }
            if (empty($new_task))
                continue;
            $new_task['issueUrl'] = 'https://mantis.globalrustrade.com/view.php?id='.$new_task['id'];
            $new_task['description'] = '';
            $new_task['created'] = '';
            $new_task['closed'] = false;
            $out['tasks'][] = $new_task;
            unset($new_task);
        }
        return json_encode($out);
    }

    public function closeTask()
    {
        $bug_id = (int)$_REQUEST['id'];
        $token_data = $this->getBugUpdateToken($bug_id);
        //TODO handler_id кастомизированный
        $post_data = $this->connector->post('bug_update.php', array_merge(
            $token_data,
                ['bug_id' => $bug_id, 'status' => 80, 'resolution' => 80, 'duplicate_id' => '', 'handler_id' => 19, 'bugnote_text' => '', 'action_type' => 'change_status']
            )
        );
    }

    protected function getBugUpdateToken($bug_id) :array
    {
        $html = $this->connector->post('bug_change_status_page.php', ['id' => $bug_id, 'new_status' => 80, 'change_type' => 'change_status']);
        $dom = HtmlDomParser::str_get_html($html);
        $token = $dom->find('input[name=bug_update_token]',0)->value;
        $lastupdate = $dom->find('input[name=last_updated]',0)->value;
        return ['bug_update_token' => $token, 'last_updated' => $lastupdate];
    }
}